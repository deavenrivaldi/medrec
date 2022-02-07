create database if not exists medrec;
USE medrec;

#create table for admin_info
CREATE TABLE admin_info(
	uid int,
    employee_id varchar(255) not null,
    full_name varchar(255) not null,
    gender enum("Male", "Female") not null,
    primary key(uid)
);

#create table for admin_login
CREATE TABLE admin_login(
	uid int,
    password varchar(255) not null,
    primary key(uid),
    foreign key(uid) references admin_info(uid) on delete cascade
);

#create table for hospital_info
CREATE TABLE hospital_info(
	hospital_id int auto_increment,
    hospital_name varchar(255) not null,
    manager varchar(255) not null,
    address varchar(255) not null,
    phone_number varchar(20) not null,
    email varchar(255),
    primary key(hospital_id)
);

#create table for hospital_admin
CREATE TABLE hospital_admin(
	uid int,
    hospital_id int,
    primary key(uid, hospital_id),
    foreign key(uid) references admin_info(uid),
    foreign key(hospital_id) references hospital_info(hospital_id)
);

#create table for patient info
CREATE TABLE patient_info(
	patient_id varchar(21),
    full_name varchar(255) not null,
    gender enum("Male", "Female") not null,
    date_of_birth date not null,
    address varchar(255) not null,
    phone_number varchar(20) not null,
    email varchar(255),
    image_url varchar(255),
    primary key(patient_id)
);

#create table for record info
CREATE TABLE record_info(
	record_id int auto_increment,
    patient_id varchar(21),
    date_of_check datetime not null,
    doctor varchar(255) not null,
    action varchar(255) not null,
    diagnose varchar(255) not null,
    primary key(record_id),
    foreign key(patient_id) references patient_info(patient_id)
);

#create table for record_admin
CREATE TABLE record_admin(
	record_id int,
    input_by int,
    input_date datetime,
    primary key(record_id),
    foreign key(record_id) references record_info(record_id)
);

#create table for diagnosis_list
CREATE TABLE diagnosis_list(
	diagnosis_id int auto_increment,
    category varchar(50),
    diagnosis varchar(255),
    primary key(diagnosis_id)
);

#create table for doctor_specialization
CREATE TABLE doctor_specialization(
	sp_id int auto_increment,
    category varchar(1),
    honorary varchar(10),
    specialization varchar(255),
    primary key(diagnosis_id)
);
