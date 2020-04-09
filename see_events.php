<?php include('includes/header.php');

include('includes/functions.php');

require('includes/pdocon.php');
?>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

    <!-- CSS that styles the side bar and table -->

</script>
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

.verticalLine {
  border-left: 2px solid black;
  height: 120%;
  position: absolute;
  left: 15%;
  margin-left: -3px;
  top: 0;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: green;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
  margin-left: 10px;
}

/* Left and right column */
.column.side {
  width: 15%;
  
}

/* Middle column */
.column.middle {
  width: 70%;
  margin-left: 5px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }
}

/* Style the sidenav links and the dropdown button */
.sidenav input, .dropdown-btn {
  padding: 6px 8px 20px 6px;
  text-decoration: none;
  font-size: 20px;
  color: #181818;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav input:hover, .dropdown-btn:hover {
  color: #1abc9c;
  
}

/* Dropdown Menu Design */
.sidenav button, .dropdown-btn {
  padding: 6px 8px 20px 6px;
  text-decoration: none;
  font-size: 20px;
  color: #181818;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav button:hover, .dropdown-btn:hover {
  color: #1abc9c;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: green;
  color: white;
}

/* Dropdown container (hidden by default). */
.dropdown-container {
  display: none;
  background-color: #eee;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  padding-left: 8px;
}
    
/* Dropdown Box */

.dropdown-content {
    display: none;
    position: absolute;
    background-color: lightgrey;
    min-width: 175px;
    z-index: 1;
}

/* Dropdown Box Selection */

.dropdown-content input {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Hover for Dropdown Buttons */
.dropdown-content input:hover {background-color: white;}

/* Table Design */
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;

}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

    .event_page{
        margin-top: 10%;
    }
</style>
 <div class="row event_page">
   <div class="column side">
 <div class="sidenav">

<! Side Bar Form with Filters >
 <form name="filter" method="GET" action="see_events.php">
<input type="submit" name="all" value="All Events" class="dropdown-btn" default>
<br>
<button type="button" class="dropdown-btn">Event Type<i class="fa fa-caret-down"></i></button>
<div class="dropdown-content">
<input type="submit" name="fsc" value="FSC">
<input type="submit" name="clubs" value="Clubs">
<input type="submit" name="athletics" value="Athletics">
<input type="submit" name="tutoring" value="Tutoring">
<input type="submit" name="academics" value="Academics">
<input type="submit" name="admissions" value="Admissions">
</div>
<br>
<button type="button" class="dropdown-btn">Date<i class="fa fa-caret-down"></i></button>
<div class="dropdown-content">
<input type="submit" name="oldest" value="Date (oldest)">
<input type="submit" name="newest" value="Date (newest)">
<input type="submit" name="upcoming" value="Date (upcoming)">
</div>
<br>
<input type="submit" name="time" value="Time" class="dropdown-btn">
<br>
<input type="submit" name="location" value="Location" class="dropdown-btn">
</form>
</div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
  </div>
  <div class="verticalLine"></div>
  <div class="column middle">
  <div class="search-container">
  
	<h2>Events</h2>
<! If Statment for Filters >

<?php
// Create connection
$db = new Pdocon;
      
date_default_timezone_set('America/New_York');
$fulldate = date('Y-m-d');

// Initial event count to be displayed
$eventCount = 10;
// Event count to be incremented when "More events" button is clicked
$eventCountIncrement = 10;
      
/* FOR FILTERING CURRENT DATE, FUTURE, OR PREVIOUS DATES:

$db->query('SELECT * FROM events WHERE date >=:fulldate'); 
    
$db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
      
$row = $db->fetchMultiple(); */
      
// DISPLAYS ALL EVENTS BY DEFAULT (MOST RECENTLY CREATED)
$db->query('SELECT * FROM events');
$row = $db->fetchMultiple();
if ($row) {
    /* output data of each row
     * event_Type is used within load-events.php to keep track of which
     * table is being viewed
     */
	if (isset($_GET['all'])) {
        $db->query('SELECT * FROM events LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        $event_Type = 'all';
	}  
	else if (isset($_GET['fsc'])) {
        $event_Type = 'FSC';
        $db->query('SELECT * FROM events WHERE event_Type =:FSC LIMIT :eventCount');
        $db->bindValue(':FSC', $event_Type, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
	} 
	else if (isset($_GET['clubs'])) {
        $event_Type = 'Clubs';
        $db->query('SELECT * FROM events WHERE event_Type =:clubs LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $db->bindValue(':clubs', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
	} 
	else if (isset($_GET['athletics'])) {
        $event_Type = 'Athletics';
        $db->query('SELECT * FROM events WHERE event_Type =:athletics LIMIT :eventCount');
        $db->bindValue(':athletics', $event_Type, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
	} 
	else if (isset($_GET['tutoring'])) {
        $event_Type = 'Tutoring';
        $db->query('SELECT * FROM events WHERE event_Type =:tutoring LIMIT :eventCount');
        $db->bindValue(':tutoring', $event_Type, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
	} 
	else if (isset($_GET['academics'])) {
        $event_Type = 'Academics';
        $db->query('SELECT * FROM events WHERE event_Type =:academics LIMIT :eventCount');
        $db->bindValue(':academics', $event_Type, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
	} 
	else if (isset($_GET['admissions'])) {
        $event_Type = 'Admissions';
        $db->query('SELECT * FROM events WHERE event_Type =:admissions LIMIT :eventCount');
        $db->bindValue(':admissions', $event_Type, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
	} 
	else if (isset($_GET['newest'])) {
        $db->query('SELECT * FROM events WHERE date <=:fulldate ORDER BY date DESC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        $event_Type = 'newest';
	} 
    else if (isset($_GET['oldest'])) {
         $db->query('SELECT * FROM events WHERE date <=:fulldate ORDER BY date ASC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        $event_Type = 'oldest';
	} 
    else if (isset($_GET['upcoming'])) {
         $db->query('SELECT * FROM events WHERE date >=:fulldate ORDER BY date ASC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        $event_Type = 'upcoming';
	} 
	else if (isset($_GET['time'])) {
	    $db->query('SELECT * FROM events ORDER BY time LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        $event_Type = 'time';
	}	
	else if (isset($_GET['location'])) {
        $db->query('SELECT * FROM events ORDER BY location LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        $event_Type = 'location';
	}
	else {
        $db->query('SELECT * FROM events LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
        $event_Type = 'all';
    }
?>
</script>
<! Table that Displays Information >
<?php echo "Today's Date: " . date('n/d/Y', strtotime($fulldate))?>
<br>
<! Table Header >
<table>
  <thead>
  <tr>
	<th>Title</th>
    <th>Type</th>
	<th>Description</th>
	<th>Location</th>
	<th>Date</th>
	<th>Time</th>
  </tr>
</thead>
<! Table Row for each Event Entry >
<tbody id="myTable">
<?php
//while($row = $result->fetch_assoc()){
   foreach($row as $event)
    {
        $time = $event["time"];
        $date = $event["date"];
        
        echo "<tr><td>" . $event["event_Title"]. "</td><td>" . $event["event_Type"]. "</td><td>" . $event["description"]. "</td><td>" . $event["location"]. "</td><td>" .  date('n/d/Y', strtotime($date)) . "</td><td>" . date('g:i A', strtotime($time)) . "</td></tr>";
        //echo "<div>"." hello this is where comments will go"."</div>";
    }
//}
?>
</tbody>	
</table>
<button id="moreEvents">SHOW MORE EVENTS</button>
<! Will execute if nothing is in the table >
<?php
}
else { echo "No events found."; }
?>	 
  </div>
  </div>
</div>
<script>

$(document).ready(function() {
    var eventCount = <?php echo $eventCount ?>;
    var eventCountInc = <?php echo $eventCountIncrement ?>;
    var event_type = "<?php echo $event_Type ?>";
    var fullDate = "<?php echo $fulldate ?>";
    // Refreshes the table being viewed on an interval
    setInterval(update_content,60000); // 60 seconds

    // When "more events" button is clicked - Increases the limit
    // of the query to be executed withing update_content
    $("#moreEvents").click(function(){
        eventCount = eventCount + eventCountInc;
        //alert(userchoice);
        update_content();
    });

    // Runs load-event.php which updates the events table
    function update_content(){
        //alert("RELOADED");
        $("#myTable").load("includes/load-events.php", {
            eventNewCount: eventCount,
            event_Type: event_type,
            fulldate: fullDate
        });
    }
});
      </script>
<?php include('includes/footer.php'); ?>