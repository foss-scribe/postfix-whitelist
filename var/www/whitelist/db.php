<?php

//set connection variables
$servername = "localhost";
$username = "you_mail_db_username";
$password = "your_mail_db_password";
$dbname = "your_mail_db_name";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>