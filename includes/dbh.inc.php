<?php
    /* Creatign database!*/
$servername = "localhost";
$username = "root";
$password = "";
$name = "contactsDB";

//creating connection
$conn = mysqli_connect($servername, $username, $password, $name);
//Checking the connection
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

//mysqli_close($conn);
?>