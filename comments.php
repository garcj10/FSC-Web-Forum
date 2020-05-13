<?php include('includes/header.php');

include('includes/functions.php');

require('includes/pdocon.php');
?> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</script>


<style>
    
    .ratingSection
    {
        display:none;
        width: 90%;
    }
    
.ratingTable
    {
        margin-left : 25%;
       
    }
    
.btn-grey{
    background-color:#D8D8D8;
	color:#FFF;
}
.rating-block{
	background-color:#FAFAFA;
	border:1px solid #EFEFEF;
	padding:15px 15px 20px 15px;
	border-radius:3px;
}
.bold{
	font-weight:700;
}
.padding-bottom-7{
	padding-bottom:7px;
}

.review-block{
	background-color:#FAFAFA;
	border:1px solid #EFEFEF;
	padding:15px;
	border-radius:3px;
	margin-bottom:15px;
}
.review-block-name{
	font-size:12px;
	margin:10px 0;
}
.review-block-date{
	font-size:12px;
}
.review-block-rate{
	font-size:13px;
	margin-bottom:15px;
}
.review-block-title{
	font-size:15px;
	font-weight:700;
	margin-bottom:10px;
}
.review-block-description{
	font-size:13px;
}
</style>
<div class="ratingTable">
<div class="container">		

  <?php
	//include_once("db_connect.php");

    $db = new Pdocon;

	$event_Id = $_POST['id'];
		
	//$feedback_Id = $_POST['feedback_Id'];
	//$db->query('SELECT * FROM feedback WHERE feedback_Id=:feedback_Id');
	//$db->bindValue(':feedback_Id', $feedback_Id , PDO::PARAM_INT);
	//$row = $db->fetchSingle();
	//$rateResult = $row['ratingNumber'];
	
	//$ratingDetails = $db->query("SELECT ratingNumber FROM feedback");
	//$rateResult = mysqli_query($conn, $ratingDetails) or die("database error:". mysqli_error($conn));
	
	$db->query('SELECT * FROM feedback WHERE event_Id=:event_Id');
    $db->bindValue(':event_Id', $event_Id , PDO::PARAM_INT);
    $row = $db->fetchMultiple();
    
    if($row){
    
	$ratingNumber = 0;
	$count = 0;
	$fiveStarRating = 0;
	$fourStarRating = 0;
	$threeStarRating = 0;
	$twoStarRating = 0;
	$oneStarRating = 0;
    
	//while($rate = mysqli_fetch_assoc($rateResult)) 
    foreach($row as $rate) {
        
		$ratingNumber+= $rate['ratingNumber'];
		$count += 1;
		if($rate['ratingNumber'] == 5) {
			$fiveStarRating +=1;
		} else if($rate['ratingNumber'] == 4) {
			$fourStarRating +=1;
		} else if($rate['ratingNumber'] == 3) {
			$threeStarRating +=1;
		} else if($rate['ratingNumber'] == 2) {
			$twoStarRating +=1;
		} else if($rate['ratingNumber'] == 1) {
			$oneStarRating +=1;
		}
	}
	$average = 0;
	if($ratingNumber && $count) {
		$average = $ratingNumber/$count;
	}	
	?>		
	<br>
   
    <div id="results">
    </div>
	<div id="ratingDetails"> 		
		<div class="row">			
			<div class="col-sm-3">				
				<h4>Rating and Reviews</h4>
				<h2 class="bold padding-bottom-7"><?php printf('%.1f', $average); ?> <small>/ 5</small></h2>				
				<?php
				$averageRating = round($average, 0);
				for ($i = 1; $i <= 5; $i++) {
					$ratingClass = "btn-default btn-grey";
					if($i <= $averageRating) {
						$ratingClass = "btn-warning";
					}
				?>
				<button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
				  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
				</button>	
				<?php } ?>				
			</div>
			<div class="col-sm-3">
				<?php
				$fiveStarRatingPercent = round(($fiveStarRating/5)*100);
				$fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';	
				
				$fourStarRatingPercent = round(($fourStarRating/5)*100);
				$fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
				
				$threeStarRatingPercent = round(($threeStarRating/5)*100);
				$threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
				
				$twoStarRatingPercent = round(($twoStarRating/5)*100);
				$twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
				
				$oneStarRatingPercent = round(($oneStarRating/5)*100);
				$oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
				
				?>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $fiveStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $fiveStarRating; ?></div>
				</div>
				
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $fourStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $fourStarRating; ?></div>
				</div>
				
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $threeStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $threeStarRating; ?></div>
				</div>
				
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $twoStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $twoStarRating; ?></div>
				</div>
				
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $oneStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $oneStarRating; ?></div>
				</div>
				
			</div>	
			
            
               
               <?php
                
                $db->query('SELECT * FROM events_List WHERE event_Id=:event_Id');
                $db->bindValue(':event_Id', $event_Id , PDO::PARAM_INT);
                $row = $db->fetchSingle();
                $list_Id = $row['list_Id'];
                
                $user_Id = $_SESSION['user_data']['id'];
        
                $db->query('SELECT * FROM attendees WHERE list_Id=:list_Id AND user_Id=:user_Id');
                $db->bindValue(':list_Id', $list_Id , PDO::PARAM_INT);
                $db->bindValue(':user_Id', $user_Id , PDO::PARAM_INT);
                $row = $db->fetchSingle();
            
    
                if($row){
					?>
               
               <div class="col-sm-3"><form class="btn btn-default" id="rateProduct"  action="saveRating.php" method='post'>Rate this Event<input type='hidden' name='event_id' value='<?php echo $event_Id; ?>'><input type='hidden' name='id' value='<?php echo $event_Id; ?>'></form>
           
			</div>	<?php 
                } 
        
        ?>
                
			
		</div>
		<div class="row">
			<div class="col-sm-7">
				<hr/>
				<div class="review-block">		
				<?php
				
                $db->query('SELECT * FROM feedback WHERE event_Id=:event_Id');
                $db->bindValue(':event_Id', $event_Id , PDO::PARAM_INT);
                $row = $db->fetchMultiple();
                    
                    
				//$ratingResult = mysqli_query($conn, $ratinguery) or die("database error:". mysqli_error($conn));
				//while($rating = mysqli_fetch_assoc($ratingResult))
                
                foreach($row as $rating)
                {
					$date=date_create($rating['date']);
					$reviewDate = date_format($date,"M d, Y");	
                    
                    
                    $db->query('SELECT * FROM fsc_Users WHERE user_Id=:user_Id');
                    $db->bindValue(':user_Id', $rating['user_Id'] , PDO::PARAM_INT);
                    $row = $db->fetchSingle();
                    
				?>				
				

				<?php // BUTTON THAT ALLOWS USER TO DELETE ONLY COMMENTS THAT ARE THEIR OWN:
                    
                    if($rating['user_Id'] == $_SESSION['user_data']['id']) { 
                    ?>
                    <form id="deleteButton" method="post"><button type='submit' class="button" id="delete_comment" name='delete_comment'>Delete</button></form> <?php } 
                    ?>
                    
                    
					<div class="row">
						<div class="col-sm-3">
							<div class="review-block-name"><?php echo $row['first_Name'] . " " . $row['last_Name'] . " - " . $row['email']; ?></div>
							<div class="review-block-date"><?php echo $reviewDate; ?></div>
						</div>
						<div class="col-sm-9">
							<div class="review-block-rate">
								<?php
								for ($i = 1; $i <= 5; $i++) {
									$ratingClass = "btn-default btn-grey";
									if($i <= $rating['ratingNumber']) {
										$ratingClass = "btn-warning";
									}
								?>
								<button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>								
								<?php } ?>
							</div>
							<div class="review-block-title"><?php echo $rating['title']; ?></div>
							<div class="review-block-description"><?php echo $rating['usercomment']; ?></div>
						</div>
					</div>
					<hr/>					
				<?php } 
    }   else {
    
                $db->query('SELECT * FROM events_List WHERE event_Id=:event_Id');
                $db->bindValue(':event_Id', $event_Id , PDO::PARAM_INT);
                $row = $db->fetchSingle();
                $list_Id = $row['list_Id'];
                
                $user_Id = $_SESSION['user_data']['id'];
        
                $db->query('SELECT * FROM attendees WHERE list_Id=:list_Id AND user_Id=:user_Id');
                $db->bindValue(':list_Id', $list_Id , PDO::PARAM_INT);
                $db->bindValue(':user_Id', $user_Id , PDO::PARAM_INT);
                $row = $db->fetchSingle();
            
    
                if($row){
				?> 
                    <form class="btn btn-default" id="rateProduct"  action="saveRating.php" method='post'>Rate this Event<input type='hidden' name='event_id' value='<?php echo $event_Id; ?>'><input type='hidden' name='id' value='<?php echo $event_Id; ?>'></form> 
                <?php
                } 
        
                        echo '<h1 style="font-family: Oswald, sans-serif;">No ratings have been posted yet!</h1>'; 
                        
                    }
                
?>
				</div>
			</div>
		</div>	
	</div>
    </div>
    
	<div class="ratingSection" id="ratingSection">
		<div class="row">
			<div class="col-sm-12">
				<form id="ratingForm" method="POST">
					<div class="form-group">
						<h4>Rate this Event</h4>
						<button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
                
						
						<!-- <input type="hidden" class="form-control" id="rating" name="rating" value="1"> -->
						<!-- <input type="hidden" class="form-control" id="event_Id" name="event_Id" value="12345678"> -->
						
						<input type="hidden" class="form-control" id="rating" name="rating">
				
						
						
					</div>		
					<div class="form-group">
						<label for="usr">Title*</label>
						<input type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="form-group">
						<label for="comment">Comment*</label>
						<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info" method="post" id="submit">Save Review</button> 
						<button type="button" class="btn btn-info" id="cancelReview">Cancel</button>
					</div>			
				</form>
			</div>
		</div>
	</div>				
	<script>
        
	//$(function() {
    //$(document).ready(function() {
	// rating form hide/show
 	$("#rateProduct").click(function() {
		$("#ratingDetails").hide();
		$("#ratingSection").show();
	});	
	$( "#cancelReview" ).click(function() {
		$("#ratingSection").hide();
		$("#ratingDetails").show();		
	});	
	// implement start rating select/deselect
	$( ".rateButton" ).click(function() {
		if($(this).hasClass('btn-grey')) {			
			$(this).removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).prevAll('.rateButton').removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');			
		} else {						
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');
		}
		$("#rating").val($('.star-selected').length);		
	});

    $(document).on("click","#rateProduct", function(event){
        //alert("worked");
    });

	// save review using Ajax
    //$(document).on("click","#rateProducts", function(event){
	$('#ratingForm').on('submit', function(event){

		event.preventDefault();
		var formData = $(this).serialize();
        var comment = $("#comment").val();
        var title = $("#title").val();
        var rating = $("#rating").val();
        var formData = 'comment'+comment&'title'+title&'rating'+rating;
        var event_Id = "<?php echo $event_Id ?>";

        /*
		$.ajax({
			type : 'POST',
			url : 'saveRating.php',
			data : formData,
			success:function(response){
				 $("#ratingForm")[0].reset();
				 window.setTimeout(function(){window.location.reload()},3000)
			}
		});*/

        $.post('saveRating.php',{
            //data: formData,
            comment: comment,
            rating: rating,
            title: title,
            event_Id: event_Id
            }
        
        ).done(function(data, textStatus)
        {
            $('#results').html(data);
            $("#ratingForm")[0].reset();
            window.setTimeout(function(){window.location.reload()},2000)

        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            $("#ratingForm")[0].reset();
            window.setTimeout(function(){window.location.reload()},2000)
            //alert(textStatus);
            //alert(errorThrown);
        });
	});
        
    
    $('#deleteButton').on('submit', function(event){

        event.preventDefault();
        var event_Id = "<?php echo $event_Id ?>";

        $.post('deleteRating.php',{
            event_Id: event_Id
            }
        ).done(function(data, textStatus)
        {
           // alert("success");
           $('#results').html(data);
            //$("#ratingForm")[0].reset();
             window.setTimeout(function(){window.location.reload()},2000) 

        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            $("#ratingForm")[0].reset();
            window.setTimeout(function(){window.location.reload()},2000)
            //alert(textStatus);
            //alert(errorThrown);
        });
	});
        
//});


	</script>
</div>	

