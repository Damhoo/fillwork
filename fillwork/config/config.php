<?php
return [
	// 默认时区
	'DEFAULT_TIMEZONE' => 'PRC',
	// 默认开启session
	'SESSION_AUTO_START' => true,
	// 开启多应用
	'MULTI_APP' => true,
	// URL模式(0.传统方式;1.pathinfo方式;2.rewrite方式)
	'URL_MODE' => 0,

	// 默认行为
	'DEFAULT_MODEL' => 'index',
	'DEFAULT_CONTROLLER' => 'Index',
	'DEFAULT_ACTION' => 'index',
	'MODE_VAR' => 'm',
	'CONTROLLER_VAR' => 'c',
	'ACTION_VAR' => 'a',

	// 默认模块(可以自行拓展添加其他模块)
	'MODULE' => [
		'FRONT' => 'index',
		'BACKEND' => 'admin'
	],

	// DATABASE连接参数
	'DATABASE' => [
		'TYPE' => 'mysql',
		'HOST' => 'localhost',
		'PORT' => '3306',
		'USER' => 'root',
		'PASSWORD' => 'root',
		'DBNAME' => 'help',
		'CHARSET' => 'utf8',
		'PREFIX' => 'fw_'
	],

	// 验证码参数
	'CAPTCHA' => [
		'LENGTH' => 6,
		'WIDTH' => 120,
		'HEIGHT' => 50
	],

	//LOG
	'LOG_START' => true,
	'LOG_PATH' => ROOT_PATH.'/log',

	// ERROR
	'ERROR_URL' => '',
	'ERROR_MSG' => '网站出错了，请稍候再试...'
];