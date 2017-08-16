<?php
/**
 * 控制器基类
 * User: zyh
 * Date: 17/8/3
 * Time: 下午4:27
 */
namespace Library;

use Phalcon\Mvc\Controller;

/**
 * Class BaseController
 * @package Library
 */
class BaseController extends Controller
{
    public $module     = null;
    public $controller = null;
    public $action     = null;
    public function initialize()
    {
        $this->module     = $this->di->get("router")->getModuleName();
        $this->controller = $this->di->get("router")->getControllerName();
        $this->action     = $this->di->get("router")->getActionName();
        $this->setView();
        $this->init();
    }

    public function init()
    {

    }

    //设置下视图对象
    public function setView()
    {
        $this->view->setViewsDir(ROOT . '/apps/' . $this->module . '/views/');
    }

}
