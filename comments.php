<?php include('includes/header.php');

include('includes/functions.php');

require('includes/pdocon.php');
?> 
<style>

body {
  margin: 0;
margin-top: 70;
    background-color: #ddd;
}
    
textarea{
	width: 500px;
	height: 80px;
	background-color: #fff;
	resize:none;	
}


button{
	
width: 100px;
height: 30px;
background-color: #282828;
border:none;
color:#fff;
font-family: "Helvetica, sans-serif";
font-weight: 400;
cursor: pointer;
margin-bottom:4px;

}

.comment-box{
	
	width: 700px;
	padding:20px;
	margin-bottom:4px;
	background-color:#fff;
	border-radius: 4px;
	position: relative;
      box-shadow: 0 0 15px #888;
}
    

.comment-box p{
	
	font-family: "Helvetica, sans-serif";
	font-size: 14px;
	line-height:16px;
	color: #282828;
	font-weight:100;

}

.edit-form{
	position: absolute;
	top:0px;
	right:0px;
}


.edit-form button{
	width:40px;
	height: 20px;
	color:#202020;
	background-color:transparent;
	opacity:0.7;
	
}

.edit-form button:hover{
		opacity:1;
}



.delete-form{
	position: absolute;
	top:0px;
	right:60px;
}


.delete-form button{
	width:40px;
	height: 20px;
	color:#202020;
	background-color:transparent;
	opacity:0.7;
	
}

.delete-form button:hover{
		opacity:1;
}
    
</style>
<?php
$db = new Pdocon;

$event_Id = $_GET['event_id'];
date_default_timezone_set('America/New_York');
$fulldate = date('Y-m-d H:i:s');
if(isset($_POST['commentSubmit'])){	

	   $user_Id = $_SESSION['user_data']['id'];
    
	   $usercomment = $_POST['usercomment'];
        
        $db->query("INSERT INTO feedback(feedback_Id, user_Id, event_Id, date, usercomment) VALUES(NULL, :user_Id, :event_Id, :fulldate, :usercomment)");
    
        $db->bindValue(':usercomment', $usercomment, PDO::PARAM_STR);
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
        $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);
        
        $run = $db->execute();
	}

 if (isset($_POST['delete_comment'])){
        
            $feedback_Id = $_GET['feedback_id'];	
        
            $db->query("DELETE FROM feedback WHERE feedback_Id=:feedback_Id");
    
            $db->bindValue(':feedback_Id', $feedback_Id, PDO::PARAM_INT);
		
            $run = $db->execute();         
    }

if (isset($_POST['edit_comment'])){
    $feedback_Id = $_GET['feedback_id'];	
    
    $db->query('SELECT * FROM feedback WHERE feedback_Id=:feedback_Id'); 
    
    $db->bindValue(':feedback_Id', $feedback_Id, PDO::PARAM_INT);
    
    $row = $db->fetchSingle(); 
    
    $usercomment = $row['usercomment'];
    ?> 
    
    <form method='POST'>

<textarea class="form-control" autofocus rows="3" type="comment" name="update_comment" class="form-control" id="update_comment"><?php echo $usercomment; ?></textarea>
                
 <div class="form-group">
    <button type="updateSubmit" name="updateSubmit">Send</button>
</div>
</form> <?php
    
} else { if (isset($_POST['updateSubmit']))
    {
        $feedback_Id = $_GET['feedback_id'];
        $update_comment = $_POST['update_comment'];
		
        $db->query("UPDATE feedback SET usercomment=:update_comment, date=:fulldate WHERE feedback_Id=:feedback_Id");
    
        $db->bindValue(':update_comment', $update_comment, PDO::PARAM_STR);
        $db->bindValue(':feedback_Id', $feedback_Id, PDO::PARAM_INT);
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
		
        $run = $db->execute();      
    }
?>  
               
<form method='POST'>

<textarea class="form-control" rows="3" type="comment" name="usercomment" class="form-control" id="usercomment" placeholder="Add a comment.."></textarea>
                
 <div class="form-group">
    <button type="submit" name="commentSubmit">Send</button>
</div>
</form>
<?php } 
     
    $db->query('SELECT * FROM feedback WHERE event_Id=:event_Id ORDER BY feedback_Id ASC');
    $db->bindValue(':event_Id', $event_Id, PDO::PARAM_INT);

    $row = $db->fetchMultiple();
    
foreach($row as $comment) { ?>
<div class='comment-box'><p>
    <?php  $db->query('SELECT * FROM fsc_Users WHERE user_Id=:user_Id'); 
    
    $db->bindValue(':user_Id', $comment['user_Id'], PDO::PARAM_INT);
    
    $row = $db->fetchSingle(); 
    $firstName = $row['first_Name'];
    $lastName = $row['last_Name'];
    $email = $row['email'];
                           
    $datetime = $comment['date']; 
                           
    $db->query('SELECT * FROM feedback WHERE user_Id=:user_Id');
    $user_Id = $_SESSION['user_data']['id'];
    $db->bindValue(':user_Id', $user_Id, PDO::PARAM_INT);
    $row = $db->fetchSingle(); 
    
                
            echo $firstName. " " . $lastName . " - " . $email . "<br><br>";
			echo "Last updated: " . date('n/j/y, g:ia', strtotime($datetime)) . "<br><br>";
			echo nl2br($comment['usercomment']);	
    ?> </p>
    
    <form class='delete-form' method='POST' action="comments.php?event_id=<?php echo $event_Id; ?>&feedback_id=<?php echo $comment["feedback_Id"]; ?>">
			<input type='hidden' name='feedback_Id' value="<?php echo $comment['feedback_Id'] ?>"> 
			
			<?php if($comment['user_Id'] == $row['user_Id']) { ?>
			<button type='submit' name='delete_comment'>Delete</button> <?php } ?>
		</form>
			
		<form class='edit-form' method='POST' action="comments.php?event_id=<?php echo $event_Id; ?>&feedback_id=<?php echo $comment["feedback_Id"]; ?>">
			<input type='hidden' name='feedback_id' value="<?php echo $comment['feedback_Id']; ?>" >
			<input type='hidden' name='user_Id' value="echo $comment['user_Id']; ?>">
			<input type='hidden' name='date' value="<?php echo $comment['date']; ?>" >
			<input type='hidden' name='edit_comment' value="<?php echo $comment['usercomment']; ?>">
           <?php if($comment['user_Id'] == $row['user_Id']) { ?>
            <button>Edit</button> <?php } ?>
		
    </form>
</div>    
     <?php }  ?>

