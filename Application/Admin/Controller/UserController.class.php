<?php
namespace Admin\Controller;
use Think\Page;
class UserController extends BaseController {
    
    /**
     * 用户列表
     */
    public function index(){
        $m = M("user");
        $list = $m->page($_GET['p'].",".C("PAGE_SIZE"))->select();
        $this->assign('userList',$list);// 赋值数据集
        $count      = $m->count();// 查询满足要求的总记录数
        $page       = new Page($count,C("PAGE_SIZE"));// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
}