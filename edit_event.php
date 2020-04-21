<?php include('includes/header.php');

include('includes/functions.php');

require('includes/pdocon.php');

$db = new Pdocon;

    $event_Id = $_POST['id'];
    
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

if(isset($_POST['update_event'])){
    
    $raw_title      =   cleandata($_POST['title']);
    $raw_description       =   cleandata($_POST['description']);
    $raw_event_Type          =   cleandata($_POST['eventType']);
    $raw_location          =   cleandata($_POST['location']);
    $raw_date        =   cleandata($_POST['date']);
    $raw_time        =   cleandata($_POST['time']);
    $raw_capacity   = cleandata($_POST['capacity']);
    
    $c_title          =   sanitize($raw_title);
    $c_description          =   sanitize($raw_description);
    $c_event_Type           =   sanitize($raw_event_Type);
    $c_location     =   sanitize($raw_location);
    $c_date          =   sanitize($raw_date);   
    $c_time           =   sanitize($raw_time);                          
    $c_capacity     = sanitize($raw_capacity);

        
          $default_capacity = null;
          
          $db->query("UPDATE events SET event_Title=:title, event_Type=:eventType, description=:description, location=:location, capacity=:capacity, date=:date, time=:time WHERE event_Id=:event_Id");
            
        $db->bindvalue(':event_Id', $event_Id, PDO::PARAM_INT);
          $db->bindvalue(':title', $c_title, PDO::PARAM_STR);
          $db->bindvalue(':eventType', $c_event_Type, PDO::PARAM_STR);   
          $db->bindvalue(':description', $c_description, PDO::PARAM_STR);
          
          $db->bindvalue('location', $c_location, PDO::PARAM_STR);
          if (!empty($_POST['capacity']))
          {
              $db->bindvalue(':capacity', $c_capacity, PDO::PARAM_INT);
          } else {
                $db->bindvalue(':capacity', $default_capacity, PDO::PARAM_INT);
          }
          $db->bindvalue(':date', $c_date, PDO::PARAM_STR);
          $db->bindvalue(':time', $c_time, PDO::PARAM_STR);
          
        $run = $db->execute(); 
       
            $db->query('SELECT * FROM events WHERE event_Title =:title');
            $db->bindvalue(':title', $c_title, PDO::PARAM_STR);
            $row = $db->fetchSingle();
    
        
        // Checks if a capacity was entered:
        if($row['capacity'] != null)
        {   
            $event_Id  = $row['event_Id'];
            
            $db->query('SELECT COUNT(*) AS count FROM events_List WHERE event_Id =:event_Id');
            $db->bindvalue(':event_Id', $event_Id, PDO::PARAM_INT);
            $row = $db->fetchSingle();
          
            // If there is no list for that event yet, creates one:
            if($row['count'] == 0)
            {
                 $db->query("INSERT INTO events_List(list_Id, event_Id) VALUES(NULL, :event_Id)");
        
                $db->bindvalue(':event_Id', $event_Id, PDO::PARAM_INT);
    
                $run = $db->execute();
            }
        
        // If a capacity was removed from an event, delete that event list:
        } else {
                $db->query('SELECT * FROM events_list WHERE event_Id =:event_Id');
                $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                $list_Id = $row['list_Id'];
                
                $db->query("DELETE FROM attendees WHERE list_Id=:list_Id");
                $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
                $run = $db->execute();
            
                $db->query('DELETE FROM events_list WHERE event_Id =:event_Id');
                $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
                $run = $db->execute();         
        }
    
        $run = $db->execute();
    
    if($run) {
           echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Event updated successfully.
                  </div>';
        
        header("Refresh:2; url=my_account.php", true, 303);
        
            } else {
                 echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong>Event could not be updated.
            </div>';
    }
        
      }

if(isset($_POST['delete_event'])){

// Get the list_Id for the specified event.
$db->query('SELECT * FROM events_list WHERE event_Id =:event_Id');
$db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
$row = $db->fetchSingle();
$list_Id = $row['list_Id'];

// If the list Id is successfully found, delete all attendees and events_List under that list Id, and delete the event itself.
if($row['list_Id'])
{
    $db->query('DELETE FROM attendees WHERE list_Id=:list_Id');
    $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
    $run = $db->execute();
    
    $db->query('DELETE FROM events_List WHERE event_Id=:event_Id');
    $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
    $run = $db->execute();
}
    
    $db->query('DELETE FROM events WHERE event_Id=:event_Id');
    $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
    $run = $db->execute();
    
// If the delete is successful, move on to deleting the event_List with that list Id:
if($run)
{
     echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Event has been deleted.
                  </div>';
        
        }
    } 
?> 
 
<link href="css/style_dash.css" rel="stylesheet" type="text/css">

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

<div class="events">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">

                <h2 align="center">Edit Event</h2>

                <div class="form-group">
                    <label class="control-label " for="title"></label>
                    <div class="col-sm-12">
                        <input type="title" name="title" class="form-control" id="title" placeholder="Enter Event Title" value="<?php echo $event_Title; ?>"required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="description"></label>
                    <div class="col-sm-12">
                        <textarea class="form-control" style=resize:none rows="3" type="description" name="description" class="form-control" id="description" placeholder="Enter Description" required><?php echo $description; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="eventType"></label>
                    <div class="col-sm-12">
                        <select type="" name="eventType" class="form-control" id="eventType" required>
                            <option value="<?php echo $event_Type; ?>" selected><?php echo $event_Type; ?></option>
                            <option value="Athletics">Athletics</option>
                            <option value="Club">Club</option>
                            <option value="FSC">FSC</option>
                            <option value="Academics">Academics</option>
                            <option value="Tutoring">Tutoring</option>
                            <option value="Admissions">Admissions</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-12" for="location"></label>
                    <div class="col-sm-12">
                        <input type="location" name="location" class="form-control" id="location" placeholder="Enter Location" value="<?php echo $location; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="date"></label>
                    <div class="col-sm-12">
                        <input type="date" name="date" class="form-control" id="date" value="<?php echo $date; ?>" required>
                    </div>
                </div>

               <div class="form-group">
                         <label class="control-label col-sm-12" for="time"></label>
                           <div class="col-sm-6">
                           <input type="time" name="time" class="form-control" id="time" value="<?php echo $time; ?>" required>
                                </div>
                          <label class="control-label" for="capacity"></label>
                         <div class="col-sm-6">
                           <input type="capacity" name="capacity" class="form-control" id="capacity" placeholder="Capacity" value="<?php echo $capacity; ?>">
                         </div>
                       </div>

            <div class="form-group"> 
                <label class="control-label col-sm-12"></label>
                
			<form action='edit_event.php' method='post'><input type='hidden' name='id' value=' <?php echo $event_Id ?>'>
               <label class="control-label col-sm-12"></label>
              <button type="update" class="pull-right btn btn-primary center" name="update_event" required>Submit Changes</button>
                </form>
            
			<button type="button" id="myBtn" class="pull-left btn btn-danger">Delete this Event</button>
            
            </div>
            
			
			<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
        <div class="modal-body">
		<h2 >Are you sure you want to delete this event?</h2>
        </div>
        <div class="modal-footer">
			<form action='edit_event.php' method='post'> <input type='hidden' name='id' value=' <?php echo $event_Id ?>'>
          <button type="button" class="btn btn-default" data-dismiss="modal">Go Back</button>
		  <button type="submit" class="btn btn-default" name="delete_event">Yes</button>
		  </form>
        </div>
      </div>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("btn btn-default")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
  
        </div>
    </div>
</div>
</div>
