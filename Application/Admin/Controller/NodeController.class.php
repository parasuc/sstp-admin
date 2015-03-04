<?php
namespace Admin\Controller;
use Think\Controller;
class NodeController extends Controller {
    public function index(){
        $m = M("Node");
        $this->assign("nodeList",$m->order("node_order")->select());
        $this->display();
    }
    
    public function add(){
        $m = M("Node");
        if(IS_GET){
            $this->assign("sstp_add",true);
            $this->display("edit");
        }else{
            
        }
    }
    
    public function update(){
        $m = M("Node");
        if (IS_GET){
            $this->assign("sstp_add",false);
            $this->assign("model",$m->where("id=%d",I("get.id"))->find());
            $this->display("edit");
        }else{
            
        }
        
    }
}