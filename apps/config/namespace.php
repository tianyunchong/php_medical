<?php
/**
 * 命名空间注册
 * User: zyh
 * Date: 17/8/2
 * Time: 下午6:14
 */
$modulesArr = array(
    'common',
    'index',
);
$namespace = array();
foreach ($modulesArr as $v) {
    $v = ucfirst($v);
    //设置下模块命名空间
    $namespace['\\' . $v . '\\Controllers'] = ROOT . '/apps/' . $v . '/controllers/';
    $namespace['\\' . $v . '\\Services']    = ROOT . '/apps/' . $v . '/controllers/';
    $namespace['\\' . $v . '\\Models']      = ROOT . '/apps/' . $v . '/controllers/';
    $namespace['\\' . $v . '\\Library']     = ROOT . '/apps/' . $v . '/controllers/';
}
$namespace['\\Library'] = ROOT . '/apps/library/';
return $namespace;
