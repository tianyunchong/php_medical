<?php
/**
 * 项目入口文件
 * User: zyh
 * Date: 17/8/2
 * Time: 下午4:48
 */
use Phalcon\DI\FactoryDefault;
//定义下环境变量
define("ROOT", dirname(dirname(__FILE__)));
$di = new FactoryDefault();
require ROOT . "/apps/config/loaderResource.php";

echo $application->handle()->getContent();
