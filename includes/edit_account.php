<?php  
//Include functions:
include('includes/functions.php');

// Require DB connection:
require('includes/pdocon.php');

// Instantiate DB object:
$db = new Pdocon; 

if(isset($_POST['submit_update'])){
 
// If the student session exists, process this data:
  if(isset($_SESSION['student_data'])){

        $raw_RAM_ID      =   cleandata($_POST['ramID']);
        $raw_major       =   cleandata($_POST['major']);
        $raw_collegeLevel          =   cleandata($_POST['collegeLevel']);
      
        $c_RAM_ID             =   sanitize($raw_RAM_ID);
        $c_major              =   sanitize($raw_major);
        $c_collegeLevel        = sanitize($raw_collegeLevel);
      
    if(!preg_match("/R0/", $c_RAM_ID) or (strlen($c_RAM_ID) != 9))
        {
            
             echo '<div class="alert alert-danger text-center" style="font-family: Oswald, sans-serif; font-weight:300;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Invalid RAM ID. Make sure you enter one that looks something like this: R01234567.
            </div>';
        } 
      else {
      
        $db->query('SELECT * FROM students WHERE RAM_ID=:ramID'); 
    
        $db->bindvalue(':ramID', $c_RAM_ID, PDO::PARAM_STR);
    
        $row = $db->fetchSingle();
      
        $user_Id = $_SESSION['user_data']['id'];
           
        $db->query('SELECT * FROM students WHERE user_Id=:user_Id');
       
        $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
    
        $row = $db->fetchSingle(); 
    
        $db->query("UPDATE students SET RAM_ID=:ramID, major=:major, college_Level=:collegeLevel where user_Id=:user_Id");
       
        $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
        $db->bindvalue(':ramID', $c_RAM_ID, PDO::PARAM_STR);
        $db->bindvalue(':major', $c_major, PDO::PARAM_STR);
        $db->bindvalue(':collegeLevel', $c_collegeLevel, PDO::PARAM_STR);
        
        $run = $db->execute();
      
        $db->query('SELECT * FROM students WHERE user_Id=:user_Id'); 
        $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
        
        $rowStudents = $db->fetchSingle();
    
        $_SESSION['student_data']['RAMID'] = $rowStudents['RAM_ID'];
        $_SESSION['student_data']['major'] = $rowStudents['major'];
        $_SESSION['student_data']['collegeLevel'] = $rowStudents['college_Level'];
            
          if($run){
            echo '<div class="alert alert-success text-center" style="font-family: Oswald, sans-serif;
                    font-weight:300;">
                  <a href="my_account.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   User info updated successfully.
                  </div>';
            
        } else {
            
             echo '<div class="alert alert-danger text-center" style="font-family: Oswald, sans-serif; font-weight:300;">
              <a href="my_account.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User could not be updated. Please try again later
            </div>';
        } 
       
  }
    
// If the faculty session exists, process this data:
  if(isset($_SESSION['faculty_data'])){
      
        $raw_RAM_ID      =   cleandata($_POST['ramID']);
        $raw_Department = cleandata($_POST['department']);
        $raw_Occupation = cleandata($_POST['occupation']);
    
        $raw_admin  = cleandata($_POST['admin']);

        $c_RAM_ID  = sanitize($raw_RAM_ID);
        $c_Department = sanitize($raw_Department);
        $c_Occupation = cleandata($raw_Occupation);
      
        $db->query('SELECT * FROM faculty WHERE RAM_ID=:ramID'); 
    
        $db->bindvalue(':ramID', $c_RAM_ID, PDO::PARAM_STR);
    
        $row = $db->fetchSingle();
      
        $user_Id = $_SESSION['user_data']['id'];
           
        $db->query('SELECT * FROM facultyWHERE user_Id=:user_Id');
       
        $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);

        $db->query("UPDATE faculty SET RAM_ID=:ramID, department=:department, occupation=:occupation where user_Id=:user_Id");
       
        $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
        $db->bindvalue(':ramID', $c_RAM_ID, PDO::PARAM_STR);
        $db->bindvalue(':department', $c_Department, PDO::PARAM_STR);
        $db->bindvalue(':occupation', $c_Occupation, PDO::PARAM_STR);
        
        $run = $db->execute();
        
        $db->query('SELECT * FROM faculty WHERE user_Id=:user_Id'); 
        $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
        
        $rowFaculty = $db->fetchSingle();
      
        $_SESSION['faculty_data']['RAMID'] = $rowFaculty['RAM_ID'];
        $_SESSION['faculty_data']['department'] = $rowFaculty['department'];
        $_SESSION['faculty_data']['occupation'] = $rowFaculty['occupation'];
      
        if($run){
            echo '<div class="alert alert-success text-center" style="font-family: Oswald, sans-serif;
                    font-weight:300;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   User info updated successfully.
                  </div>';
            
        } else {
            
             echo '<div class="alert alert-danger text-center" style="font-family: Oswald, sans-serif; font-weight:300;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User could not be updated. Please try again later
            </div>';
        } 
  } 
      
  }
} 
?> 
