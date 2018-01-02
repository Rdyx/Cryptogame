create table compteur
(
	com_visites int null,
	last_update varchar(191) null
)
;

create table cry_users
(
	usr_id int(12) unsigned auto_increment
		primary key,
	usr_name varchar(191) not null,
	usr_password varchar(191) not null,
	usr_totalCallNumber int null,
	usr_SuccessCall int null,
	usr_BTCAdress varchar(191) null,
	usr_ETHAdress varchar(191) null,
	usr_LTCAdress varchar(191) null,
	constraint cry_users_usr_name_uindex
	unique (usr_name),
	constraint cry_users_usr_BTCAdress_uindex
	unique (usr_BTCAdress),
	constraint cry_users_usr_ETHAdress_uindex
	unique (usr_ETHAdress),
	constraint cry_users_usr_LTCAdress_uindex
	unique (usr_LTCAdress)
)
;

create table cryptos
(
	cry_id int(10) unsigned auto_increment
		primary key,
	cry_url varchar(1000) not null,
	cry_name varchar(191) not null,
	cry_fullName varchar(191) null,
	cry_last7Days varchar(191) null,
	cry_last24Hours varchar(191) null,
	cry_lastHour varchar(191) null,
	cry_volume varchar(191) null,
	cry_supply varchar(191) null,
	cry_fiatValue varchar(191) null,
	cry_btcValue varchar(191) null,
	cry_marketcap varchar(191) not null
)
;

create table topCall
(
	top_id int(12) unsigned auto_increment
		primary key,
	usr_id int(10) unsigned not null,
	cry_id int(10) unsigned not null,
	top_time varchar(191) null,
	top_startPrice varchar(191) not null,
	top_status varchar(191) null,
	top_target varchar(191) not null,
	top_startTime varchar(191) not null,
	top_description text null,
	top_endDate varchar(191) null,
	constraint topCall_user_usr_id_fk
	foreign key (usr_id) references cry_users (usr_id),
	constraint topCall_cryptos_cry_id_fk
	foreign key (cry_id) references cryptos (cry_id)
)
;

create index topCall_cryptos_cry_id_fk
	on topCall (cry_id)
;

create index topCall_user_usr_id_fk
	on topCall (usr_id)
;