<?php
/**
 * Created by PhpStorm.
 * User: ahao
 * Date: 2016/8/27
 * Time: 0:04
 */
class Home extends Controller{
    public function index($data = array()){
        echo "我是home控制器的index方法<br/>";
        // 加载首页页面
        var_dump($data);
        $this->show('index/index',$data);
    }
}