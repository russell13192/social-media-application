This is an implementation of a social media website that I am currently working on. It is a lamp stack (Linux Apache MySql and PHP). This application makes heavy use of MySQL. To launch this application locally you will need an apache server with the PHP language installed and you will need a MySQl server running with the following elements:

Database:
	
Name: social

Within the social database you will need the following tables with correspondingcolumns.

Table:

Name: users

Query: 

CREATE TABLE users (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
first_name varchar(25) ,
last_name varchar(25) ,
username varchar(100) ,
email varchar(100) ,
password varchar(255) ,
signup_date date ,
profile_pic varchar(255) ,
num_posts int(11) ,
num_likes int(11) ,
user_closed varchar(3) ,
friend_array text 
);

Table: 

Name: posts

Query: 

CREATE TABLE posts (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
body text ,
added_by varchar(60) ,
user_to varchar(60) ,
date_added datetime ,
user_closed varchar(3) ,
deleted varchar(3) ,
likes int(11) 
);

Table:

Name: post_comments

Query:

CREATE TABLE post_comments (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
post_body text ,
posted_by varchar(60) ,
posted_to varchar(60) ,
date_added datetime ,
removed varchar(3) ,
post_id int(11) 
);

Table:

Name: messages

Query:

CREATE TABLE messages (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_to varchar(60) ,
user_from varchar(60) ,
body text ,
date datetime ,
opened varchar(3) ,
viewed varchar(3) ,
deleted varchar(3) 
);

Table:

Name: likes

Query:

CREATE TABLE likes (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username varchar(60) ,
post_id int(11) 
);

Table:

Name: friend_requests

Query:

CREATE TABLE friend_requests (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_to varchar(60) ,
user_from varchar(60) 
);


The above queries will created needed tables and columns for this application to run. I will be updating the repository as I continue work on this project but any questions
can be emailed to me at russell13192@gmail.com

**Note XAMP is a great package for deploying this application as it comes prepackaged with all the necessary frameworks!
