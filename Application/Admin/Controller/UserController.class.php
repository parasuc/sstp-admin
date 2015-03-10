<?php
namespace Admin\Controller;
use Think\Page;
class UserController extends BaseController {
    
    /**
     * 用户列表
     */
    public function index(){
        $m = M("user");
        $pageSize = isset($_GET['pageSize'])?$_GET['pageSize']:C("PAGE_SIZE");
        if (I("get.user")){
            $where = "user_name like '%s' or email like '%s'";
            $like = "%".I("get.user")."%";
            $count = $m->where($where,$like,$like)->count();// 查询满足要求的总记录数
        }else{
            $count = $m->count();// 查询满足要求的总记录数
        }
        $page = new Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
        $this->assign('page',$page);// 赋值分页输出
        if (I("get.user")){
            $where = "user_name like '%s' or email like '%s'";
            $like = "%".I("get.user")."%";
            $list = $m->where($where,$like,$like)->page($page->nowPage.",".$pageSize)->select();
        }else{
            $list = $m->page($page->nowPage.",".$pageSize)->select();
        }
        $this->assign('userList',$list);// 赋值数据集
        $this->display(); // 输出模板
    }
}