<?php
/**
 * 项目入口文件
 * User: zyh
 * Date: 17/8/2
 * Time: 下午4:48
 */
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application;
//定义下环境变量
define("ROOT", dirname(dirname(__FILE__)));
$di = new FactoryDefault();
require ROOT . "/apps/config/loaderResource.php";
require ROOT . "/apps/library/helper/moduleHelper.php";
$application = new Application($di);

//注册下模块
$modules     = array('index');
$modulesConf = \Helper\ModuleHelper::getModuleRegister($modules);
$application->registerModules($modulesConf);

echo $application->handle()->getContent();
