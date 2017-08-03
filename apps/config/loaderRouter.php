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
    "/admin/:controller/a/:action/:params",
    array(
        "controller" => 1,
        "action"     => 2,
        "params"     => 3,
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
