create table `group`(
	id int(10) not null AUTO_INCREMENT,
	`level` tinyint(1) not null default 3,
	name varchar(50) not null default '',
	regist_datetime datetime not null,
	primary key (id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

create table `user`(
	id int(10) not null AUTO_INCREMENT,
	username varchar(40) not null UNIQUE,
	password varchar(32) not null,
	fullname varchar(32) not null,
	sex tinyint(1) not null default 1,
	birthday date default null,
	address varchar(255) not null default '',
	email varchar(40) not null default '',
	group_id int(10) not null,
	primary key(id),
	CONSTRAINT FK_user_group foreign key(group_id) references `group`(id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

create table friend_request(
	id int(10) not null AUTO_INCREMENT,
	user_id int(10) not null,
	user_id_to int(10) not null,
	regist_datetime datetime default null,
	primary key(id),
	constraint FK_friend_request_user foreign key(user_id) references `user`(id),
	constraint FK_friend_request_user_to foreign key(user_id_to) references `user`(id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

create table friend_relation(
	id int(10) not null AUTO_INCREMENT,
	user_id int(10) not null,
	user_id_to int(10) not null,
	regist_datetime datetime default null,
	primary key(id),
	constraint FK_friend_relation_user foreign key(user_id) references `user`(id),
	constraint FK_friend_relation_user_to foreign key(user_id_to) references `user`(id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

create table message_log(
	id int(10) not null AUTO_INCREMENT,
	user_id int(10) not null,
	user_id_to int(10) not null,
	regist_datetime datetime default null,
	primary key(id),
	constraint FK_message_log_user foreign key(user_id) references `user`(id),
	constraint FK_message_log_user_to foreign key(user_id_to) references `user`(id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

create table favorite(
	id int(10) not null AUTO_INCREMENT,
	user_id int(10) not null,
	user_id_to int(10) not null,
	regist_datetime datetime default null,
	primary key(id),
	constraint FK_favorite_user foreign key(user_id) references `user`(id),
	constraint FK_favorite_user_to foreign key(user_id_to) references `user`(id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;


create table follow(
	id int(10) not null AUTO_INCREMENT,
	user_id int(10) not null,
	user_id_to int(10) not null,
	regist_datetime datetime default null,
	primary key(id),
	constraint FK_follow_user foreign key(user_id) references `user`(id),
	constraint FK_follow_user_to foreign key(user_id_to) references `user`(id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

create table pictures(
	id int(10) not null AUTO_INCREMENT,
	url text,
	`view` int(10) not null default 0,
	like_number int(10) not null default 0,
	regist_datetime datetime default null,
	user_id int(10) not null,
	primary key(id),
	constraint FK_pictures_user foreign key (user_id) references `user`(id) 
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

create table `like`(
	id int(10) not null AUTO_INCREMENT,
	user_id int(10) not null,
	pictures_id int(10) not null,
	primary key(id,user_id,pictures_id),
	constraint FK_like_user foreign key (user_id) references `user`(id),
	constraint FK_like_pictures foreign key (pictures_id) references pictures(id)
)ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;

