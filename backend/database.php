<?php
$con = new mysqli("localhost", "root", "","iEducation");
// if(mysqli_query($con,"create database iEducation")){
//     echo "Database created successfully";
// }else{
//     echo "Error creating database: ". mysqli_error($con);
// }

mysqli_select_db($con,"iEducation");
// $q = "create table register (u_name varchar(50),u_phone int,u_email varchar(50), u_password varchar(50))";

// if (mysqli_query($con, $q)) {
//     echo "Table created successfully";
// }
// else{
//     echo "Error creating table: ". mysqli_error($con);
// }

$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$pasword = $_POST["password"];

$q = "insert into register(u_name,u_phone,u_email,u_password) values('$name','$phone','$email','$pasword')";

if (mysqli_query($con, $q)) {
    echo "New record created successfully";
} else {
    echo "Error: ". $q. "<br>". mysqli_error($con);
}