<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => array(
        '__ADMIN__'=>__ROOT__.'/Public/Admin'
    ),

    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'db_oa',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '1qaz2wsx',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sp_',    // 数据库表前缀
    //跟踪说明
    'SHOW_PAGE_TRACE'       =>  'TRUE',
    'RBAC_ROLES'            => array(
        1=>'高层管理',
        2=>'中层领导',
        3=>'普通职员',
    ),
    'RBAC_ROLES_AUTHS'     =>array(
        1=>array('*/*'),
        2=>array('email/*','doc/*','knowledge/*','index/*',),
        3=>array('email/*','doc/showlist','index/*','public/*'),
    ),
);