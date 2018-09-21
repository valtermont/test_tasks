<?php
/**
 * Created by PhpStorm.
 * User: iwrow
 * Date: 26.03.2017
 * Time: 13:38
 */

namespace Test;


class SimpleElement implements BinaryTreeElement
{
    private $Id;
    private $ParentId;

    public function getId()
    {
        return $this->Id;
    }

    public function getParentId()
    {
        return $this->ParentId;
    }

    function __construct($id,$pid)
    {
        $this->Id = $id;
        $this->ParentId = $pid;
    }
}