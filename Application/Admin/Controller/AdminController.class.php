<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\PrivilegeModel;
use Org\Util\Rbac;
class AdminController extends BaseController {
    
    /**
     * 管理员登录
     */
    public function login(){
        if (IS_GET){
            $this->display();
        }else{
           //登录逻辑
           
           session(C('ADMIN_AUTH_KEY'),true);
           session(C('USER_AUTH_KEY'),3);
           Rbac::saveAccessList(3);
           $this->success("登录成功","../Index/index"); 
        }
    }
    
    public function logout(){
        session(C('ADMIN_AUTH_KEY'),null);
        session(C('USER_AUTH_KEY'),null);
        session('_ACCESS_LIST',null);
        $this->success("退出成功","login");
    }
    
    public function test(){
        
       // $p = new PrivilegeModel();
        //var_dump($p);
        //$list = Rbac::getAccessList(3);
        //dump($list);
        var_dump($_SESSION['_ACCESS_LIST'][MODULE_NAME]);
        
        $v =array(
          "a"=>"aa",
          "b"=>"bb",
        );
        var_dump($v);
        unset($v["bb"]);
        var_dump($v);
        //echo $v["a"];
        array_pop($v);
        echo array_pop($v);
        
        $stack = array("Java", "Php", "C++", "C#", "Ruby");
        array_pop($stack);
        print_r($stack);
        $this->display();
    }
}