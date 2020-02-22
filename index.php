<?php 
include("dbconnection.php"); // Uses dbconnection.php to establish a connection to the server.

//******************************************************
// CREATE QUERY AND ADD INTO DATABASE
 /* $query = "INSERT INTO users (id, email, password, full_name, Spending_Amt) VALUES ('3', 'ppeowfapoa@gmail.com', '1334', 'Jane Doe ', '200')"; 
//******************************************************
// CHECK IF QUERY WAS SUCCESSFULLY CREATED
 if (mysqli_query($connection, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
} 
//******************************************************
// UPDATE AN EXISTING QUERY
 $query_update = "UPDATE users SET full_name='Peter Ciccone' WHERE id=3";

if (mysqli_query($connection, $query_update)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($connection);
} 
//******************************************************
// SELECT DATA 
 query_select = "SELECT * FROM users";
$run_query = mysqli_query($connection, $query_select);

$result = mysqli_fetch_array($run_query, MYSQLI_ASSOC);

if($result)
{
    echo $result['password'];
} 
//******************************************************
// DELETE DATA
$query_delete = "DELETE FROM users WHERE id=3";
$run_query = mysqli_query($connection, $query_delete);

if ($run_query)
{
    echo "Data deleted";
} else {
    echo "Data could not be deleted.";
} 
//******************************************************
// CLOSE CONNECTION WHEN YOU'RE DONE W/THE DATABASE
// mysqli_close($connection); */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Form</h2>     
  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Password</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
     <?php
    include("dbconnection.php");
    $query = "SELECT * FROM users";
    $run = mysqli_query($connection, $query);
    while ($result = mysqli_fetch_assoc( $run)) {
    ?>
      <tr>
        <td><?php echo $result['full_name'] ?></td>
        <td><?php echo $result['password'] ?></td>
        <td><?php echo $result['email'] ?></td>
        </tr>
    <?php } ?>
      
    </tbody>
  </table>
</div>
</body>
</html>
