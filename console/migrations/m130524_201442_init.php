<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}

/*
create table if not exists `user` (
  `id` int(11) unsigned not null auto_increment,
  `realname` varchar(20) default '' not null comment '真实姓名',
  `username` varchar(20) not null comment '用户昵称',
  `sex` tinyint(1) unsigned default '0' not null,
  `avatar` varchar(255) default '' not null comment '头像',
  `signature` varchar(50) default '' not null comment '个性签名',
  `auth_key` varchar(32) not null,
  `password_hash` varchar(255) not null,
  `password_reset_token` VARCHAR(255) null,
  `email` varchar(255) not null,
  `status` smallint(6) unsigned default '10' not NULL,
  `created_at` int(11) unsigned default null,
  `updated_at` int(11) unsigned DEFAULT null,
  primary key (`id`),
  unique key `username` (`username`),
  unique key `password_reset_token` (`password_reset_token`),
  unique key `email` (`email`)
) engine=InnoDB default charset = utf8 comment '用户表';*/


/*create table if not exists `menu` (
`id` int(11) unsigned not null auto_increment,
  `title` varchar(50) default '' not null,
  `pid` tinyint(4) unsigned default '0' not null,
  `sort` tinyint(4) unsigned default '0' not null,
  `url` varchar(255) default '' not null comment '链接地址',
  `hide` tinyint(1) unsigned default '0' not null comment '是否隐藏',
  `group` varchar(50) default '' not null comment '分组',
  `status` tinyint(1) default '0' not null comment '状态',
  `created_at` int(11) unsigned default null,
  `updated_at` int(11) unsigned default null,
  primary key (`id`),
  key `pid` (`pid`),
  key `sort` (`sort`),
  key `status` (`status`)
) engine=InnoDB default charset=utf8 comment '菜单表';*/


/*
create table if not exists `auth_depends` (
`id` int(11) unsigned not null auto_increment,
  `page_url` varchar(255) not null default '' comment 'page url',
  `api_url` varchar(255) not null default '' comment 'api url',
  `type` tinyint(3) unsigned not null default 1 comment '1 => page api, 2 => search api',
  `status` tinyint(1) unsigned not null default 1 comment '1 => yes, 0 => no',
  `created_at` int(11) unsigned null default null,
  `updated_at` int(11) unsigned null default null,
  primary key (`id`) using btree,
  index `page_url`(`page_url`) using btree,
  index `api_url`(`api_url`) using btree,
  index `created_at`(`created_at`) using btree,
  index `updated_at`(`updated_at`) using btree,
  constraint `auth_depends_wj1` foreign key (`page_url`) references `auth_item` (`name`) on delete cascade on update cascade,
  constraint `auth_depends_wj2` foreign key (`api_url`) references `auth_item` (`name`) on delete cascade on update cascade

) engine InnoDB character set = utf8 collate = utf8_unicode_ci  ROW_FORAT = Compact command = 'api和page对应表';*/