<?php
require('includes/pdocon.php');

$db = new Pdocon;
session_start();

$rawEventId = $_POST['event_Id'];
$event_Id = (int)$rawEventId;
$user_Id = $_SESSION['user_data']['id'];

        $db->query("DELETE FROM feedback WHERE event_Id=:event_Id AND user_Id=:user_Id");
        
        $db->bindvalue(':event_Id', $event_Id, PDO::PARAM_INT);
        $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
        
        $run = $db->execute(); 

        if($run)
          {
                 echo '<div class="alert alert-success text-center" style="font-family: Oswald, sans-serif;
             font-weight:300;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Rating deleted successfully.
                  </div>';
              
      

            } else {
                 echo '<div class="alert alert-danger text-center" style="font-family: Oswald, sans-serif;
             font-weight:300;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong>Rating could not be deleted.
            </div>';

        } 

?>