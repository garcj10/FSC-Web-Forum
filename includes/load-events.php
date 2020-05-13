<?php 
require('pdocon.php');

$db = new Pdocon;
session_start();
if(isset($_GET['eventNewCount']))
{
    $rawCount = $_GET['eventNewCount'];
    $eventNewCount = (int)$rawCount;
}
if(isset($_GET['event_Type']))
{
    $event_Type = $_GET['event_Type'];
}
if(isset($_GET['fulldate']))
{
    $fulldate = $_GET['fulldate'];
}
if(isset($_GET['searchItem']))
{
    $searchItem = $_GET['searchItem'];
}

$db->query('SELECT * FROM events');
$row = $db->fetchMultiple();
if ($row) {
    // output data of each row
    if ($event_Type == "FSC") {
        $event_Type = 'FSC';
        $db->query('SELECT * FROM events WHERE event_Type =:FSC LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':FSC', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    }  else if ($event_Type == "search") {

        // If the user enters a date, it formats it accordingly. Ex. If they enter 4/2 instead of 4/2/2020, it will still fetch the results.
       if(date('n/j/y', strtotime($searchItem)) == ($searchItem) OR date('n/j/Y', strtotime($searchItem)) == ($searchItem) OR date('n/j', strtotime($searchItem)) == ($searchItem)  OR date('n/d', strtotime($searchItem)) == ($searchItem) OR date('m/j', strtotime($searchItem)) == ($searchItem) OR date('m/d', strtotime($searchItem)) == ($searchItem)) 
        {
           // Converts dates the user entered into a format the DB can read:
           $dbFormat = date('Y-m-d', strtotime($searchItem));
           
            $db->query('SELECT * FROM `events` WHERE `date` LIKE :dbFormat LIMIT :eventCount');
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
            $row = $db->fetchMultiple();
        } 
      
        // If user enters a time with AM or PM, searches the database:
        else if (date('g:iA', strtotime($searchItem)) == ($searchItem) OR date('g:ia', strtotime($searchItem)) == ($searchItem))
       {
            $dbFormat = date('H:i:s', strtotime($searchItem));
            $db->query('SELECT * FROM `events` WHERE `time` LIKE :dbFormat LIMIT :eventCount');
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
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
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
           $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
            $row = $db->fetchMultiple();
       }
        // If the user doesn't enter a date or time, searches for everything else:
      else {
        $searchItem = "%".$searchItem."%";
        // Selects everything from the database that is similar to what the user entered:
        $db->query('SELECT * FROM `events` WHERE `event_Title` LIKE :searchItem OR event_Type LIKE :searchItem OR description LIKE :searchItem OR date LIKE :searchItem OR time LIKE :searchItem OR location LIKE :searchItem LIMIT :eventCount');
        $db->bindValue(':searchItem', $searchItem, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
       }
	}
    else if ($event_Type == "Club") {
        $event_Type = 'Club';
        $db->query('SELECT * FROM events WHERE event_Type =:club LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':club', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Athletics") {
        $event_Type = 'Athletics';
        $db->query('SELECT * FROM events WHERE event_Type =:athletics LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':athletics', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Tutoring") {
        $event_Type = 'Tutoring';
        $db->query('SELECT * FROM events WHERE event_Type =:tutoring LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':tutoring', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Academics") {
        $event_Type = 'Academics';
        $db->query('SELECT * FROM events WHERE event_Type =:academics LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':academics', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Admissions") {
        $event_Type = 'Admissions';
        $db->query('SELECT * FROM events WHERE event_Type =:admissions LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':admissions', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "newest") {
        $db->query('SELECT * FROM events WHERE date <=:fulldate ORDER BY date DESC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "oldest") {
        $db->query('SELECT * FROM events WHERE date <=:fulldate ORDER BY date ASC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "upcoming") {
        $db->query('SELECT * FROM events WHERE date >=:fulldate ORDER BY date ASC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "time") {
        $db->query('SELECT * FROM events ORDER BY time LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "location") {
        $db->query('SELECT * FROM events ORDER BY location LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    }
    
   foreach($row as $event)
   {
        $time = $event["time"];
        $date = $event["date"];

      echo'                
      
     
    
  <div class="container card col-sm-3 upper">
  <div class="front">
      <div class="details">
      <h2 class="text-center titleSet">'.$event["event_Title"].'</h2>
      
	  <div class=" pad"><i class="fa fa-street-view"> </i>'. $event["location"].'</b>
	 
	  </div>
          
      <div class="pad"><i class="fa fa-building"></i>'. $event["event_Type"].'</div>
              
                      <div class=" pad"><i class="fa fa-calendar" aria-hidden="true"></i>'. date('n/d/y', strtotime($date)) .'</div>
                          <div class="pad"><i class="fa fa-hourglass-half "></i>'. date('g:i A', strtotime($time)) . '</div></div>';
        

    if($event["capacity"])
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
            
                $db->query('SELECT COUNT(*) AS count FROM attendees WHERE list_Id =:list_Id');
                $db->bindvalue(':list_Id', $list_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
        
                $eventStatus = "";
                $isFutureDate = (($date . " " . $time) >= date('Y-m-d H:i:s') ? true : false);

                if($isFutureDate) {

                    $spotsRemaining = $event["capacity"] - $row['count'] . "<br>";


                    if ($spotsRemaining == 0) {
                        $eventStatus = "Full";
                        $spotsRemaining = "Sorry! This event is full.";
                    }

 

                    echo '<i class="fa fa-check-square"></i>' . "Spots left: " . $spotsRemaining;
                }
        
                $db->query('SELECT * FROM attendees WHERE user_Id =:user_Id AND list_Id=:list_Id');
                $db->bindValue(':user_Id', $_SESSION['user_data']['id'], PDO::PARAM_INT);
                $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();

             if ($row['user_Id'])
                { 
                    if($isFutureDate) {
                        $eventStatus = "OPEN";
                        ?>
<div class="unRegisterDiv">
    <button class="btn card_btn myclass" type="submit" name="signup" value="<?php echo $event["event_Id"]; ?>">
        Unregister
    </button>
</div>
<?php
                    } else {
                        $eventStatus = "CLOSED";
                        ?>

<form action='comments.php' method="post"><input type='hidden' name='id' value='<?php echo $event["event_Id"] ?>'>
    <div class="commentDiv">
        <button type="submit" action="see_events.php" name='id' class="btn card_btn myclass" value='<?php echo $event["event_Id"] ?>'>
            Rate Event</button>
    </div>
</form>
<?php
                    }
                } 
           else {
               if($isFutureDate) {
                   $eventStatus = "OPEN";
                   ?>
<div class="registerDiv">
    <button class="btn card_btn myclass" type="submit" name="signup" class="btn btn-link" value='<?php echo $event["event_Id"] ?>'>
        Signup
    </button>
</div>
<?php
               } else { 
                  ?> <form action='comments.php' method="post"><input type='hidden' name='id' value='<?php echo $event["event_Id"] ?>'>
    <div class="commentDiv">
        <button type="submit" action="see_events.php" name='id' class="btn card_btn myclass" value='<?php echo $event["event_Id"] ?>'>
            Event Reviews</button>
    </div>
</form> <?php
                   $eventStatus = "CLOSED";
               }
           }
        echo '<div class="lfloat pad"><b>Status:  '.$eventStatus.'</b></div>';


        $db->query('SELECT * FROM attendees WHERE list_Id =:list_Id');
                $db->bindValue(':list_Id', $list_Id, PDO::PARAM_INT);
                $row = $db->fetchMultiple();
        
           /* For each attendee for a particular event, retrieve and print all names on the list:
                foreach($row as $attendee)
                {
                    $currentId = $attendee["user_Id"];
                    $db->query('SELECT * FROM fsc_Users WHERE user_Id=:currentId');
                $db->bindValue(':currentId', $currentId, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                $name = "<br>" . $row['first_Name'] . " " . $row['last_Name'];
                    echo $name; 
                } */
           
    
    
      }; 
          echo  '</div>
                       
                       <button onclick="myFunction()" id="myBtn" class="btn card_btn readMore">Read More</button>
                       
                       <div class="hides ">
                      
                       <div class="desc">
						 '.$event["event_Title"].'<br></div>
                         <div class="desc_details">
					'.$event["description"];
       
        
          
    
      echo ' </div></div>';
    

        echo '
  </div>'; 
    
   }

}
?>


<script>
    $(".front").show();
    $(".hides").hide();


    $(".submenu:first").show();



    $(".readmore").click(function() {

        //$(".front").toggle("slow");
        $(this).prev().toggle("slow");

        $(this).next().toggle("slow");

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
        setInterval(update_content, 60000); // 60 seconds

        // When "more events" button is clicked - Increases the limit
        // of the query to be executed within update_content
        $("#moreEvents").click(function() {
            //alert("inside more events");
            eventCount = eventCount + eventCountInc;
            //alert("CLICKED");
            update_content();
        });

        // Runs load-events.php which updates the events table
        function update_content() {
            //alert("inside update content");
            $.get('includes/load-events.php', {
                eventNewCount: eventCount,
                event_Type: event_type,
                fulldate: fullDate,
                searchItem: searchItem
            }).done(function(data, textStatus) {
                //alert(textStatus);
                //alert(data);
                $('#myDiv').html(data);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
                alert(errorThrown);
            });
        }
        // Sends an AJAX request to the event_registry.php page when an
        // events register button is pressed. Requests will contain the events ID
        $(document).on("click", ".registerDiv button", function() {
            // takes the event id from the register button value attribute
            var event_id = $(this).attr('value');

            // will execute the ajax request only if the confirm prompt returns true
            if (confirm("Are you sure you would like to sign up for this event?")) {
                $.post('includes/event_registry.php', {
                    event_id: event_id
                }).done(function(data, textStatus) {
                    // loads the outcome into the #registerOutcome div at the top of the page
                    $('#registerOutcome').html(data);

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                    alert(errorThrown);
                });
                // hides the register button after it is clicked
                $(this).hide();

            } else {

            }
            return false;
        });

        $(document).on("click", ".unRegisterDiv button", function() {
            // takes the event id from the register button value attribute
            var event_id = $(this).attr('value');

            // will execute the ajax request only if the confirm prompt returns true
            if (confirm("Are you sure you would like to unregister from this event?")) {
                $.post('includes/event_unregister.php', {
                    event_id: event_id
                }).done(function(data, textStatus) {
                    // loads the outcome into the #registerOutcome div at the top of the page
                    $('#registerOutcome').html(data);

                }).fail(function(jqXHR, textStatus, errorThrown) {
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
        $(".sidemenu").click(function() {
            var val = $(this).attr('name');
            //alert(val);
            event_type = val;
            eventCount = 6;
            update_content();
        });
    });

</script>
</div>
