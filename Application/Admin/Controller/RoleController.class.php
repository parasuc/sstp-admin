<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\RoleModel;
use Admin\Model\PrivilegeModel;

class RoleController extends Controller {
    public function index(){
        $m = new RoleModel();
        $this->assign("roleList",$m->where("status=1")->select());
        $this->display();
    }
    
    public function add(){
        $m = new RoleModel();
        if (IS_GET){
            $this->assign("sstp_add",true);
            $this->assign("roleList",$m->where("status=1")->select());
            $this->display("edit");
        }else{
            if($m->create(array(
               "name"=>I("post.name"), 
               "pid"=>I("post.pid"), 
               "remark"=>I("post.remark"), 
                "status"=>1
            ))){
                $m->add();
                $this->success("添加成功");
            }else{
               $this->error($m->getError());
            }
        }
    }
    
    public function del(){
        $m = new RoleModel();
        $m->where("id=%d",I("get.id"))->save(array(
            "status"=>0
        ));
        $this->success("删除成功","/Admin/Role/index");
    }
    
    public function edit_privilege(){
        $m = new RoleModel();
        if (IS_GET){
            $mrole = new PrivilegeModel();
            $this->assign("topPrivileges",$mrole->getTopPrivileges());
            $pids = $m->query("select node_id from ".C("RBAC_ACCESS_TABLE")." where role_id=%d",I("get.id"));
            $privilegeIds = array();
            foreach ($pids as $p){
                array_push($privilegeIds, $p['node_id']);
            }
            $this->assign("privilegeIds",$privilegeIds);
            $this->display();
        }else{
            //var_dump(I("post.privilegeIds"));
            $m->execute("delete from ".C("RBAC_ACCESS_TABLE")." where role_id=%d",I("post.roleId"));
            foreach (I("post.privilegeIds") as $pid){
                $m->execute("insert into ".C("RBAC_ACCESS_TABLE")." (role_id,node_id) values (%d,%d)",I("post.roleId"),$pid);
            }
            $this->success("编辑成功");
        };
    }
    
    public function update(){
        $m = new RoleModel();
        if (IS_GET){
            $this->assign("sstp_add",false);
            $this->assign("model",$m->where("id=%d",I("get.id"))->find());
            $this->assign("roleList",$m->where("status=1")->select());
            $this->display("edit");
        }else{
            $m->data(array(
               "name"=>I("post.name"), 
               "pid"=>I("post.pid"), 
               "remark"=>I("post.remark"),
            ))->save();
            $this->success("修改成功");
            
        }
    }
}