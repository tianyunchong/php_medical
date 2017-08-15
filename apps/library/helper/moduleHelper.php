<?php
/**
 * 模块操作助手
 * @author tianyunzi
 * @datetime 2017/08/14
 */
namespace Helper;

class ModuleHelper
{
    /**
     * 获取模块注册数组
     * @param  [array] $modulesArr [description]
     * @return [array]             [description]
     */
    public static function getModuleRegister(array $modulesArr)
    {
        $result = array();
        foreach ($modulesArr as $module) {
            $module_ucfirst  = ucfirst($module);
            $result[$module] = array(
                "className" => $module_ucfirst . '\\Module',
                "path"      => ROOT . "/apps/" . $module . '/Module.php',
            );
        }
        return $result;
    }
}
