<?php include('header2.php'); 

include('functions.php'); 

require('pdocon.php');
    
//*********************************************************************************
// CREATE DATABASE CONNECTIONS. ONE FOR FSC_USERS QUERY, ONE FOR STUDENTS QUERY, ONE FOR ADMIN QUERY.
$dbUsers = new Pdocon;
$dbAdmin = new Pdocon;
$dbStudent = new Pdocon;
$dbFaculty = new Pdocon;
//******************************************************
// PROCESS USER LOGIN ONCE THEY CLICK ON 'SUBMIT':
if(isset($_POST['submit_login'])) {
    
    $raw_email       =   cleandata($_POST['email']);
    $raw_password       =   cleandata($_POST['password']);
    
    $c_email             =   valemail($raw_email);            
    $hashed_password    =   hashpassword($raw_password);
      
 //******************************************************
    // FETCHES USER DATA TO BE USED THROUGHOUT THE SESSION
    $dbUsers->query('SELECT * FROM fsc_Users WHERE email=:email AND password=:password'); 
    
    $dbUsers->bindValue(':email', $c_email, PDO::PARAM_STR);
    $dbUsers->bindValue(':password',$hashed_password, PDO::PARAM_STR);
    
    $row = $dbUsers->fetchSingle();
//******************************************************
    // TAKES THE USER ID OF THE ACCOUNT THAT JUST LOGGED IN,
    // USES THAT TO ACCESS THEIR DATA FROM ADMIN (IF THEY ARE AN ADMIN.)
    $user_Id = $row['user_Id'];
    
    $dbAdmin->query('SELECT * FROM admin WHERE user_Id=:user_Id');
    
    $dbAdmin->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
    
    $rowAdmin = $dbAdmin->fetchSingle(); 
//******************************************************
    // TAKES THE USER ID OF THE ACCOUNT THAT JUST LOGGED IN,
    // USES THAT TO ACCESS THEIR DATA FROM STUDENT (IF THEY ARE AN STUDENT.)
    $dbStudent->query('SELECT * FROM students WHERE user_Id=:user_Id');
        
    $dbStudent->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
    
    $rowStudent = $dbStudent->fetchSingle(); 
    
    $dbFaculty->query('SELECT * FROM faculty WHERE user_Id=:user_Id');
        
    $dbFaculty->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
    
    $rowFaculty = $dbFaculty->fetchSingle(); 
    
    if($row) {
        $dbUsers_firstName   =   $row['first_Name'];
        $dbUsers_lastName   =   $row['last_Name']; 
//****************************************************
// STORES USER DATA TO BE USED THROUGHOUT THE SESSION
        $_SESSION['user_data'] = array(
    
        'firstName' => $row['first_Name'],
        'lastName' => $row['last_Name'],
        'id' => $row['user_Id'],
        'email' => $row['email'],
        'userType' => $row['user_Type']
        );
    
//****************************************************
// RETRIEVES ADMIN DATA TO BE USED THROUGHOUT THE SESSION
    if($rowAdmin)
    {
         $_SESSION['admin_data'] = array(
            
        'id' => $rowAdmin['user_Id'],
        'adminId' => $rowAdmin['admin_Id'],
        );
           $_SESSION['is_Admin'] = true;
    } 

//****************************************************
// RETRIEVES STUDENT DATA TO BE USED THROUGHOUT THE SESSION
        if($rowStudent)
        {
            $_SESSION['student_data'] = array(
            
                'id' => $rowStudent['user_Id'],
                'studentId' => $rowStudent['student_Id'],
                'RAMID' => $rowStudent['RAM_ID'],
                'major' => $rowStudent['major'],
                'collegeLevel' => $rowStudent['college_Level'],
                'clubs' => $rowStudent['student_Clubs'],
                'sports' => $rowStudent['student_Sports']
        ); 
              $_SESSION['is_Student'] = true;
        }
        
        if($rowFaculty)
        {
            $_SESSION['faculty_data'] = array(
            
                'id' => $rowFaculty['user_Id'],
                'facultyId' => $rowFaculty['faculty_Id'],
                'RAMID' => $rowFaculty['RAM_ID'],
                'department' => $rowFaculty['department'],
                'occupation' => $rowFaculty['occupation']
        ); 
              $_SESSION['is_Faculty'] = true;
        }
        
         $_SESSION['user_is_logged_in']  =  true;
        
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong>' . $dbUsers_firstName . '
                </div>');
        
        redirect('my_account.php');
        
    } else {
        
         echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User does not exist.
            </div>';
    }    
}
include('footer.php'); ?>
