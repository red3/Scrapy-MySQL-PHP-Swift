drop table if exists `meizi`;
create table `meizi` (
`id` int(11) unsigned not null auto_increment comment 'id',
`title` varchar(100) not null comment '标题',
`imgsrc` varchar(200) not null comment '图片链接',
`topic_link` varchar(100) not null comment '主题链接',
`star_count` int(11)  not null  comment '点赞数',
`update_time` int(11) not null comment '状态更新时间',
primary key (`id`)
) engine = innodb default charset = utf8 comment = '豆瓣妹子表';