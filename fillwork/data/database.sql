CREATE DATABASE `help` DEFAULT CHARSET=UTF8;

CREATE TABLE `admin`(
	admin_id int unsigned not null primary key auto_increment,
	account varchar(24) not null default '',
	nickname varchar(32) not null default '',
	password varchar(255) not null default '',
	salt varchar(32) not null default '',
	email varchar(128) not null default '',
	telephone char(11) not null default '',
	status tinyint unsigned not null default 0,
	login_failed tinyint unsigned not null default 0,
	login_ip char(15) not null default '0.0.0.0',
	login_time int unsigned not null default 0,
	delete_time int unsigned not null default 0,
	deleted tinyint unsigned not null default 0,
	UNIQUE `account` (`account`),
	UNIQUE `nickname` (`nickname`),
	UNIQUE `email` (`email`),
	UNIQUE `telephone` (`telephone`)
)engine=myisam default charset UTF8;

create table log(
	`id` int unsigned not null primary key auto_increment,
	`handle` varchar(24) not null default '',
	`remark` varchar(255) not null default '',
	`user` varchar(24) not null default '',
	`ip` char(15) not null default '0.0.0.0',
	`create_time` int unsigned not null default 0,
	KEY `user` (`user`),
	KEY `create_time` (`create_time`)
)engine=myisam default charset utf8;

create table group(
	`id` int unsigned not null primary key auto_increment,
	`name` varchar(24) not null default '',
	`remark` varchar(255) not null default '',
	`rules` varchar(24) not null default '',
	`status` tinyint unsigned not null default 1,
	`create_time` int unsigned not null default 0,
	`delete_time` int unsigned not null default 0,
	`deleted` tinyint unsigned not null default 0,
	UNIQUE `name` (`name`)
)engine=myisam default charset utf8;

create table access(
	`uid` int unsigned not null,
	`gid` int unsigned not null
)engine=myisam default charset utf8;

create table rule(
	`id` int unsigned not null primary key auto_increment,
	`name` varchar(24) not null default '',
	`remark` varchar(255) not null default '',
	`rules` varchar(24) not null default '',
	`status` tinyint unsigned not null default 1,
	`create_time` int unsigned not null default 0,
	`delete_time` int unsigned not null default 0,
	`deleted` tinyint unsigned not null default 0,
	UNIQUE `name` (`name`)
)engine=myisam default charset utf8;