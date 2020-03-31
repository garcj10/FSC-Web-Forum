<?php include('includes/header.php');

include('includes/functions.php');

require('includes/pdocon.php');

$db = new Pdocon;

if(isset($_POST['create_event'])){
    
    $raw_title      =   cleandata($_POST['title']);
    $raw_description       =   cleandata($_POST['description']);
    $raw_event_Type          =   cleandata($_POST['eventType']);
    $raw_location          =   cleandata($_POST['location']);
    $raw_date        =   cleandata($_POST['date']);
    $raw_time        =   cleandata($_POST['time']);
    
    $c_title          =   sanitize($raw_title);
    $c_description          =   sanitize($raw_description);
    $c_event_Type           =   sanitize($raw_event_Type);
    $c_location     =   sanitize($raw_location);
    $c_date          =   sanitize($raw_date);   
    $c_time           =   sanitize($raw_time);                          


    $db->query("SELECT * FROM events WHERE event_Title = :title");
    
    $db->bindvalue(':title', $c_title, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();

      if($row){
        
        echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Event has already been created..</a>
            </div>';
        
    } else {
          
          $admin_Id =  $_SESSION['admin_data']['adminId'];
          
          $db->query("INSERT INTO events(admin_Id, event_Id, event_Title, event_Type, description, location, date, time) VALUES(:adminId, NULL, :title, :eventType, :description, :location, :date, :time)");
            
          $db->bindvalue(':adminId', $admin_Id, PDO::PARAM_INT);
          $db->bindvalue(':title', $c_title, PDO::PARAM_STR);
          $db->bindvalue(':eventType', $c_event_Type, PDO::PARAM_STR);   
          $db->bindvalue(':description', $c_description, PDO::PARAM_STR);
          $db->bindvalue('location', $c_location, PDO::PARAM_STR);
          $db->bindvalue(':date', $c_date, PDO::PARAM_STR);
          $db->bindvalue(':time', $c_time, PDO::PARAM_STR);
        
          $run = $db->execute(); 
          
           echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Event created successfully.
                  </div>';
          
      }
}

?> 

 <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
     
  <h2 align="center">Create Event</h2>
  
 <div class="form-group">
            <label class="control-label col-sm-2" for="title"></label>
            <div class="col-sm-10">  
              <input type="title" name="title" class="form-control" id="title" placeholder="Enter Event Title" required>
            </div>
          </div>
        
          <div class="form-group">
              <label class="control-label col-sm-2" for="description"></label>
             <div class="col-sm-10">
                 <textarea class="form-control" rows="3" type="description" name="description" class="form-control" id="description" placeholder="Enter Description" required></textarea>
            </div>
            </div>
 
         <div class="form-group">
            <label class="control-label col-sm-2" for="eventType"></label>
            <div class="col-sm-10">
               <select type="" name="eventType" class="form-control" id="eventType" required>
        <option value="">Select Event Type</option>
                                    <option value="Athletics">Athletics</option>
                                    <option value="Clubs">Club</option>
                                     <option value="FSC">FSC</option>
                                      <option value="Academics">Academics</option>
                                       <option value="Tutoring">Tutoring</option>
                                        <option value="Admissions">Admissions</option>
                                </select>
            </div>
          </div>
        

          
          <div class="form-group">
            <label class="control-label col-sm-2" for="location"></label>
            <div class="col-sm-10">
              <input type="location" name="location" class="form-control" id="location" placeholder="Enter Location" required>
            </div>
          </div>
        
          <div class="form-group">
              <label class="control-label col-sm-2" for="date"></label>
             <div class="col-sm-10">
              <input type="date" name="date" class="form-control" id="date" required>
            </div>
            </div>
 
          <div class="form-group">
            <label class="control-label col-sm-2" for="time"></label>
            <div class="col-sm-10">
              <input type="time" name="time" class="form-control" id="time"required>
            </div>
          </div>
          
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="createEvent" class="btn btn-primary center" name="create_event">Create Event</button>
            </div>
          </div>
          
<?php include('includes/footer.php'); ?>