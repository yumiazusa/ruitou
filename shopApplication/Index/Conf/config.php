<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'  =>array(
	'__Index__'     => __ROOT__.'/Public/Index/global',
    '__FOCUS__'     =>__ROOT__.'/Public/Focus',
	),
	//'配置项'=>'配置值'
    'TMPL_L_DELIM'          =>  '<{',
    'TMPL_R_DELIM'          =>  '}>',
    // 'SHOW_PAGE_TRACE'=> true,
    'TMPL_ACTION_ERROR'     =>  'Public:404',      // 错误跳转页
    'TMPL_ACTION_SUCCESS'   =>  'Public:jump',      // 成功页跳转
);