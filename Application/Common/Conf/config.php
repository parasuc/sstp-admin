<?php
return array(
	//'配置项'=>'配置值'
    '__PUBLIC__' => '/assets',
    
    'URL_MODEL' => '2', //URL模式
    'URL_HTML_SUFFIX' => '',
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'sstp', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '123456', // 密码
    'DB_PORT' => 3306, // 端口
    'DB_PREFIX' => 'ss_', // 数据库表前缀
    
    'SESSION_AUTO_START'=>true,
    'USER_AUTH_ON'              =>true,
    'USER_AUTH_TYPE'            =>1,        // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>'authId',    // 用户认证SESSION标记
    'ADMIN_AUTH_KEY'            =>'administrator',
    'USER_AUTH_MODEL'           =>'User',    // 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>'md5',    // 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>'/User/Login/index',// 默认认证网关
    'NOT_AUTH_MODULE'           =>'Public,Login',    // 默认无需认证模块
    'REQUIRE_AUTH_MODULE'       =>'',        // 默认需要认证模块
    'REQUIRE_AUTH_ACTION'       =>'',        // 默认需要认证操作
    'GUEST_AUTH_ON'             =>false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'             =>0,        // 游客的用户ID
    'RBAC_ROLE_TABLE'           =>'ss_role',
    'RBAC_USER_TABLE'           =>'ss_role_user',
    'RBAC_ACCESS_TABLE'         =>'ss_access',
    'RBAC_NODE_TABLE'           =>'ss_privilege',
    'SHOW_PAGE_TRACE'=>1,//显示调试信息
    
    'SUPPORT_ENCRYPTION_METHOD'=>array(
        "table","rc4-md5","salsa20","chacha20","aes-256-cfb","aes-192-cfb","aes-128-cfb","rc4"
    ),
    'SUPPORT_NODE_STATUS'=>array(
        "0"=>array(
          "name"=>"调整中",
          "class"=>"bg-orange"  
        ),
        "1"=>array(
          "name"=>"可用",
          "class"=>"bg-green"  
        ),
        "2"=>array(
          "name"=>"废弃",
          "class"=>"bg-gray"  
        )
    ),
    
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__'    => __ROOT__ . '/assets/img',
        '__CSS__'    => __ROOT__ . '/assets/css',
        '__JS__'     => __ROOT__ . '/assets/js',
    )
    
);