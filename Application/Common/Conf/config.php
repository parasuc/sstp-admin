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
    
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__'    => __ROOT__ . '/assets/img',
        '__CSS__'    => __ROOT__ . '/assets/css',
        '__JS__'     => __ROOT__ . '/assets/js',
    ),
    
);