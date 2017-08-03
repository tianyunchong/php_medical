<?php
/**
 * 加载资源文件
 * User: zyh
 * Date: 17/8/3
 * Time: 下午4:17
 */
use Phalcon\Mvc\View;
//注册自动加载器
$namespaceConf = new Phalcon\Config\Adapter\Php(ROOT . '/apps/config/namespace.php');
$loader        = new Phalcon\Loader();
$loader->registerNamespaces($namespaceConf->toArray());
$loader->register();
//注册下事件管理器
$di->set('dispatcher', function () {
    $dispatcher   = new \Phalcon\Mvc\Dispatcher();
    $eventManager = new \Phalcon\Events\Manager();
    $dispatcher->setEventsManager($eventManager);
    return $dispatcher;
});
//设置下视图
$di->set('view', function () {
    $view = new View();
    $view->setViewsDir('../apps/views/');
    return $view;
});
//处理下路由
$di->set('router', function () {
    return require ROOT . '/apps/config/loaderRouter.php';
});
