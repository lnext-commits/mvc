<?php
namespace Config;

class Router
{
    public function dispatch($urlMain)
    {
        $urlTemp = explode("/", $urlMain);
        $controller = preg_split("/[\.?]/", $urlTemp[1]);
        $actions = preg_split("/[\.?]/", $urlTemp[3]);
        $parament = preg_split("/[\.?]/", $urlTemp[2]);
        $controller = ucfirst($controller[0]);
        $parament = $parament[0];
        $actions = $actions[0];
        if (empty($controller)) $controller = 'IndexPage';
        if (empty($actions)) $actions = 'index';
        if (!class_exists($this->getControllersNamespace() . $controller)) $controller = "Error404";
        $controller = $this->getControllersNamespace() . $controller;
        $page       = new $controller;

        if (method_exists($page, $actions)) {
            $page->$actions($parament);
        } else {
            $page->index($parament);
        }
    }

    protected function getControllersNamespace()
    {
        return 'Controllers\\';
    }
}
