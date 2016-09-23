<?php
/**
 * Created by PhpStorm.
 * User: ahao
 * Date: 2016/9/1
 * Time: 15:24
 */
class Home extends Controller{
    public function index($data = array()){
        echo "我是web应用home控制器的index方法<br/>";
        // 加载首页页面
        $this->show('index/index',$data);
    }
}