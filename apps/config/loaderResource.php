<?php
/**
 * 加载资源文件
 * User: zyh
 * Date: 17/8/3
 * Time: 下午4:17
 */
//注册下加载器
use Helper\ModuleHelper;
use Phalcon\Mvc\Application;
require ROOT . "/apps/library/helper/moduleHelper.php";
$loader        = new \Phalcon\Loader();
$namespaceConf = new \Phalcon\Config\Adapter\Php(ROOT . '/apps/config/namespace.php');
$loader->registerNamespaces($namespaceConf->toArray());
$loader->register();
$di->set("loader", $loader);
//注册下事件管理器
$di->set('dispatcher', function () {
    $dispatcher   = new \Phalcon\Mvc\Dispatcher();
    $eventManager = new \Phalcon\Events\Manager();
    $dispatcher->setEventsManager($eventManager);
    return $dispatcher;
});
$di->set('view', function () use ($di) {
    $view = new \Phalcon\MVC\View();
    $view->setViewsDir('../apps/' . $di["router"]->getModuleName() . '/views/');
    return $view;
});
//处理下路由
$di->set('router', function () {
    return require ROOT . '/apps/config/loaderRouter.php';
});
$di->setShared('dispatcher', function () {
    $dispatcher = new \Phalcon\MVC\Dispatcher();
    return $dispatcher;
});
$application = new Application($di);
//注册下模块
$modules     = array('index', 'regular');
$modulesConf = ModuleHelper::getModuleRegister($modules);
$application->registerModules($modulesConf);
