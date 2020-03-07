<?php include('includes/header.php'); ?>

<?php

//Include functions
include('includes/functions.php');
?>

<?php 

//require database class files
require('includes/pdocon.php');

//instatiating our database objects
$db = new Pdocon;

//Create a query to select all users to display in the table
   
$db->query("SELECT * FROM fsc_Users WHERE email=:email");

$email  =   $_SESSION['user_data']['email'];

$db->bindValue(':email', $email, PDO::PARAM_STR);
    
//Fetch all data and keep in a result set
$row = $db->fetchSingle();

?>
  <div class="well">

    <h2 class="text-center"style="color:#006f71">My Dashboard</h2><hr>
    <br>
   </div>
   
<div class="container"> 
   <div class="rows">
  </div>  
</div>