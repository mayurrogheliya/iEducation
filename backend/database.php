<?php
$con = new mysqli("localhost", "root", "", "iEducation");
// if(mysqli_query($con,"create database iEducation")){
//     echo "Database created successfully";
// }else{
//     echo "Error creating database: ". mysqli_error($con);
// }

mysqli_select_db($con, "iEducation");

// $q = "create table register (u_name varchar(50),u_phone int,u_email varchar(50), u_password varchar(50))";
// $q = "create table message (u_name varchar(50),u_phone int,u_email varchar(50), message varchar(300))";

// if (mysqli_query($con, $q)) {
//     echo "Table created successfully";
// }
// else{
//     echo "Error creating table: ". mysqli_error($con);
// }