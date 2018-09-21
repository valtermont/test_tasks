<?php
header('Content-Type: text/html; charset=utf-8');
set_time_limit(0); //Для большого количества страниц
require_once('__autoloader.php');

use Test\RozetkaParser;

$rp = new RozetkaParser('notebooks',80004);
$rp->parse(2); //Если не указать количсетво страниц или указать 0 - подтянет все.
$pr = $rp->getProducts(); //Возвращаем массив товаров.
var_dump($pr); //Вывод для теста.
