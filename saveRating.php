<?php
$db = new Pdocon;

if(!empty($_POST['rating']) && !empty($_POST['itemId'])){
	$itemId = $_POST['itemId'];
	$userID = 1234567;		
	$insertRating = "INSERT INTO item_rating (itemId, userId, ratingNumber, title, comments, created, modified) VALUES 
	('".$itemId."', '".$userID."', '".$_POST['rating']."', '".$_POST['title']."', '".$_POST["comment"]."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
	mysqli_query($conn, $insertRating) or die("database error: ". mysqli_error($conn));		
	echo "rating saved!";
}

/*
$event_Id = $_POST['event_Id'];
$user_Id = $_SESSION['user_data']['id'];
$rating_Number = $_POST['rating'];
$title = $_POST['title'];
$usercomment = $_POST['comment'];

date_default_timezone_set('America/New_York');
$fulldate = date('Y-m-d H:i:s');
    

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
                 echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Rating posted successfully.
                  </div>';
              
        header("Refresh:2; url=my_account.php", true, 303);
        
            } else {
                 echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong>Rating could not be posted.
            </div>';
    } */
        

?>
