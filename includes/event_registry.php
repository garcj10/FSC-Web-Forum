Skip to content
Search or jump to…

Pull requests
Issues
Marketplace
Explore
 
@pacman10x 
garcj10
/
FSC-Web-Forum
2
00
 Code Issues 0 Pull requests 0 Actions Projects 0 Wiki Security 0 Insights
FSC-Web-Forum/includes/event_registry.php /
@garcj10 garcj10 Changes to the register button and converted it to an ajax request
b6281bb 19 hours ago
161 lines (123 sloc)  7.14 KB
  
Code navigation is available!
Navigate your code with ease. Click on function and method calls to jump to their definitions or references in the same repository. Learn more

<?php
    require('pdocon.php');
?>
<!--
<h3 align="center">Please enter your password to confirm you'll be attending this event:</h3>
  
 <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
     
  
 <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">  
              <input type="email" name="email" class="form-control" id="email" placeholder="Email" value=<?php echo $_SESSION['user_data']['email']; ?> required>
            </div>
          </div>
 <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">  
              <input type="password" name="password" class="form-control" id="password" placeholder="Confirm Password" autofocus="autofocus" required>
            </div>
          </div>
          
  <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="confirm" class="pull-right btn btn-primary center" name="confirm" required>Confirm</button>
              <a class="pull-left btn btn-danger" href="../see_events.php"> Cancel</a>
            </div>
          </div>
          -->
<?php
session_start();
            if(isset($_POST['event_id']))
            {
                //$raw_password       =   cleandata($_POST['password']);
                //$hashed_password    =   hashpassword($raw_password);
                
                $email = $_SESSION['user_data']['email'];
                $password = $_SESSION['user_data']['hashedPass'];

                $db = new Pdocon;

                $db->query('SELECT * FROM fsc_Users WHERE email=:email AND password=:password');
                $db->bindValue(':email', $email, PDO::PARAM_STR);
                $db->bindValue(':password', $password, PDO::PARAM_STR);
    
                $row = $db->fetchSingle();
                
                if ($row)
                {
                // Retrieves the event ID based on which event the user clicked.
                $raw_id = $_POST['event_id'];
                $event_Id = (int)$raw_id;
                
                $db->query('SELECT * FROM events WHERE event_Id =:event_id');
                $db->bindValue(':event_id', $event_Id, PDO::PARAM_INT);
             
                $row = $db->fetchSingle();
                
                $capacity = $row['capacity'];
                
                $event_Title = $row['event_Title'];
                $event_Type = $row['event_Type'];
                $description = $row['description'];
                $location = $row['location'];
                $date = $row['date'];
                $time = $row['time'];
                
                // Query to find the list for that particular event
                $db->query('SELECT * FROM events_List WHERE event_Id =:event_id');
                $db->bindValue(':event_id', $event_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                
                $list_Id = $row['list_Id'];
                $user_Id = $_SESSION['user_data']['id'];
             
                $db->query('SELECT * FROM attendees WHERE list_Id =:list_Id AND user_Id=:user_Id');
                $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
                $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                
                if ($row['user_Id'])
                {
                     echo '<div class="alert alert-danger text-center">
                     <a href="#" class="close" data-dismiss="alert" aria-    label="close">&times;</a>You have already been signed up for this event.</a>
                     </div>';
                } else {
                    
                $db->query('SELECT COUNT(*) AS count FROM attendees WHERE list_Id =:list_Id');
                $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                
                $count = $row['count']; 
                
                if ($count == $capacity)
                {
                    echo '<div class="alert alert-danger text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Signup limit reached. Stay tuned for another posting similar to this one.</a>
                    </div>';
        
                } else {     
                    
                $user_Id = $_SESSION['user_data']['id'];
                    
                $db->query("INSERT INTO attendees(user_Id, list_Id) VALUES(:user_Id, :list_Id)");
        
                $db->bindvalue(':list_Id', $list_Id, PDO::PARAM_INT);
                $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
    
                $run = $db->execute(); 
                
                if($run)
                {   
                    date_default_timezone_set('America/New_York');
                    $fulldate = date('Y-m-d');
                
                    $firstName = $_SESSION['user_data']['firstName'];
                            
                    $msg   =   $event_Title . "- " . date('n/d/Y', strtotime($date)) . ", " . date('g:i A', strtotime($time)) . "\n\n" . $description;

                    // Create and send email:
                    $to        =   $email;
                  
                    $email_subject = "Event Confirmation for FSCEvents";
                    $email_body = "\nDear $firstName, \n\nThis message is to confirm you've signed up for an event.\n\n"."Here are the details:" ."\n\n$msg \n\n";
                    $headers = "From: noreply@fscevents.com"; 
         
                    if(mail($to,$email_subject,$email_body,$headers))
                    {
                       
                           echo "<div class='alert alert-success text-center'>
                                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                  <strong>Success!</strong> Confirmation successfully sent.
                                  <!--<a href='../see_events.php'> Back to Events</a>-->
                                 </div>";
                            
                            } else {
                           
                            
                            echo "<div class='alert alert-danger text-center'>
                                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                  <strong>Sorry!</strong> The email could not be sent. Please Try Again. 
                                  <!--<a href='../see_events.php'> Back to Events</a>-->
                                 </div>";
                    }
                }
                    return true; 
            }
        } 
                    
      }             else {
                      echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Invalid password. Please try again.
            </div>';
                    
    }
}
?>