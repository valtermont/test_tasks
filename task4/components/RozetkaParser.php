<?php
/**
 * Created by PhpStorm.
 * User: iwrow
 * Date: 26.03.2017
 * Time: 19:24
 */

namespace Test;

use Test\Sunra\PhpSimple\HtmlDomParser;


class RozetkaParser
{
    private $CatalogName = '';
    private $CatalogIndex = 0;

    private $Products = [];

    private $CurrentPage = 1;
    private $MaxPage = 1;

    private function getCurrentUrl()
    {
        $rozetka_link = 'http://rozetka.com.ua/'.$this->CatalogName.'/c'.$this->CatalogIndex.'/filter/';
        if ($this->CurrentPage==1)
            return $rozetka_link;
        else
            return $rozetka_link.'page='.$this->CurrentPage;
    }

    public function getProducts()
    {
        return $this->Products;
    }

    public function parse($count_page = -1)
    {
        $this->CurrentPage = 1;
        $this->Products = [];
        if (!($count_page>0)) {
            $count_page = &$this->MaxPage;
        }

        while ($this->CurrentPage <= min($this->MaxPage,$count_page)) {
            $dom = HtmlDomParser::file_get_html($this->getCurrentUrl());
            $cat = $dom->getElementById('catalog_goods_block');
            foreach($cat->find('.g-i-tile-catalog') as $element){
                $product = new Product();
                $title = $element->find('.g-i-tile-i-title',0);
                if (!is_null($title)) {
                    $product->name = trim($title->text());
                    $link = $title->find('a',0);
                    if (!is_null($link)) {
                        $product->link = trim($link->href);
                    }
                    foreach($element->find('script') as $el){
                        $js = $el->outertext();
                        $price_start = mb_strpos($js,'var pricerawjson = "');
                        if ($price_start!==false) {
                            $price_start += mb_strlen('var pricerawjson = "');
                            $price_end = mb_strpos($js,'"',$price_start);
                            $price_info = json_decode(rawurldecode(mb_substr($js,$price_start,$price_end-$price_start)),true);
                            $product->price = $price_info['price'];
                        }
                    }
                    $this->Products[] = $product;
                }
            }
            foreach($cat->find('.paginator-catalog-l-i a') as $element){
                $page_i = trim($element->text());
                if (is_numeric($page_i)) {
                    $this->MaxPage = (int)$page_i;
                }
            }
            $this->CurrentPage += 1;
        }
    }

    public function __construct($c_name, $c_index)
    {
        $this->CatalogName = $c_name;
        $this->CatalogIndex = (int)$c_index;
    }
}