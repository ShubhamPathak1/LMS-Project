CREATE TABLE members (uid INT PRIMARY KEY AUTO_INCREMENT, username varchar(100) not null, emailid varchar(100) not null, pwd varchar(255) not null, regdate date DEFAULT CURRENT_DATE, creditpoint bigint default 1000) AUTO_INCREMENT=101;