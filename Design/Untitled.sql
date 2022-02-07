CREATE TABLE `hospital_admin` (
  `uid` int,
  `hospital_id` int,
  PRIMARY KEY (`uid`, `hospital_id`)
);

CREATE TABLE `admin_info` (
  `uid` int PRIMARY KEY,
  `employee_id` varchar(255),
  `full_name` varchar(255),
  `gender` enum
);

CREATE TABLE `admin_login` (
  `uid` int PRIMARY KEY,
  `password` varchar(255)
);

CREATE TABLE `hospital_info` (
  `hospital_id` int PRIMARY KEY AUTO_INCREMENT,
  `hospital_name` varchar(255),
  `manager` varchar(255),
  `address` varchar(255),
  `phone_num` varchar(255),
  `email` varchar(255)
);

CREATE TABLE `patient_info` (
  `patient_id` varchar(21) PRIMARY KEY,
  `full_name` varchar(255),
  `gender` enum,
  `date_of_birth` date,
  `address` varchar(255),
  `phone_num` varchar(255),
  `email` varchar(255),
  `image_url` varchar(255)
);

CREATE TABLE `record_info` (
  `record_id` int PRIMARY KEY AUTO_INCREMENT,
  `patient_id` varchar(21),
  `date_of_check` date,
  `doctor` varchar(255),
  `action` varchar(255),
  `diagnose` varchar(255),
  `note` varchar(255)
);

CREATE TABLE `record_admin` (
  `record_id` int PRIMARY KEY,
  `input_by` int,
  `input_date` datetime
);

CREATE TABLE `doctor_specialization` (
  `sp_id` int PRIMARY KEY AUTO_INCREMENT,
  `category` varchar(1),
  `honor` varchar(10),
  `specialization` varchar(255)
);

CREATE TABLE `diagnosis_list` (
  `diagnosis_id` int PRIMARY KEY AUTO_INCREMENT,
  `category` varchar(50),
  `diagosis` varchar(255)
);

ALTER TABLE `hospital_admin` ADD FOREIGN KEY (`hospital_id`) REFERENCES `hospital_info` (`hospital_id`);

ALTER TABLE `hospital_admin` ADD FOREIGN KEY (`uid`) REFERENCES `admin_info` (`uid`);

ALTER TABLE `record_admin` ADD FOREIGN KEY (`input_by`) REFERENCES `admin_info` (`uid`);

ALTER TABLE `record_admin` ADD FOREIGN KEY (`record_id`) REFERENCES `record_info` (`record_id`);

ALTER TABLE `record_info` ADD FOREIGN KEY (`patient_id`) REFERENCES `patient_info` (`patient_id`);

ALTER TABLE `admin_info` ADD FOREIGN KEY (`uid`) REFERENCES `admin_login` (`uid`);

ALTER TABLE `record_info` ADD FOREIGN KEY (`doctor`) REFERENCES `doctor_specialization` (`specialization`);

ALTER TABLE `record_info` ADD FOREIGN KEY (`diagnose`) REFERENCES `diagnosis_list` (`diagosis`);

