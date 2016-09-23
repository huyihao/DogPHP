<?php
/**
 * Created by PhpStorm.
 * User: ahao
 * Date: 2016/8/26
 * Time: 23:49
 */
echo "<meta charset='UTF-8'>";
require_once 'core/App.class.php';
require_once 'config/constants.php';
//require_once 'app/controllers/Home.class.php';
//require_once 'app/controllers/Test.class.php';

//echo $_GET['url']; exit;
define('APP','app');
spl_autoload_register(array('App','autoloader'));

/*
 * 接收控制器和方法名
 * 默认控制器是home
 * 默认方法是index
 */
//$controller = isset($_GET['c']) ? $_GET['c'] : 'home';
//$method = isset($_GET['a']) ? $_GET['a'] : 'index';

// 实例化控制器对象
//$ct_obj = new $controller;

// 调用控制器方法
//$ct_obj->$method();

try{
    App::run();
}catch (MyException $e){
    MyException::showError($e->getMessage());
//    $e->showError(($e->getMessage()));
}
$db = Model::getSingleletOn();
//print_r($db);
//直接执行sql语句
//$result1 = $db->queryString('select * from users where username=:username',array(':username'=>'zhang'));

//查询某个表
//$result2 = $db->select('users');

//查询某个表，并增加where条件
//$result3 = $db->where('where username=:username')->select('users',array(':username'=>'zhang'));

//查询单条数据
//$result4 = $db->where('where id=:id')->find('users',array(':id'=>'3'));

//插入数据
//$data = array(':username'=>'zhang6',':userpass'=>md5(123456),':create_time'=>time());
//$result5 = $db->insert('users',$data);

//更新数据
//$data = array(':username'=>'lisi',':userpass'=>md5(456789));
//$where = array(':id'=>8);
//$result6 = $db->where('where id=:id')->update('users',$data,$where);

//删除数据
$result7 = $db->where('where id=:id')->delete('users',array('id'=>8));

echo "<pre>";
print_r($result7);