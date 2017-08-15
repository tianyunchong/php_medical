<?php
/**
 * 实现下module的抽象类
 * @author  tianyunchong <[<email address>]>
 * @date(2017/08/15)
 */
namespace Abstra;

abstract class ModuleAbstract
{
    public $di     = null;
    public $module = null;
    public function __construct()
    {
        $this->di     = \Phalcon\DI::getDefault();
        $this->module = $this->di->get("router")->getModuleName();
    }

    public function registerAutoloaders()
    {
        //注册自动加载器
        $moduleUc      = ucfirst($this->module);
        $loader        = new \Phalcon\Loader();
        $namespaceConf = new \Phalcon\Config\Adapter\Php(ROOT . '/apps/config/namespace.php');
        $namespaceConf = $namespaceConf->toArray();
        //添加下module的命名空间
        $namespaceConf[$moduleUc . '\Controllers'] = ROOT . '/apps/' . $this->module . '/controllers/';
        $namespaceConf[$moduleUc . '\Services']    = ROOT . '/apps/' . $this->module . '/services/';
        $loader->registerNamespaces($namespaceConf);
        $loader->register();
    }

    /**
     * 注册指定模块的服务
     */
    public function registerServices($di)
    {

        //Registering a dispatcher
        $di->set('dispatcher', function () {
            $dispatcher = new \Phalcon\MVC\Dispatcher();
            $dispatcher->setDefaultNamespace("Index\Controllers");
            return $dispatcher;
        });

        //Registering the view component
        $di->set('view', function () {
            $view = new \Phalcon\MVC\View();
            $view->setViewsDir('../apps/' . $this->module . '/views/');
            return $view;
        });
    }

}
