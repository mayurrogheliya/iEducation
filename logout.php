<?php
session_start();
unset($_SESSION['uemail']);
header("location: login.php");
