<?php 

//Include functions:
include('includes/header.php'); 

include('includes/edit_account.php');

// Insantiate database object:
$db = new Pdocon;

     if(isset($_SESSION['student_data'])) {
        $first_Name = $_SESSION['user_data']['firstName'];
        $last_Name = $_SESSION['user_data']['lastName'];
        $email = $_SESSION['user_data']['email'];
        $ram_ID = $_SESSION['student_data']['RAMID'];
        $major = $_SESSION['student_data']['major'];
        $college_Level = $_SESSION['student_data']['collegeLevel'];
        if(isset($_SESSION['admin_data'])) { 
            $is_Admin = "Yes";
        } else {
            $is_Admin = "No";
        }
     } 

     if(isset($_SESSION['faculty_data'])) {
        $first_Name = $_SESSION['user_data']['firstName'];
        $last_Name = $_SESSION['user_data']['lastName'];
        $email = $_SESSION['user_data']['email'];
        $ram_ID = $_SESSION['faculty_data']['RAMID'];
        $department = $_SESSION['faculty_data']['department'];
        $occupation = $_SESSION['faculty_data']['occupation'];
        if(isset($_SESSION['admin_data'])) { 
            $is_Admin = "Yes";
        } else {
            $is_Admin = "No";
        }
     }
?>

<style>
    
    .tableDiv
    {
        
    }

    h1
    {
        text-align: center;
    }
tbody
{
    cursor:pointer;
}
.scrollable
    {
        height: 600px;
        width:90%;
        margin-right: 3%;
        margin-left: 6%;
        overflow: scroll;
        border: 3px solid #006f71;

    }
  
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th
    {
        color: #006f71;
        
    }

</style>
<link href="css/style_dash.css" rel="stylesheet" type="text/css">

<div class="row myrow">
   
    <div class="box">
        <div class="col-sm-6 register_form">

        <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
            

            <?php  if(isset($_SESSION['student_data'])) { ?>
            
     
               <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                         <div class="col-sm-10">
                             <h1>ACCOUNT INFORMATION</h1>
                         </div>
                       </div>
              

            <div class="form-group">
               
                <label class="control-label col-sm-2" for="name"></label>
                <div class="col-sm-5">
                    <h4>FIRST NAME</h4>
                    <input type="firstName" name="firstName" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $_SESSION['user_data']['firstName']; ?>"readonly>
                </div>
                   <div class="col-sm-5">
                    <h4>LAST NAME</h4>
                    <input type="firstName" name="firstName" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $_SESSION['user_data']['lastName']; ?>"readonly>
                </div>
                </div>
           
           
            <div class="form-group">
                <label class="control-label col-sm-2" for="email"></label>
                <div class="col-sm-10">
                    <h4>EMAIL</h4>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $_SESSION['user_data']['email']; ?>"readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="ramID"></label>
                <div class="col-sm-10">
                    <h4>RAM ID</h4>
                    <input type="ramID" name="ramID" class="form-control" id="ramID" placeholder="Enter RAM ID" value="<?php echo $ram_ID; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="major"></label>
                <div class="col-sm-10">
                  <h4>MAJOR</h4>
                    <select multiple type="" name="major" class="form-control" id="major" required>
                <option value="AET">AET</option>
                <option value="ARC">ARC</option>
                <option value="ART">ART</option>
                <option value="AVN">AVN</option>
                <option value="BCS">BCS</option>
                <option value="BIO">BIO</option>
                <option value="BUS">BUS</option>
                <option value="CHM">CHM</option>
                <option value="CIV">CIV</option>
                <option value="CON">CON</option>
                <option value="CPS">CPS</option>
                <option value="CRJ">CRJ</option>
                <option value="DEN">DEN</option>
                <option value="ECO">ECO</option>
                <option value="EET">EET</option>
                <option value="EGL">EGL</option>
                <option value="ENV">ENV</option>
                <option value="GEO">GEO</option>
                <option value="GIS">GIS</option>
                <option value="GRO">GRO</option>
                <option value="HIS">HIS</option>
                <option value="HOR">HOR</option>
                <option value="HPW">HPW</option>
                <option value="HST">HST</option>
                <option value="HUM">HUM</option>
                <option value="IND">IND</option>
                <option value="IXD">IXD</option>
                <option value="MET">MET</option>
                <option value="MLG">MLG</option>
                <option value="MLS">MLS</option>
                <option value="MTH">MTH</option>
                <option value="NTR">NTR</option>
                <option value="NUR">NUR</option>
                <option value="PCM">PCM</option>
                <option value="PHY">PHY</option>
                <option value="PSY">PSY</option>
                <option value="SET">SET</option>
                <option value="SMT">SMT</option>
                <option value="SOC">SOC</option>
                <option value="SPE">SPE</option>
                <option value="STS">STS</option>
                <option value="VIS">VIS</option>

                    </select>
                </div>
            </div>
                    
                <div class="form-group">
            <label class="control-label col-sm-2" for="collegeLevel"></label>
            <div class="col-sm-10">
               <h4>YEAR OF STUDY</h4>
               <select type="" name="collegeLevel" class="form-control" id="collegeLevel" required>
        <option value="">College Level</option>
                                    <option value="Freshman">Freshman</option>
                                    <option value="Sophomore">Sophmore</option>
                                     <option value="Junior">Junior</option>
                                      <option value="Senior">Senior</option>
                                </select>
            </div>
          </div>

            <?php } else ?>


            <?php   if(isset($_SESSION['faculty_data'])) { ?>
            
            
              <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                         <div class="col-sm-10">
                             <h1>ACCOUNT INFORMATION</h1>
                         </div>
                       </div>
              

            <div class="form-group">
               
                <label class="control-label col-sm-2" for="name"></label>
                <div class="col-sm-5">
                    <h4>FIRST NAME</h4>
                    <input type="firstName" name="firstName" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $_SESSION['user_data']['firstName']; ?>"readonly>
                </div>
                   <div class="col-sm-5">
                    <h4>LAST NAME</h4>
                    <input type="firstName" name="firstName" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $_SESSION['user_data']['lastName']; ?>"readonly>
                </div>
                </div>
                
                  <div class="form-group">
                <label class="control-label col-sm-2" for="email"></label>
                <div class="col-sm-10">
                    <h4>EMAIL</h4>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $_SESSION['user_data']['email']; ?>"readonly>
                </div>
            </div>
           
           
 <div class="form-group">
                <label class="control-label col-sm-2" for="ramID"></label>
                <div class="col-sm-10">
                    <h4>RAM ID</h4>
                    <input type="ramID" name="ramID" class="form-control" id="ramID" placeholder="Enter RAM ID" value="<?php echo $ram_ID; ?>"required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="department"></label>
                <div class="col-sm-10">
                  <h4>DEPARTMENT</h4>
                    <select multiple type="" name="department" class="form-control" id="department" required>
                <option value="AET">AET</option>
                <option value="ARC">ARC</option>
                <option value="ART">ART</option>
                <option value="AVN">AVN</option>
                <option value="BCS">BCS</option>
                <option value="BIO">BIO</option>
                <option value="BUS">BUS</option>
                <option value="CHM">CHM</option>
                <option value="CIV">CIV</option>
                <option value="CON">CON</option>
                <option value="CPS">CPS</option>
                <option value="CRJ">CRJ</option>
                <option value="DEN">DEN</option>
                <option value="ECO">ECO</option>
                <option value="EET">EET</option>
                <option value="EGL">EGL</option>
                <option value="ENV">ENV</option>
                <option value="GEO">GEO</option>
                <option value="GIS">GIS</option>
                <option value="GRO">GRO</option>
                <option value="HIS">HIS</option>
                <option value="HOR">HOR</option>
                <option value="HPW">HPW</option>
                <option value="HST">HST</option>
                <option value="HUM">HUM</option>
                <option value="IND">IND</option>
                <option value="IXD">IXD</option>
                <option value="MET">MET</option>
                <option value="MLG">MLG</option>
                <option value="MLS">MLS</option>
                <option value="MTH">MTH</option>
                <option value="NTR">NTR</option>
                <option value="NUR">NUR</option>
                <option value="PCM">PCM</option>
                <option value="PHY">PHY</option>
                <option value="PSY">PSY</option>
                <option value="SET">SET</option>
                <option value="SMT">SMT</option>
                <option value="SOC">SOC</option>
                <option value="SPE">SPE</option>
                <option value="STS">STS</option>
                <option value="VIS">VIS</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="occupation"></label>
                <div class="col-sm-10">
                   <h4>OCCUPATION</h4>
                    <select multiple type="" name="occupation" class="form-control" id="occupation" required>
<option value="Access Services Librarian">Access Services Librarian</option>
 <option value="Adjunct Instructor">Adjunct Instructor</option>
<option value="Admissions Advisor">Admissions Advisor</option>
  <option value="Assistant Librarian">Assistant Librarian</option>
<option value="Assistant Professor">Assistant Professor</option>
   <option value="Campus Recreation Assistant">Campus Recreation Assistant</option>
  <option value="Coach">Coach</option>
  <option value="Counselor">Counselor</option>
  <option value="Director">Director</option>
  <option value="Facility Operations Assistant">Facility Operations Assistant</option>             
  <option value="Instructional Support Associate">Instructional Support Associate</option>
  <option value="Instructional Support Technician">Instructional Support Technician</option>
  <option value="Instructor">Instructor</option>
  <option value="Library Clerk">Library Clerk</option>
  <option value="Library Director">Library Director</option>
  <option value="Office Assistant">Office Assistant</option>
 <option value="Staff Associate">Staff Associate</option>
  <option value="Staff Psychologist">Staff Psychologist</option>    
  <option value="Other">Other</option>            
                    </select>
                </div>
            </div>

            <?php } ?>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 ">
                    <div class="checkbox ">
                        <label><input type="checkbox" required> Accept Changes</label>
                    </div>
                </div>
            </div>
    

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 text-center">
                    <button class="button" type="submit" class="btn btn-primary " name="submit_update">Update</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-6 register_view ">
        <div class="tableDiv">
    
        <?php 
        
         if(isset($_SESSION['admin_data']))
        { ?>   <h1>EVENTS YOU'VE CREATED</h1>
            
           <?php 
        $db = new Pdocon;
     
             
        $admin_Id = $_SESSION['admin_data']['adminId'];
        $db->query('SELECT * FROM events WHERE admin_Id =:admin_Id ORDER BY date DESC');
        $db->bindValue(':admin_Id', $admin_Id, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        if($row) {
            
        ?>
        
    <div class="scrollable">
    <table class="table table-hover">

  <thead>
    <tr>
      <th scope="col">Event Title</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
    <th scope="col"></th>
    </tr>
  </thead>
           
           <?php
            
        foreach($row as $event)
        { 
           ?>    
               
                <tr>
                <td><?php echo $event['event_Title'];?></td>
                <td><?php echo $event['event_Type'];?></td>
                <td><?php echo $event['date'];?></td>
                <td> 
                    <form action='edit_event.php' method='post'><button class="btn btn" type='hidden' name='id' value=' <?php echo $event["event_Id"] ?>'>Update</button></form></td></tr>
                
    
  <?php }
        } else { ?> 
        <div class="scrollable" style="background-color:lightgray; ">
       <h2 style="text-align: center; margin:150px;">You haven't created any events yet!<a href="create_events.php"> Get started.</a></h2></div> <?php
        }
             
         }
        
     else {
         ?> <h1>YOUR EVENTS</h1>
         
         <?php
        $user_Id = $_SESSION['user_data']['id'];
        $db->query('SELECT * FROM attendees WHERE user_Id =:user_Id');
        $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        
        if($row) {
        ?>     <div class="scrollable">
    <table class="table table-hover tableDiv">

  <thead>
    <tr>
      <th scope="col">Event Title</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    <th scope="col">Location</th>
    </tr>
  </thead> 
       
       <?php
        foreach($row as $list)
        {
            $list_Id = $list['list_Id'];
            $db->query('SELECT * FROM events_List WHERE list_Id=:list_Id');
            $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
            $row = $db->fetchMultiple();
            foreach($row as $eventId)
            {
                $event_Id = $eventId['event_Id'];
                $db->query('SELECT * FROM events WHERE event_Id=:event_Id ORDER BY DATE DESC');
                $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
                $row = $db->fetchMultiple();
                foreach($row as $event)
                {  $date = $event['date'];
                    $time = $event['time'];
                 date_default_timezone_set('America/New_York');
                 $fulldate = date('Y-m-d');
                
        ?>
                     <tr>
                <td><?php echo $event['event_Title']; if($date <= $fulldate)
                 {
                     echo " (Closed)";
                 } ?></td>
                <td><?php echo $event['event_Type'];?></td>
                <td><?php echo date('n/d/Y', strtotime($date));?></td>
                <td><?php echo date('g:i A', strtotime($time));?></td>
                <td><?php echo $event['location'];?></td>
                  </tr>
                <?php
                }
            }
        }
    } else { ?>
            
        <div class="scrollable" style="background-color:lightgray;">
       <h2 style="text-align: center; margin:150px;">You haven't signed up for any events yet!<a href="see_events.php"> Get started.</a></h2></div><?php
        }
     }
    ?>

    </div>
    </div>
        </div>
</div>
</body>

