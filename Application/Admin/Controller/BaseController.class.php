<?php
namespace Admin\Controller;

use Think\Controller;
use Org\Util\Rbac;

class BaseController extends Controller
{

    protected function _initialize()
    {
        if (! Rbac::AccessDecision()){ 
            // 未通过认证
            // 登录检查
            Rbac::checkLogin();
            // 提示错误信息 无权限
            $this->error(L('_VALID_ACCESS_'));
            //echo("没有权限");
        }
    }
}