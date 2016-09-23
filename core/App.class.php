<?php
/**
 * 对url进行解析的核心类
 * Created by PhpStorm.
 * User: ahao
 * Date: 2016/8/26
 * Time: 23:44
 */
class APP{
    protected static $controller = 'Home';  // 控制器名
    protected static $method = 'index';  // 方法名
    protected static $params = array();  // 参数

    /**
     * 自动加载类方法
     * @param $classname 自动加载类名
     * @throws Exception
     */
    public static function autoloader($classname){
        if(APP == 'app'){
            // 控制器类文件目录
            $controller = 'app/controllers/'.$classname.'.class.php';
            // 模型类文件目录
            $model = 'app/model/'.$classname.'.class.php';
            // 核心类文件目录
            $core = 'core/'.$classname.'.class.php';
        }

        if(APP == 'web'){
            //控制器类文件目录
            $controller = 'controllers/'.$classname.'.class.php';
            //模型类文件目录
            $model = 'models/'.$classname.'.class.php';
            //核心类文件目录
            $core = '../core/'.$classname.'.class.php';
        }

        if(file_exists($controller)){
            require_once $controller;
        }else if(file_exists($model)){
            require_once $model;
        }else if(file_exists($core)){
            require_once $core;
        }else{
            throw new MyException($classname.'类文件不存在');
        }

    }

    /**
     * 重写url路由解析方法
     */
    protected static function paseURL(){
        if(isset($_GET['url'])){
            $url = explode('/',$_GET['url']);

            // 获得控制器名
            if(isset($url[0]) && !empty($url[0])){
                self::$controller = $url[0];
                unset($url[0]);
            }

            // 获得方法名
            if(isset($url[1]) && !empty($url[1])){
                self::$method = $url[1];
                unset($url[1]);
            }

            // 判断是否有其他参数
            if(isset($url)){
                self::$params = array_values($url);
            }
        }
    }

    /**
     * 项目的入口方法
     * @throws Exception
     */
    public static function run(){
        self::paseURL();

        // 得到控制器的路径
        if(APP != 'web'){
            $path = APP.'/controllers/'.self::$controller.'.class.php';
        }else{
            $path = 'controllers/'.self::$controller.'.class.php';
        }

        if(file_exists($path)){
            $c = new self::$controller;
        }else{
            throw new MyException(self::$controller.'控制器不存在');
        }

        // 执行方法
        if(method_exists($c,self::$method)){
            $m = self::$method;
            $new_params = array();
            $num = count(self::$params);
            if($num == 0){
                $c->$m($new_params);
                return ;
            }
            /**
             * 这是由于重写规则的漏洞导致只输入域名的情况下还是会解析出一个空字符串的参数
             * 假如只有一个参数并且参数为空或0
             */
            if(!($num == 1 && empty(self::$params[$num-1]))){
                // 传递参数，判断是否有参数
                if($num > 0){
                    // 判断参数的数量是否是2的倍数
                    if($num % 2 == 0){
                        // 处理参数变成映射数组
                        for($i = 0; $i < $num; $i+=2){
                            $value = self::$params[$i+1];
                            if(empty($value) && $value != "0"){
                                throw new MyException('非法参数'.self::$params[$i]."不能为空");
                            }
                            $new_params[self::$params[$i]] = self::$params[$i+1];
                        }
                    }else{
                        throw new MyException('非法参数');
                    }
                }
            }
            $c->$m($new_params);
        }else{
            throw new MyException(self::$method.'方法不存在');
        }
    }
}