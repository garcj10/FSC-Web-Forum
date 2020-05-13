<?php include('includes/header.php'); 
include('includes/pdocon.php'); ?>

<style>

tbody
{
    cursor:pointer;
}
.scrollable
    {
        height: 400px;
        width:auto;
        overflow: scroll;
    }
  
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th
    {
        color: #006f71;
    }
}

</style>


 <link href="css/style_dash.css" rel="stylesheet" type="text/css">

<div name="adminOutcome" id="adminOutcome"></div>

<div class="events">
          <div class="scrollable">
      <h1 align="center">Administrative Rights</h1>
    <table class="table table-hover">

  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
        <th scope="col">Role</th>
    </tr>
  </thead>
        
           <?php 
        $db = new Pdocon;
     
        $db->query('SELECT * FROM fsc_Users');
        $row = $db->fetchMultiple();
        foreach($row as $user)
        { 
           ?>    <tbody value="<?php echo $user['user_Id']; ?>">
               
                <tr>
                <td><?php echo $user['user_Id'];?></td>
                <td><?php echo $user['first_Name'];?></td>
                <td><?php echo $user['last_Name'];?></td>
                <td><?php echo $user['email'];?></td>
                
            <?php  
                $db->query('SELECT * FROM admin WHERE user_Id=:user_Id');
                $db->bindvalue(':user_Id', $user['user_Id'], PDO::PARAM_INT);
                $row = $db->fetchMultiple();
                if ($row)
                { ?>  
                    <td><?php echo "Admin";?></td>
                     <?php
                } else {  ?> 
               
               <td><?php echo "User";?></td> 
               
               </tr>   
  
    
    <?php } ?>
     
   
                
         
  <?php }
    ?>
 </tbody>
</table>
    </div>
</div>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");
    
    
    // Sends an AJAX request to the event_registry.php page when an
    // events register button is pressed. Requests will contain the events ID
    $(document).on("click", "tbody", function(){
        // takes the id from the value attribute
        var user_id = $(this).attr('value');

        // will execute the ajax request only if the confirm prompt returns true
        if (confirm("Are you sure you would like to make this user an admin?")) {
            $.post('includes/make_admin.php',{
                    user_id: user_id
                }
            ).done(function(data, textStatus)
            {
                // loads the outcome into the #registerOutcome div at the top of the page
                $('#adminOutcome').html(data);

            }).fail(function(jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);
                alert(errorThrown);
            });
            
        } else {

        }
        return false;
    });

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("danger_button")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php include('includes/footer.php');