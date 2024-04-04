<?php
$con = new mysqli("localhost", "root", "", "iEducation");
// if(mysqli_query($con,"create database iEducation")){
//     echo "Database created successfully";
// }else{
//     echo "Error creating database: ". mysqli_error($con);
// }

mysqli_select_db($con, "iEducation");

// *********** register ***************
$q = "create table IF NOT EXISTS register (u_name varchar(50),u_phone int,u_email varchar(50), u_password varchar(50))";

// *********** chapter ***************
$q = "CREATE TABLE IF NOT EXISTS chapters (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    chapter_name VARCHAR(255) NOT NULL,
    chapter_description TEXT,
    chapter_pdf VARCHAR(255) NOT NULL
)";

// *********** message ***************
$q = "CREATE TABLE IF NOT EXISTS messages (
    u_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    u_name VARCHAR(255) NOT NULL,
    u_email VARCHAR(255) NOT NULL,
    u_phone VARCHAR(20) NOT NULL,
    message TEXT NOT NULL,
)";

// *********** about ***************
$q = "CREATE TABLE IF NOT EXISTS about (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
)";

// *********** course ***************
$q = "CREATE TABLE IF NOT EXISTS course (
    c_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    c_name VARCHAR(255) NOT NULL,
    c_desc TEXT NOT NULL,
    c_image VARCHAR(255) NOT NULL,
)";

// *********** admin ***************
$q = "CREATE TABLE IF NOT EXISTS admin (
    a_email VARCHAR(255) PRIMARY KEY,
    a_name VARCHAR(255) NOT NULL,
    a_password VARCHAR(255) NOT NULL,
    a_phone VARCHAR(20) NOT NULL,
    a_image VARCHAR(255) NOT NULL,
)";

// *********** topic ***************
$q = "CREATE TABLE IF NOT EXISTS topic (
    id INT AUTO_INCREMENT PRIMARY KEY,
    point1 VARCHAR(255) NOT NULL,
    point2 VARCHAR(255) NOT NULL,
    point3 VARCHAR(255) NOT NULL,
    point4 VARCHAR(255) NOT NULL,
    point5 VARCHAR(255) NOT NULL,
    chapter INT NOT NULL,
    cname VARCHAR(255) PRIMARY KEY,
)";

// if (mysqli_query($con, $q)) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($con);
// }
