<?php
namespace Admin\Model;

use Think\Model;

class PrivilegeModel extends Model{
    
    /**
     * 得到模块的菜单
     * @param unknown $module Admin,User
     */
    public function getMenuList($module){
        
    }
    
    public function getTopPrivileges(){
        $res = $this->where("pid=%d and status=1",0)->order("sort")->select();
        //dump($res);
        foreach ($res as $k=>&$v){
            $v['children'] = $this->where("pid=%d and status=1",$v['id'])->order("sort")->select();
            foreach ($v['children'] as $k2=>&$v2){
                $v2['children'] = $this->where("pid=%d and status=1",$v2['id'])->order("sort")->select();
            }
        }
        //dump($res);
        return $res;
    }
    
}