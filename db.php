<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "chatterbox";

// Creating database connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if(!$conn)
{
	die("Conection unseccessful". mysqli_connect_error());
}



?>