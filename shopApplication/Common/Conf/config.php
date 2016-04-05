<?php
return array(
    /* 数据库设置 */
    'DB_TYPE' =>  'mysql',     // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'ruitou',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => 'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX' => 'im_',    // 数据库表前缀
    'DB_PARAMS'             =>  array(),    // 数据库连接参数    
    'DB_DEBUG'              =>  TRUE,       // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  FALSE,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8


    //'配置项'=>'配置值'
	'AUTH_CONFIG'=>array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'im_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'im_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'im_auth_rule', //权限规则表
        'AUTH_USER' => 'im_admin_users'//用户信息表
    ),
    //超级管理员id,拥有全部权限,只要用户uid在这个角色组里的,就跳出认证.可以设置多个值,如array('1','2','3')
    'ADMINISTRATOR'=>array('1'),
);