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
<link href="css/style_dash.css" rel="stylesheet" type="text/css">

<div class="row myrow">
   
    <div class="box">
        <div class="col-sm-6 register_form">

        <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">

            <?php  if(isset($_SESSION['student_data'])) { ?>

            <div class="form-group">
                <label class="control-label col-sm-2" for="ramID"></label>
                <div class="col-sm-10">
                        <h1>ACCOUNT INFO</h1>
                    <h4>RAM ID</h4>
                    <input type="ramID" name="ramID" class="form-control" id="ramID" placeholder="Enter RAM ID" value="<?php echo $ram_ID; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="major"></label>
                <div class="col-sm-10">
                  <h4>MAJOR</h4>
                    <select multiple type="" name="major" class="form-control" id="major" required>
                <option value="">AET</option>
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
            <h3>Events You've Created:</h3>
        <?php  
         
        $admin_Id = $_SESSION['admin_data']['adminId'];
        $db->query('SELECT * FROM events WHERE admin_Id =:admin_Id');
        $db->bindValue(':admin_Id', $admin_Id, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        if($row) {
            
            foreach($row as $event)
            { 
        ?><div class="form-group"><form action='edit_event.php' method='post'><?php echo $event["event_Title"] . " -";?> <button class="btn btn-link" type='hidden' name='id' value=' <?php echo $event["event_Id"] ?>'>Edit</button></form></div>
			<?php
            }
        } 
            else 
         {
            echo "You haven't created any events yet.";
         }
     } 
        
    ?> 
    </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
</body>
