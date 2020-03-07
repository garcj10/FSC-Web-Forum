<?php include('header2.php'); 

include('functions.php'); 

require('pdocon.php');
    
//******************************************************
// CREATE DATABASE CONNECTION
$db = new Pdocon;

//******************************************************
// PROCESS USER LOGIN ONCE THEY CLICK ON 'SUBMIT':
if(isset($_POST['submit_login'])){
    
    $raw_email       =   cleandata($_POST['email']);
    
    $raw_password       =   cleandata($_POST['password']);
    
    $c_email             =   valemail($raw_email);            
    
    $hashed_password    =   hashpassword($raw_password);
      
 //******************************************************
    // FETCHES USER DATA TO BE USED THROUGHOUT THE SESSION
    $db->query('SELECT * FROM fsc_Users WHERE email=:email AND password=:password');
    
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    $db->bindValue(':password',$hashed_password, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    // Fetches firstName and lastName rows since they have not been been taken from the database yet: 
    if($row){
        $db_firstName   =   $row['firstName'];
    
//****************************************************
// STORES USER DATA TO BE USED THROUGHOUT THE SESSION
        $_SESSION['user_data'] = array(
    
        'firstName' => $row['first_Name'],
        'id' => $row['user_Id'],
        'email' => $row['email'],
        );

        $_SESSION['user_is_logged_in']  =  true;
        
        redirect('my_account.php');
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong>' . $db_firstName . '
                </div>');
        
    } else {
        
         echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User does not exist.
            </div>';

    }    
}

include('footer.php'); ?>