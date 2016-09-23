<?php
/**
 * 所有控制器的基类
 * Created by PhpStorm.
 * User: ahao
 * Date: 2016/8/26
 * Time: 23:45
 */
class Controller{
    public function show($page,$data=array()){
        if(APP != 'web'){
            $url = "app/views/".$page.".php";
        }else{
            $url = "views/".$page.".php";
        }
        // 判断页面是否存在
        if(file_exists($url)){
            require_once $url;
        }else{
            throw new MyException('模板文件'.$page.'.php不存在');
        }
    }
}