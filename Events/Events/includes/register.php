<?php 
include('header2.php'); 

//Include functions
include('includes/functions.php');

//require database class files
require('includes/pdocon.php');


//instatiating our database objects
$db = new Pdocon;

if(isset($_POST['submit_registry'])){

    $raw_firstName      =   cleandata($_POST['firstName']);
    $raw_lastName       =   cleandata($_POST['lastName']);
    $raw_email          =   cleandata($_POST['email']);
    $raw_password       =   cleandata($_POST['password']);
    
    
    $c_firstName             =   sanitize($raw_firstName);
    $c_lastName              =   sanitize($raw_lastName);
    $c_email            =   valemail($raw_email);
    $c_password         =   sanitize($raw_password);
    
    $hashed_Pass        =   hashpassword($c_password);
    
    
    $db->query("SELECT * FROM fsc_Users WHERE email = :email");
    
    $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    if($row){
        
        echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              User already exists. Please <a href="index.php"> Login.</a>
            </div>';
        
    }else{
        
        $db->query("INSERT INTO fsc_Users(user_Id, first_Name, last_Name, email, password) VALUES(NULL, :firstName, :lastName, :email, :password)");
        
        $db->bindvalue(':firstName', $c_firstName, PDO::PARAM_STR);
        $db->bindvalue(':lastName', $c_lastName, PDO::PARAM_STR);
        $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
        $db->bindvalue(':password', $hashed_Pass, PDO::PARAM_STR);
        
        $run = $db->execute();
        
        if($run){
            
            echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Registered successfully.
                  </div>';
                
              header("Location: index.php");
            
            
        }else{
            
             echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User could not be registered. Please try again later
            </div>';
        }
    }
}

include('footer.php'); ?>