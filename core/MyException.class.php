<?php
/**
 * Created by PhpStorm.
 * User: ahao
 * Date: 2016/8/26
 * Time: 23:45
 */
class MyException extends Exception{
    /**
     * 错误页面加载
     */
    public static function showError($msg){
        if(APP != 'web'){
            $err_dir = APP.'/views/error/error.php';
        }else{
            $err_dir = 'views/error/error.php';
        }
        // 判断错误页面是否存在
        if(file_exists($err_dir)){
            require $err_dir;
        }else{
            echo "错误信息加载页面不存在";
        }
    }
}