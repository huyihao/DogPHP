<?php
/**
 * Created by PhpStorm.
 * User: ahao
 * Date: 2016/8/26
 * Time: 23:48
 */
echo "<meta charset='UTF-8'>";
//echo "我是web的入口文件<br/>";
require_once "../core/App.class.php";

// 注册后台应用地址
define('APP','web');

spl_autoload_register(array('App','autoloader'));

try{
    App::run();
}catch (MyException $e){
    $e->showError($e->getMessage());
}
