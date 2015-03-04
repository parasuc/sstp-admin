<?php
namespace Admin\Model;

use Think\Model;

class PrivilegeModel extends Model{
    
    protected $trueTableName    =   'think_node';
    
    /**
     * 得到模块的菜单
     * @param unknown $module Admin,User
     */
    public function getMenuList($module){
        
    }
    
    public function getTopPrivileges(){
        $res = $this->where("pid=%d",0)->select();
        //dump($res);
        foreach ($res as $k=>&$v){
            $v['children'] = $this->where("pid=%d",$v['id'])->select();
            foreach ($v['children'] as $k2=>&$v2){
                $v2['children'] = $this->where("pid=%d",$v2['id'])->select();
            }
        }
        //dump($res);
        return $res;
    }
    
}