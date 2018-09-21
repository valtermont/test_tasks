<?php
/**
 * Created by PhpStorm.
 * User: iwrow
 * Date: 25.03.2017
 * Time: 17:45
 */

namespace Test\Routers;


class SimpleRouter
{
    private $Url = '';

    public function Route()
    {
        $url_path = parse_url($this->Url, PHP_URL_PATH);
        $request = explode('/',trim($url_path, ' /'));
        if ($url_path=='/') {
            echo 'Main Page!';
            return;
        }

        if (!(count($request) % 2)) {
            echo 'Please, specify action!';
            return;
        }

        $module = ucfirst(strtolower(array_shift($request))); // Получили имя модуля
        $controller = ucfirst(strtolower(array_shift($request))); // Получили имя модуля
        $action = strtolower(array_shift($request)); // Получили имя действия

        $class_name = '\Test\\'.$module;
        $class_name .= '\\'.'Controllers'.'\\'.$controller.'Controller';

        if (class_exists($class_name)) {
            $obj = new $class_name();
            if (method_exists($obj,$action))
                $obj->$action();
            else
                echo 'Method '.$action.' in class '.$class_name.' not found!';
        } else {
            echo 'Class '.$class_name.' not found!';
        }
    }

    function __construct(string $url)
    {
        $this->Url = $url;
    }
}