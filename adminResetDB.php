<?php
	
	
	$con=mysqli_connect("localhost","root","","test");
	$query="drop database if exists student;";
	$res=mysqli_query($con,$query);
	$query="create database student;";
	$res=mysqli_query($con,$query);
	$con=mysqli_connect("localhost","root","","student");
	
	$query="create table students ( student_no varchar(10), surname varchar(20), forename varchar(20));";
	$res=mysqli_query($con,$query);
	$query="create table modules ( module_code varchar(8), module_name varchar(20));";
	$res=mysqli_query($con,$query);
	$query="create table marks ( student_no varchar(10), module_code varchar(8), mark integer);";
	$res=mysqli_query($con,$query);
	$query="insert into students values ('20060101','Dickens','Charles'),('20060102','ApGwilym','Dafydd'), ('20060103','Zola','Emile'),('20060104','Mann','Thomas'),('20060105','Stevenson','Robert');";
	$res=mysqli_query($con,$query);
	$query="insert into modules values ('CM0001', 'Databases'),('CM0002', 'Programming Languages'),('CM0003', 'Operating Systems'),('CM0004', 'Graphics');";
	$res=mysqli_query($con,$query);
	$query="insert into marks values ('20060101', 'CM0001', 80),('20060101', 'CM0002', 65),('20060101', 'CM0003', 50),('20060102', 'CM0001', 75),('20060102', 'CM0003', 45),('20060102', 'CM0004', 70),('20060103', 'CM0001', 60),('20060103', 'CM0002', 75),('20060103', 'CM0004', 60),('20060104', 'CM0001', 55),('20060104', 'CM0002', 40),('20060104', 'CM0003', 45),('20060105', 'CM0001', 55),('20060105', 'CM0002', 50),('20060105', 'CM0004', 65);";
	$res=mysqli_query($con,$query);
	
	
	$query="drop database if exists Employee;";
	$res=mysqli_query($con,$query);
	$query="create database Employee;";
	$res=mysqli_query($con,$query);
	$con=mysqli_connect("localhost","root","","Employee");
	
	$query="CREATE TABLE emp (  empno decimal(4,0) NOT NULL,  ename varchar(10) default NULL,  job varchar(9) default NULL,  mgr decimal(4,0) default NULL,  hiredate date default NULL,  sal decimal(7,2) default NULL,  comm decimal(7,2) default NULL,  deptno decimal(2,0) default NULL);";
	$res=mysqli_query($con,$query);
	
	$query="CREATE TABLE dept (deptno decimal(2,0) default NULL,  dname varchar(14) default NULL,  loc varchar(13) default NULL);";
	$res=mysqli_query($con,$query);
	
	
	$query="INSERT INTO emp VALUES ('7369','SMITH','CLERK','7902','1980-12-17','800.00',NULL,'20'),('7499','ALLEN','SALESMAN','7698','1981-02-20','1600.00','300.00','30'), ('7521','WARD','SALESMAN','7698','1981-02-22','1250.00','500.00','30'), ('7566','JONES','MANAGER','7839','1981-04-02','2975.00',NULL,'20'), ('7654','MARTIN','SALESMAN','7698','1981-09-28','1250.00','1400.00','30'), ('7698','BLAKE','MANAGER','7839','1981-05-01','2850.00',NULL,'30'), ('7782','CLARK','MANAGER','7839','1981-06-09','2450.00',NULL,'10'), ('7788','SCOTT','ANALYST','7566','1982-12-09','3000.00',NULL,'20'), ('7839','KING','PRESIDENT',NULL,'1981-11-17','5000.00',NULL,'10'), ('7844','TURNER','SALESMAN','7698','1981-09-08','1500.00','0.00','30'), ('7876','ADAMS','CLERK','7788','1983-01-12','1100.00',NULL,'20'), ('7900','JAMES','CLERK','7698','1981-12-03','950.00',NULL,'30'), ('7902','FORD','ANALYST','7566','1981-12-03','3000.00',NULL,'20'), ('7934','MILLER','CLERK','7782','1982-01-23','1300.00',NULL,'10')";
	$res=mysqli_query($con,$query);
	
	
	$query="INSERT INTO dept VALUES ('10','ACCOUNTING','NEW YORK'),('20','RESEARCH','DALLAS'),('30','SALES','CHICAGO'),('40','OPERATIONS','BOSTON')";
	$res=mysqli_query($con,$query);
	
	
?>