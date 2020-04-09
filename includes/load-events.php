<?php
require('pdocon.php');

$db = new Pdocon;

$eventNewCount = $_POST['eventNewCount'];
$event_Type = $_POST['event_Type'];
$fulldate = $_POST['fulldate'];

$db->query('SELECT * FROM events');
$row = $db->fetchMultiple();
if ($row) {
    // output data of each row
    if ($event_Type == "all") {
        $db->query('SELECT * FROM events LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "FSC") {
        $event_Type = 'FSC';
        $db->query('SELECT * FROM events WHERE event_Type =:FSC LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':FSC', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Clubs") {
        $event_Type = 'Clubs';
        $db->query('SELECT * FROM events WHERE event_Type =:clubs LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':clubs', $event_Type, PDO::PARAM_STR);
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

    foreach ($row as $event) {
        $time = $event["time"];
        $date = $event["date"];

        echo "<tr><td>" . $event["event_Title"] . "</td><td>" . $event["event_Type"] . "</td><td>" . $event["description"] . "</td><td>" . $event["location"] . "</td><td>" . date('n/d/Y', strtotime($date)) . "</td><td>" . date('g:i A', strtotime($time)) . "</td></tr>";
        //echo "<div>"." hello this is where comments will go"."</div>";
    }
}
?>