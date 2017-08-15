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

    public function initialize()
    {
        $this->init();
    }

    public function init()
    {

    }

}
