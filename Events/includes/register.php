<?php 
// Include functions:
include('includes/functions.php');

// Require DB connection:
require('includes/pdocon.php');


// Instantiate database object:
$db = new Pdocon;

if(isset($_POST['submit_registry'])){

    $raw_firstName      =   cleandata($_POST['firstName']);
    $raw_lastName       =   cleandata($_POST['lastName']);
    $raw_email          =   cleandata($_POST['email']);
    $raw_password       =   cleandata($_POST['password']);
    $raw_userType       = cleandata($_POST['userType']);
    $raw_admin          = cleandata($_POST['admin']);
    
    $c_firstName        =   sanitize($raw_firstName);
    $c_lastName         =   sanitize($raw_lastName);
    $c_email            =   valemail($raw_email);
    $c_password         =   sanitize($raw_password);
    $c_userType = sanitize($raw_userType);
    $c_admin = sanitize($raw_admin);
  
    $hashed_Pass        =   hashpassword($c_password);
    
    $db->query("SELECT * FROM fsc_Users WHERE email = :email");
    
    $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    if($row){
        
        echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              User already exists. Please <a href="index.php"> Login.</a>
            </div>';
        
    } else {
        
        $db->query("INSERT INTO fsc_Users(user_Id, first_Name, last_Name, email, password, user_Type) VALUES(NULL, :firstName, :lastName, :email, :password, :userType)");
        
        $db->bindvalue(':firstName', $c_firstName, PDO::PARAM_STR);
        $db->bindvalue(':lastName', $c_lastName, PDO::PARAM_STR);
        $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
        $db->bindvalue(':password', $hashed_Pass, PDO::PARAM_STR);
        $db->bindvalue(':userType', $c_userType, PDO::PARAM_STR);
        
        $run = $db->execute();
        
    if($run){
        
        if($c_userType == "Student")
        {         
            $db->query('SELECT * FROM fsc_Users WHERE email=:email'); 
    
            $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    
            $row = $db->fetchSingle();
                 
            $user_Id = $row['user_Id'];
                 
            $db->query("INSERT INTO students(user_Id) VALUES(:user_Id)");
           
            $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
           
            $run = $db->execute();
           
            $db->query('SELECT * FROM students WHERE user_Id=:user_Id'); 
            $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
           
            $row = $db->fetchSingle();
        }    
        
        if($c_userType == "Faculty")
        {
            $db->query('SELECT * FROM fsc_Users WHERE email=:email'); 
    
            $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    
            $row = $db->fetchSingle();
                 
            $user_Id = $row['user_Id'];
                 
            $db->query("INSERT INTO faculty(user_Id) VALUES(:user_Id)");
           
            $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
           
            $run = $db->execute();
           
            $db->query('SELECT * FROM faculty WHERE user_Id=:user_Id'); 
            $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
           
            $row = $db->fetchSingle();
       }    
    
       if($c_admin == "Yes")
       {
           $db= new Pdocon;
           
           $user_Id = $row['user_Id'];
           
           $db->query("INSERT INTO admin(user_Id) VALUES(:user_Id)");
           
            $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
           
            $run2 = $db->execute();
         
            $db->query('SELECT * FROM admin WHERE user_Id=:user_Id'); 
            $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
           
            $rowAdmin = $db->fetchSingle();
           
            $_SESSION['admin_data'] = array(
                 'id' => $rowAdmin['user_Id'],
                 'adminId' => $rowAdmin['admin_Id'],
             );
       }
            echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Registered successfully.
                  </div>';
                
            header("Location: index.php");
            
        } else {
            
             echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User could not be registered. Please try again later
            </div>';
        }
    }
}
?>