<?php
/*
$con = MySQLi_connect(
    "localhost", //Server host name.
    "xfhbbaqwxr", //Database username.
    "V3K2XgpGtk", //Database password.
    "xfhbbaqwxr" //Database name or anything you would like to call it.
);
*/

/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app";
*/
$servername = "localhost";
$username = "xfhbbaqwxr";
$password = "V3K2XgpGtk";
$dbname = "xfhbbaqwxr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$fulldate = date('Y-m-d');
$sql = "SELECT * FROM events";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row

if (isset($_GET['eventNewCount'])) {
    $eventCount = $_GET['eventNewCount'];
    $sql = "SELECT * FROM events LIMIT $eventCount";
    $result = $conn->query($sql);
}
/*
else if (isset($_GET['search'])) {
    $searchItem = $_GET['searchItem'];
    $sql = "SELECT * FROM events WHERE 
				event_Title LIKE '%$searchItem%' OR 
				event_Type LIKE '%$searchItem%' OR 
				description LIKE '%$searchItem%' OR 
				date LIKE '%$searchItem%' OR 
				time LIKE '%$searchItem%' OR 
				location LIKE '%$searchItem%'";
    $result = $conn->query($sql);
}
else if (isset($_GET['general'])) {
    $sql = "SELECT * FROM events WHERE event_Type='General'";
    $result = $conn->query($sql);
}
else if (isset($_GET['club'])) {
    $sql = "SELECT * FROM events WHERE event_Type='Club'";
    $result = $conn->query($sql);
}
else if (isset($_GET['sports'])) {
    $sql = "SELECT * FROM events WHERE event_Type='Sports'";
    $result = $conn->query($sql);
}
else if (isset($_GET['tutoring'])) {
    $sql = "SELECT * FROM events WHERE event_Type='Tutoring'";
    $result = $conn->query($sql);
}
else if (isset($_GET['date'])) {
    $sql = "SELECT * FROM events ORDER BY date";
    $result = $conn->query($sql);
}
else if (isset($_GET['time'])) {
    $sql = "SELECT * FROM events ORDER BY time";
    $result = $conn->query($sql);
}
else if (isset($_GET['location'])) {
    $sql = "SELECT * FROM events ORDER BY location";
    $result = $conn->query($sql);
}
?>
<! Table that Displays Information >
<?php echo $fulldate;?>
*/

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["event_Title"]. "</td><td>" . $row["event_Type"]. "</td><td>" . $row["description"]. "</td><td>" . $row["location"]. "</td><td>" . $row["date"]. "</td><td>" . $row["time"]. "</td></tr>";
    }
}
else {
    echo "0 results";
}
$conn->close();
?>

    /*
    $con = MySQLi_connect(
        "localhost", //Server host name.
        "root", //Database username.
        "", //Database password.
        "app" //Database name or anything you would like to call it.
    );
    //Check connection
    if (MySQLi_connect_errno()) {
        echo "Failed to connect to MySQL: " . MySQLi_connect_error();
    }
    //Search query.
    $Query = "SELECT * FROM events";
    //Query execution
    $ExecQuery = MySQLi_query($con, $Query);


    if (isset($_GET['eventNewCount'])) {
        $eventCount = $_GET['eventNewCount'];
        $Query = "SELECT * FROM events LIMIT $eventCount";
        $ExecQuery = MySQLi_query($con, $Query);
        $row = MySQLi_fetch_array($ExecQuery);
    } else {
        $Query = "SELECT * FROM events LIMIT 3";
        $ExecQuery = MySQLi_query($con, $Query);
        $row = MySQLi_fetch_array($ExecQuery);

    }
    */

/*
//Search query.
$Query = "SELECT * FROM events";
//Query execution
$ExecQuery = MySQLi_query($con, $Query);

$row = MySQLi_fetch_array($ExecQuery);
if ($row) {
    // output data of each row
    if (isset($_GET['eventNewCount'])) {
        $eventCount = $_GET['eventNewCount'];
        $Query = "SELECT * FROM events LIMIT $eventCount";
        $ExecQuery = MySQLi_query($con, $Query);
        $row = MySQLi_fetch_array($ExecQuery);
    } else {
        $Query = "SELECT * FROM events LIMIT 3";
        $ExecQuery = MySQLi_query($con, $Query);
        $row = MySQLi_fetch_array($ExecQuery);

    }


}
*/
?>
