<?php 
//Include functions:
include('includes/header.php'); 

include('includes/functions.php');

require('includes/pdocon.php');
?>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</script>
<link href="css/style_dash.css" rel="stylesheet" type="text/css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<style>
	
	.pad{
		padding:3%;
	}
	.upper{
		text-transform: uppercase;
		color:rgb(255,223,0);
	}
    .card {
        
        padding:2% 2% 2% 2%;
        margin: 1% ;
        background-color: #fbfbfd;
        color: black;
		
    
		
		-webkit-box-shadow: 0px 0px 29px -8px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 0px 29px -8px rgba(0,0,0,0.75);
		box-shadow: 0px 0px 29px -8px rgba(0,0,0,0.75);
    }

    * {
        margin: 0;
        padding: 0;

    }

    body {
        background: white;
       font-family: 'Oswald', sans-serif;
    font-weight:300;
    }

    ul {
        list-style-type: none;
    }

    a {
        color: #b63b4d;
        text-decoration: none;
    }



    /** =======================
 * Contenedor Principal
 ===========================*/




    .accordion {

        width: 100%;
        max-width: 360px;
        background: #444359;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }

    .accordion .link {
        cursor: pointer;
        display: block;
        padding: 15px 15px 15px 42px;
        color: white;
        font-size: 14px;
        font-weight: 700;
        border-bottom: 1px solid black;
        position: relative;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

.link:hover
    {
      background: green;
        color: #FFF;
    }

    .accordion li.open .link {
        color: green;
    }

    .accordion li.open i {
        color: green;
    }

    /**
 * Submenu
 -----------------------------*/

    .submenu {

        background-color: dimgray;
        font-size: 14px;
    }
    

    .submenu li {
        border-bottom: 1px solid #4b4a5e;
    }

    .submenu a {
        display: block;
        text-decoration: none;
        color: #d9d9d9;
        padding: 12px;
        padding-left: 42px;
        -webkit-transition: all 0.25s ease;
        -o-transition: all 0.25s ease;
        transition: all 0.25s ease;
        
    }

    .submenu a:hover {
        background: green;
        color: #FFF;
    }
	
	
	.rfloat{
		float:right;
	}
	.lfloat{
		float:right;
	}
	.pad{
		padding:1%;
	}
	
</style>




<div class="row totry">
    <div class="col-sm-2">


        <!-- Contenedor -->
        <ul id="accordion" class="accordion">
            <li>
                <div class="link">

                    </i>EVENT TYPE</>
                </div>
                <ul class="submenu">
                    <li class="sidemenu" name="all"><a href="# " class="all" name="all">ALL EVENTS</a></li>
                    <li class="sidemenu" name="FSC"><a href="# " class="test" name="fsc">FSC</a></li>
                    <li class="sidemenu" name="Club"><a href="#" name="club ">CLUB</a></li>
                    <li class="sidemenu" name="Athletics"><a href="#" name="athletics">ATHLETICS</a></li>
                    <li class="sidemenu" name="Tutoring"><a href="#" name="tutoring">TUTORING</a></li>
                    <li class="sidemenu" name="Academics"><a href="#" name="academics">ACADEMICS</a></li>
                    <li class="sidemenu" name="Admissions"><a href="#" name="admissions">ADMISSIONS</a></li>
                </ul>
            </li>

            <li>
                <div class="link">DATE</div>
                <ul class="submenu">
                    <li class="sidemenu" name="oldest"><a href="#" name="oldest">OLDEST</a></li>
                    <li class="sidemenu" name="newest"><a href="#" name="oldest">MOST RECENT</a></li>
                    <li class="sidemenu" name="upcoming"><a href="#" name="upcoming">UPCOMING</a></li>
                </ul>
            </li>

            <li>
                <div class="link">MORE</div>
                <ul class="submenu">
                    <li class="sidemenu" name="time"><a href="#" name="time">TIME</a></li>
                    <li class="sidemenu" name="location"><a href="#" name="location">LOCATION</a></li>

                </ul>
            </li>

        </ul>



        <! Side Bar Form with Filters><!--
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

    <form name="filter" method="GET" action="see_events.php">

        <input type="submit" name="all" value="All Events" class="dropdown-btn test ">

        <br>

        <button type="button" class="dropdown-btn testdash">Event Type<i class="fa fa-caret-down"></i></button>

        <div class="dropdown-content">

            <input type="submit" onclick="myFunction()" class="test" name="fsc" value="FSC">

            <input type="submit" name="club" value="Club">

            <input type="submit" name="athletics" value="Athletics">

            <input type="submit" name="tutoring" value="Tutoring">

            <input type="submit" name="academics" value="Academics">

            <input type="submit" name="admissions" value="Admissions">

        </div>

        <br>

        <button type="button" class="dropdown-btn">Date<i class="fa fa-caret-down"></i></button>

        <div class="dropdown-content">

            <input type="submit" name="oldest" value="Date (oldest)">

            <input type="submit" name="oldest" value="Date (newest)">

            <input type="submit" name="upcoming" value="Date (upcoming)">

        </div>

        <br>

        <input type="submit" name="time" value="Time" class="dropdown-btn">

        <br>

        <input type="submit" name="location" value="Location" class="dropdown-btn">

    </form>

-->
	
				
				
			
				
				
    </div>


<form name="filter" method="GET" action="see_events.php">
<input type="text" name="searchItem" style="width:800px" placeholder="Enter a search term..">
<input type="submit" name="search"  value="Search">
</form>
<div name="registerOutcome" id="registerOutcome"></div>







    <div class="col-lg-10">








<?php
// Create connection
$db = new Pdocon;

// Initial event count to be displayed
$eventCount =6;
// Event count to be incremented when "More events" button is clicked
$eventCountIncrement = 6;
// search variable used for load-events (needed because searchItem may be altered to %searchItem%)
$searchI="";

date_default_timezone_set('America/New_York');
$fulldate = date('Y-m-d');
      
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
        <! Table that Displays Information>
            <?php echo "Today's Date: " . date('n/d/Y', strtotime($fulldate))?>
            <br>
            <! Table Header>
                <! Table Row for each Event Entry>
        <div id = "myDiv">
                    <tbody id="myTable">


                        <?php
        
        
    
   foreach($row as $event)
    {
        $time = $event["time"];
        $date = $event["date"];

      echo'                           
  <div class="container card col-sm-3 upper">
      <h1 class="text-center">'.$event["event_Title"].'</h1>
	  <div class="lfloat pad"><b>'. $event["location"].'</b>
	  <i class="fa fa-street-view"></i>
	  </div>
          
      <div class="pad"><i class="fa fa-building"></i>'. $event["event_Type"].'</div>
              
                      <div class="lfloat pad">'. date('n/d/Y', strtotime($date)) .'<i class="fa fa-calendar" aria-hidden="true"></i></div>
                          <div class="pad"><i class="fa fa-hourglass-half "></i>'. date('g:i A', strtotime($time)) . '</div>
                           <div class="hides">
						 <i class="fa fa-list-ol"></i> Description<br>
					'.$event["description"].'</div>';
       if ($event["capacity"])
    { 
                $event_Id = $event["event_Id"];
        
                $db->query('SELECT * FROM events_list WHERE event_Id =:event_Id');
                $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                $list_Id = $row['list_Id'];
                
                $db->query('SELECT * FROM attendees WHERE user_Id =:user_Id AND list_Id=:list_Id');
                $db->bindValue(':user_Id', $_SESSION['user_data']['id'], PDO::PARAM_INT);
                $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
           
             if ($row['user_Id'])
                { ?>
                     
                 <form action='comments.php' method="post"><input type='hidden' name='id' value='<?php echo $event["event_Id"] ?>'><button type="submit" action="see_events.php" name='id' class="btn btn-link" value='<?php echo $event["event_Id"] ?>'>Leave a Comment</button></form> <?php
                } 
           else 
                { ?> 
             <div class="form-group">
                <div class="registerDiv">
                    <button type="submit"  name="signup" class="btn btn-link" value =<?php echo $event["event_Id"] ?> >
                    Register
                    </button>
                </div>
             </div>
              <?php  } 
                
                $db->query('SELECT * FROM attendees WHERE list_Id =:list_Id');
                $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
                $row = $db->fetchMultiple();
        
           // For each attendee for a particular event, retrieve and print all names on the list:
                foreach($row as $attendee)
                {
                    $currentId = $attendee["user_Id"];
                    $db->query('SELECT * FROM fsc_Users WHERE user_Id=:currentId');
                $db->bindValue(':currentId', $currentId, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                $name = "<br>" . $row['first_Name'] . " " . $row['last_Name'];
                    echo $name;
                }
           
           $db->query('SELECT COUNT(*) AS count FROM attendees WHERE list_Id =:list_Id');
            $db->bindvalue(':list_Id', $list_Id, PDO::PARAM_INT);
            $row = $db->fetchSingle();
        
           $spotsRemaining = $event["capacity"] - $row['count'] . "<br>";
           
           echo "<br>" . "Spots left: " . $spotsRemaining;
    
    
      }; 
                    
                    
                            
          echo '<button onclick="myFunction()" class="btn card_btn myclass">Read More</button>
  </div>';
    
    }

?>
                 </tbody>

</div>
                    <button id="moreEvents">Load More Events..</button>

                    <! Will execute if nothing is in the table>
                        <?php
}
else { echo "No events found."; }
?>

     <script>
		
			 $(".hides").hide();
			 $(".submenu").hide();
           
			 $( ".submenu:first" ).show();
			 
            $(".link").click(function() {

                
                $(this).next().toggle("slow");
				 
		

            });


			$(".myclass").click(function() {
				
                $(".hides").hide("slow");
				  $(this).prev( ".hides" ).toggle("slow");
				 
            });

            $(".hiding").click(function() {

                alert("Hello! I am an alert box!!");
            });

         
        </script>

    
    
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
        //alert("inside more events");
        eventCount = eventCount + eventCountInc;
         //alert("CLICKED");
        update_content();
    });

     // Runs load-events.php which updates the events table
    function update_content(){
        //alert("inside update content");
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
            $('#myDiv').html(data);

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
        eventCount = 6;
        update_content();
    });
});
        
 </script>
</div>