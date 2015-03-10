<?php
namespace Admin\Controller;

use Admin\Model\PrivilegeModel;

class PrivilegeController extends BaseController
{

    public function index()
    {
        $m = new PrivilegeModel();
        $topPrivileges = $m->getTopPrivileges();
        $this->assign("topPrivileges", $topPrivileges);
        $this->display();
    }

    public function add()
    {
        if (IS_GET) {
            $m = new PrivilegeModel();
            $topPrivileges = $m->getTopPrivileges();
            $this->assign("topPrivileges", $topPrivileges);
            $this->assign("sstp_add", true);
            $this->display("edit");
        } else {
            $m = new PrivilegeModel();
            $pnode = $m->where("id=%d", I("post.pid"))->find();
            if (isset($pnode) && isset($pnode['level'])) {
                $new_level = $pnode['level'] + 1;
            } else {
                $new_level = 1;
            }
            if (! $m->create(array(
                "title" => I("post.title"),
                "pid" => I("post.pid"),
                "name" => I("post.name"),
                "remark" => I("post.remark"),
                "icon" => I("post.icon"),
                "status" => 1,
                "level" => $new_level,
                "sort" => I("post.sort"),
                "type" => I("post.type")
            ), 1)) {
                // 指定新增数据
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                exit($m->getError());
            } else {
                // 验证通过 可以进行其他数据操作
                $m->add();
                $this->success("添加成功！");
            }
        }
    }

    public function update()
    {
        if (IS_GET) {
            $m = new PrivilegeModel();
            $topPrivileges = $m->getTopPrivileges();
            $this->assign("topPrivileges", $topPrivileges);
            $this->assign("model", $m->where("id=%d", I("get.id"))
                ->find());
            $this->assign("sstp_add", false);
            $this->display("edit");
        } else {
            $m = new PrivilegeModel();
            $m->where("id=%d", I("post.id"))
                ->data(array(
                "title" => I("post.title"),
                "pid" => I("post.pid"),
                "name" => I("post.name"),
                "remark" => I("post.remark"),
                "icon" => I("post.icon"),
                "sort" => I("post.sort"),
                "type" => I("post.type")
            ))
                ->save();
            $this->success("修改成功", "index");
        }
    }

    public function del()
    {
        $m = new PrivilegeModel();
        $m->where("id=%d", I("get.id"))->save(array(
            "status" => 0
        ));
        $this->success("删除成功", "/Admin/Privilege/index");
    }

    public function test()
    {
        $m = new PrivilegeModel();
        $m->getTopPrivileges();
    }
}