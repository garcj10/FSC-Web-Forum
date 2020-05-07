<?php
require('includes/pdocon.php');

$db = new Pdocon;
session_start();

$rawEventId = $_POST['event_Id'];
$event_Id = (int)$rawEventId;

$rawRating = $_POST['rating'];
$rating_Number = (int)$rawRating;

$title = $_POST['title'];

$usercomment = $_POST['comment'];

$rawEventId = $_POST['event_Id'];
$event_Id = (int)$rawEventId;

$user_Id = $_SESSION['user_data']['id'];

date_default_timezone_set('America/New_York');
$fulldate = date('Y-m-d H:i:s');

$db->query('SELECT * FROM feedback WHERE user_Id=:user_Id AND event_Id=:event_Id'); 
$db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
$db->bindvalue(':event_Id', $event_Id, PDO::PARAM_INT);
      
$row = $db->fetchSingle();

    if ($row)
    {
        echo '<div class="alert alert-danger text-center" style="font-family: Oswald, sans-serif;
             font-weight:300;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> You have already left a review for this event.
            </div>';
    } 

else {

        $db->query("INSERT INTO feedback(feedback_Id, event_Id, user_Id, ratingNumber, title, usercomment, date) VALUES(NULL, :event_Id, :user_Id, :ratingNumber, :title, :usercomment, :date)");
        
        $db->bindvalue(':event_Id', $event_Id, PDO::PARAM_INT);
        $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
        $db->bindvalue(':ratingNumber', $rating_Number, PDO::PARAM_INT);
        $db->bindvalue(':title', $title, PDO::PARAM_STR);
        $db->bindvalue(':usercomment', $usercomment, PDO::PARAM_STR);
        $db->bindvalue(':date', $fulldate, PDO::PARAM_STR);
        
        $run = $db->execute(); 

        if($run)
          {
                 echo '<div class="alert alert-success text-center" style="font-family: Oswald, sans-serif;
             font-weight:300;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Rating posted successfully.
                  </div>';
              

            } else {
                 echo '<div class="alert alert-danger text-center" style="font-family: Oswald, sans-serif;
             font-weight:300;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong>Rating could not be posted.
            </div>';

        }
}
?>
