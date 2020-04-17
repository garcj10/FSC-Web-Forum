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
        if(($_SESSION['admin_data'])) { 
            $is_Admin = "Yes";
        } else {
            $is_Admin = "No";
        }
     }
?>
<link href="css/style_dash.css" rel="stylesheet" type="text/css">

<div class="row myrow ">
    <div class="box">
        <div class="col-sm-6 register_form">

        <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">

            <?php  if(isset($_SESSION['student_data'])) { ?>

            <div class="form-group">
                <label class="control-label col-sm-2" for="ramID"></label>
                <div class="col-sm-10">
                    <h3>ACCOUNT INFO</h3>
                    <input type="ramID" name="ramID" class="form-control" id="ramID" placeholder="Enter RAM ID" value="<?php echo $ram_ID; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="major"></label>
                <div class="col-sm-10">
                    <input type="major" name="major" class="form-control" id="major" placeholder="Enter Major" value="<?php echo $major; ?>"required>
                </div>
            </div>
                    
                <div class="form-group">
            <label class="control-label col-sm-2" for="collegeLevel"></label>
            <div class="col-sm-10">
               <select type="" name="collegeLevel" class="form-control" id="collegeLevel" required>
        <option value="">Year of Study</option>
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
                <label class="control-label col-sm-2" for="ramID"></label>
                <div class="col-sm-10">
                    <input type="ramID" name="ramID" class="form-control" id="ramID" placeholder="Enter RAM ID" value="<?php echo $ram_ID; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="department"></label>
                <div class="col-sm-10">
                    <input type="department" name="department" class="form-control" id="department" placeholder="Enter Department" value="<?php echo $department; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="occupation"></label>
                <div class="col-sm-10">
                    <input type="occupation" name="occupation" class="form-control" id="occupation" placeholder="Enter Occupation" value="<?php echo $occupation; ?>"required>
                </div>
            </div>

            <?php } if(!isset($_SESSION['admin_data'])) { ?>

            <div class="form-group">
                <label class="control-label col-sm-2" for="admin"></label>
                <div class="col-sm-10">
                    <select type="" name="admin" class="form-control" id="admin">
                        <option value="">Would you like to become an admin?</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
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
                    <button type="submit" class="btn btn-primary " name="submit_update">Update</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-6 register_view ">

        <?php 
       
    if(isset($_SESSION['student_data'])) 
    {
        echo "
		<table >
			<tr>
				<td>Name: </td>
				<td>". $first_Name . '&nbsp;' . $last_Name ."</td>
			</tr>
			<tr>
			<td>Email: </td>
			<td>" . $email ."</td>
			</tr>
            <tr>
			<td>Ram ID: </td>
			<td>" . $ram_ID ."</td>
			</tr>
            <tr>
			<td>Major: </td>
			<td>" . $major . "</td>
			</tr>
            <tr>
			<td>Year: </td>
			<td>" . $college_Level . "</td>
			</tr>
            <tr>
			<td>admin:</td>
			<td>" . $is_Admin ."</td>
			</tr>
			</table>
		";
    } 
       
    if(isset($_SESSION['faculty_data'])) 
    {
        echo "
		<table >
			<tr>
				<td>Name: </td>
				<td>". $first_Name . '&nbsp;' . $last_Name ."</td>
			</tr>
			<tr>
			<td>Email: </td>
			<td>" . $email ."</td>
			</tr>
            <tr>
			<td>Ram ID: </td>
			<td>" . $ram_ID ."</td>
			</tr>
            <tr>
			<td>Department: </td>
			<td>" . $department. "</td>
			</tr>
            <tr>
			<td>Occupation: </td>
			<td>" . $occupation . "</td>
			</tr>
            <tr>
			<td>admin:</td>
			<td>" . $is_Admin ."</td>
			</tr>
			</table>
		";
    } 
        
         if(isset($_SESSION['admin_data']))
        { ?>
            <h4>Events You've Created:</h4>
        <?php  
         
        $admin_Id = $_SESSION['admin_data']['adminId'];
        $db->query('SELECT * FROM events WHERE admin_Id =:admin_Id');
        $db->bindValue(':admin_Id', $admin_Id, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
            
            foreach($row as $event)
            { 
            ?> <div class="form-group"><button type="submit" action="my_account.php" name="edit" class="btn btn-link"><a href="edit_event.php?event_id=<?php echo $event["event_Id"] ?>"/><?php echo $event["event_Title"] ." (click to edit)"; ?></button></div> <?php
            }
        } 
        
        
    ?> 
    </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
</body>