create table IF NOT EXISTS cry_users
(
	usr_id int(12) unsigned auto_increment
		primary key,
	usr_name varchar(255) not null,
	usr_password varchar(255) not null,
	usr_totalCallNumber int null,
	usr_SuccessCall int null
)
;

create table IF NOT EXISTS cryptos
(
	cry_id int(10) unsigned auto_increment
		primary key,
	cry_url varchar(1000) not null,
	cry_name varchar(255) not null,
	cry_fullName varchar(255) null,
	cry_last7Days varchar(255) null,
	cry_last24Hours varchar(255) null,
	cry_lastHour varchar(255) null,
	cry_volume varchar(255) null,
	cry_supply varchar(255) null,
	cry_fiatValue varchar(255) null,
	cry_marketcap varchar(255) not null
)
;

create table IF NOT EXISTS topCall
(
	top_id int(12) unsigned auto_increment
		primary key,
	usr_id int unsigned not null,
	cry_id int(10) unsigned not null,
	top_time varchar(255) null,
	top_startPrice int not null,
	top_status varchar(255) null,
	top_target int not null,
	top_startTime datetime not null,
	constraint topCall_user_usr_id_fk
	foreign key (usr_id) references cry_users (usr_id),
	constraint topCall_cryptos_cry_id_fk
	foreign key (cry_id) references cryptos (cry_id)
)
;

create index topCall_user_usr_id_fk
	on topCall (usr_id)
;

create index topCall_cryptos_cry_id_fk
	on topCall (cry_id)
;