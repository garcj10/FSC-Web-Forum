<?php

//function to trim values
function cleandata($value){
    
   return trim($value);
    // trim() will remove whitespace and other unwanted characters from a form. All it does is take in a value to be trimmed as a parameter.
}

//function to sanitize value for string
function sanitize($raw_value) {                                         
    
    return filter_var($raw_value, FILTER_SANITIZE_STRING);
    // filter_var() will filter a value based on whatever filter type is specified. In this case, sanitize. It takes in the raw value to be filtered as a parameter.
    // Sanitize means to remove any unwanted characters that may be harmful to the application.
}

//function to validate value for email
function valemail($raw_email){
    
    return filter_var($raw_email, FILTER_VALIDATE_EMAIL);
    // Validate email checks to make sure that the user entered a valid email address.
}

//function to validate value for integer
function valint($raw_int){
    
    return filter_var($raw_int, FILTER_VALIDATE_INT);
    // Validate int checks to make sure that an integer value was passed in. 
}

//function to redirect
function redirect($page){
    
    header("Location: {$page}");
    // This function will redirect you to the specified filename.
}

//function to keep error and success messages in a session 
function keepmsg($message){                     
    if(empty($message)){
        
        $message = "";
    } else {
        
          $_SESSION['msg'] = $message;
    }
    // Creates an error or success message in the current session, assuming there is a message to be displayed. Does not display a message yet.
}

//function to display the stored message in the session super global
function showmsg(){
    
    if(isset($_SESSION['msg'])){
        
        echo $_SESSION['msg'];
            
        unset($_SESSION['msg']);
    }
    // Displays the message that was set in the keepmsg() function.
}

//Create function to hash password using md5
function hashpassword($clean_password){          
    
    return md5($clean_password);
    // Takes the unhashed password as a parameter and hashes it.
}
?>



