<?php
header('Content-Type: text/html; charset=utf-8');

require_once ('__autoloader.php');

use Test\Routers\SimpleRouter as Router;

$router = new Router($_SERVER['REQUEST_URI']);
$router->Route();
