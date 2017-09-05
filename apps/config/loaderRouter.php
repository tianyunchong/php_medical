<?php
/**
 * 加载下路由信息
 * User: zyh
 * Date: 17/8/3
 * Time: 下午5:06
 */
use Phalcon\Mvc\Router;
$router = new Router();
$router->add(
    "/:module/:controller/:action/:params",
    array(
        'module'     => 1,
        "controller" => 2,
        "action"     => 3,
        "params"     => 4,
    )
);
$router->add(
    "/",
    array(
        'module'     => 'index',
        'controller' => 'index',
        'action'     => 'index',
    )
);
$router->handle();
return $router;
