create database project;

create table b_login(
log_id int(2) auto_increment primary key,
log_user varchar(30) not null,
log_pass varchar(42) not null,
log_email varchar(50) not null,
log_image varchar(255) not null,
log_active int(2) default 1 not null
);
