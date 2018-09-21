<?php
/**
 * Created by PhpStorm.
 * User: iwrow
 * Date: 26.03.2017
 * Time: 13:33
 */

namespace Test;

class BinaryTree
{
    private $objects = [];
    private $root = null;
    private $maxLvl = 10;

    private function getNodeById($id) {
        if (!isset($this->objects[$id]))
            $this->objects[$id] = new BinaryNode();
        return $this->objects[$id];
    }


    private function outTree($node, $level) {
        /*if ($level>$this->maxLvl)
            return;*/
        echo "<li>";
        echo "<a href='#'>Item ". $node->data->getId()."</a>";
        if ($level<$this->maxLvl) {
            if (!is_null($node->left) || !is_null($node->right)) {
                echo "<ul>";
                if (!is_null($node->left)) {
                    $level++;
                    $this->outTree($node->left, $level);
                    $level--;
                }
                if (!is_null($node->right)) {
                    $level++;
                    $this->outTree($node->right, $level);
                    $level--;
                }
                echo "</ul>";
            }
        }
        echo "</li>";

    }

    public function printTree($lvl)
    {
        $this->maxLvl = $lvl;
        echo "<ul>";
        $this->outTree($this->root,0);
        echo "</ul>";
    }

    public function __construct($BinaryTreeElements)
    {
        foreach ($BinaryTreeElements as $el) {
            $node = $this->getNodeById($el->getId());
            $node->data = $el;
            if (is_null($el->getParentId())) {
                $this->root = $node;
            } else {
                $parentNode = $this->getNodeById($el->getParentId());
                if (is_null($parentNode->left))
                    $parentNode->left = $node;
                else
                    $parentNode->right = $node;
            }
        }
    }
}