<?php include('includes/header.php');

include('includes/functions.php');

require('includes/pdocon.php');
?>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>
<!-- CSS that styles the side bar and table -->
* {
  box-sizing: border-box;
}
h2
{
    font-family: "Helvetica, sans-serif";
}
.search-container {
        font-family: "Helvetica, sans-serif";
    font-size: 20;
}
body {
  margin: 0;
margin-top: 70;
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
     font-family: "Helvetica, sans-serif";
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
</style>
 <div class="row event_page">
   <div class="column side">
 <div class="sidenav">

<! Side Bar Form with Filters >
 <form id="sidemenuform" name="filter" onsubmit="return false" >
<input class="sidemenu" type="submit" name="all" value="All Events" class="dropdown-btn" >
<br>
<button type="button" class="dropdown-btn">Event Type<i class="fa fa-caret-down"></i></button>
<div class="dropdown-content">
<input class="sidemenu" type="submit" name="FSC" value="FSC">
<input class="sidemenu" type="submit" name="Club" value="Clubs">
<input class="sidemenu" type="submit" name="Athletics" value="Athletics">
<input class="sidemenu" type="submit" name="Tutoring" value="Tutoring">
<input class="sidemenu" type="submit" name="Academics" value="Academics">
<input class="sidemenu" type="submit" name="Admissions" value="Admissions">
</div>
<br>
<button type="button" class="dropdown-btn">Date<i class="fa fa-caret-down"></i></button>
<div class="dropdown-content">
<input class="sidemenu" type="submit" name="oldest" value="Date (oldest)">
<input class="sidemenu" type="submit" name="newest" value="Date (newest)">
<input class="sidemenu" type="submit" name="upcoming" value="Date (upcoming)">
</div>
<br>
<input class="sidemenu" type="submit" name="time" value="Time" class="dropdown-btn">
<br>
<input class="sidemenu" type="submit" name="location" value="Location" class="dropdown-btn">
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

// Initial event count to be displayed
$eventCount = 5;
// Event count to be incremented when "More events" button is clicked
$eventCountIncrement = 5;
// search variable used for load-events (needed because searchItem may be altered to %searchItem%)
$searchI="";

date_default_timezone_set('America/New_York');
$fulldate = date('Y-m-d');
      
 /* FOR FILTERING CURRENT DATE, FUTURE, OR PREVIOUS DATES:
$db->query('SELECT * FROM events WHERE date =:fulldate'); 
// VARIABLE TO STORE TOMORROW'S DATE
$tomorrow = date('Y-m-d', strtotime("+1 day"));
    
$db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
      
$row = $db->fetchMultiple(); */
      
// DISPLAYS ALL EVENTS BY DEFAULT
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
    else if (isset($_GET['search'])) {
		$searchItem = $_GET['searchItem'];
        $searchI = $searchItem;
        // Selects everything from the database that is similar to what the user entered:
       $event_Type = 'search';

        // If the user enters a date, it formats it accordingly. Ex. If they enter 4/2 instead of 4/2/2020, it will still fetch the results.
       if(date('n/j/y', strtotime($searchItem)) == ($searchItem) OR date('n/j/Y', strtotime($searchItem)) == ($searchItem) OR date('n/j', strtotime($searchItem)) == ($searchItem)  OR date('n/d', strtotime($searchItem)) == ($searchItem) OR date('m/j', strtotime($searchItem)) == ($searchItem) OR date('m/d', strtotime($searchItem)) == ($searchItem)) 
        {
           // Converts dates the user entered into a format the DB can read:
           $dbFormat = date('Y-m-d', strtotime($searchItem));
           
            $db->query('SELECT * FROM `events` WHERE `date` LIKE :dbFormat LIMIT :eventCount');
            $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $row = $db->fetchMultiple();
        } 
      
        // If user enters a time with AM or PM, searches the database:
        else if (date('g:iA', strtotime($searchItem)) == ($searchItem) OR date('g:ia', strtotime($searchItem)) == ($searchItem))
       {
            $dbFormat = date('H:i:s', strtotime($searchItem));
            $db->query('SELECT * FROM `events` WHERE `time` LIKE :dbFormat LIMIT :eventCount');
            $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $row = $db->fetchMultiple();
        }  
        
        // If the user enters a time without the AM or PM:
        else if (date('g:i', strtotime($searchItem)) == ($searchItem))
       {
            // Converts the time to the format the database can read:
            $hour = (int)date('H', strtotime($searchItem));
            $minute = (int)date('i', strtotime($searchItem));
            if ($hour < 10 AND $minute > "00")
            {
                $format = $hour + 12 . ":" . $minute . ":00";
            } else if ($hour < 10) {
                 $format = $hour + 12 . ":00" . ":00";
            } else if ($minute > "00") {
                $format = $hour . ":" . $minute . ":00";
            } else {
                 $format = $hour . ":00" . ":00";
            }
            
            $dbFormat = date($format, strtotime($searchItem));
            $db->query('SELECT * FROM `events` WHERE `time` LIKE :dbFormat LIMIT :eventCount');
            $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $row = $db->fetchMultiple();
       }
        // If the user doesn't enter a date or time, searches for everything else:
        else {
        $searchItem = "%".$searchItem."%";
        // Selects everything from the database that is similar to what the user entered:
        $db->query('SELECT * FROM `events` WHERE `event_Title` LIKE :searchItem OR event_Type LIKE :searchItem OR description LIKE :searchItem OR date LIKE :searchItem OR time LIKE :searchItem OR location LIKE :searchItem LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $db->bindValue(':searchItem', $searchItem, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
       }
	}
    
	else if (isset($_GET['clubs'])) {
        $event_Type = 'Club';
        $db->query('SELECT * FROM events WHERE event_Type =:club LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventCount, PDO::PARAM_INT);
        $db->bindValue(':club', $event_Type, PDO::PARAM_STR);
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
	else if (isset($_GET['time'])) {  $db->query('SELECT * FROM events ORDER BY time LIMIT :eventCount');
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
<?php echo "Date: " . date('n/j/y', strtotime($fulldate))?>
<form name="filter" method="GET" action="see_events.php">
<input type="text" name="searchItem" style="width:800px" placeholder="Enter a search term..">
<input type="submit" name="search"  value="Search">
</form>
    <div name="registerOutcome" id="registerOutcome"></div>
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
    
        echo "<tr><td>" . $event["event_Title"] . "</td><td>" . $event["event_Type"] . "</td><td>" . $event["description"]. "</td><td>" . $event["location"]. "</td><td>" .  date('n/j/y', strtotime($date)) . "</td><td>" . date('g:iA', strtotime($time)); 
       
    // If an event row has a capacity, then allow them to sign up:
    if ($event["capacity"])
    {
    ?>
    <div class="form-group">
    <div class="registerDiv">
        <button type="submit"  name="signup" class="btn btn-link" value =<?php echo $event["event_Id"] ?> >
        Register
        </button>
    </div>
    
    
        <div class="form-group"><form action='comments.php' method="post"><input type='hidden' name='id' value='<?php echo $event["event_Id"] ?>'><button type="submit" action="see_events.php" name='id' class="btn btn-link" value='<?php echo $event["event_Id"] ?>'>Leave a Comment</button></form></div>  <?php  
      }; 
       
       echo "</td></tr>";
    }
 
//}
?>
</tbody>	
</table>
<button id="moreEvents">Load More Events..</button>
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
    var searchItem = "<?php echo $searchI ?>";

    // Refreshes the table being viewed on an interval
    setInterval(update_content,60000); // 60 seconds

    // When "more events" button is clicked - Increases the limit
    // of the query to be executed within update_content
    $("#moreEvents").click(function(){
        eventCount = eventCount + eventCountInc;
         //alert("CLICKED");
        update_content();
    });

     // Runs load-events.php which updates the events table
    function update_content(){
        //alert(event_type);
        $.get('includes/load-events.php',{
                eventNewCount: eventCount,
                event_Type: event_type,
                fulldate: fullDate,
                searchItem: searchItem
            }
        ).done(function(data, textStatus)
        {
            //alert(textStatus);
            //alert(data);
            $('#myTable').html(data);

        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            alert(textStatus);
            alert(errorThrown);
        });
    }

    // Sends an AJAX request to the event_registry.php page when an
    // events register button is pressed. Requests will contain the events ID
    $(document).on("click", ".registerDiv button", function(){
        // takes the event id from the register button value attribute
        var event_id = $(this).attr('value');

        // will execute the ajax request only if the confirm prompt returns true
        if (confirm("Are you sure you would like to register for this event?")) {
            $.post('includes/event_registry.php',{
                    event_id: event_id
                }
            ).done(function(data, textStatus)
            {
                // loads the outcome into the #registerOutcome div at the top of the page
                $('#registerOutcome').html(data);

            }).fail(function(jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);
                alert(errorThrown);
            });
            // hides the register button after it is clicked
            $(this).hide();

        } else {

        }
        return false;
    });

    //function will take the value in "name" and use it as the event type
    $(".sidemenu").click(function(){
        var val = $(this).attr('name');
        //alert(val);
        event_type = val;
        eventCount = 5;
        update_content();
    });
});
      </script>
<?php include('includes/footer.php'); ?>