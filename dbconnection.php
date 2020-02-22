<?php 

    // Function used to connect to database (takes four parameters)
    // name of server, username of the server, password, name of database

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if (!$connection)
{
    die("Connection failed: ") . mysqli_connect_error();
}
