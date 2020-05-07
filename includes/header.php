<?php 
//Open ob_start and session_start functions
    ob_start();
    session_start();
                
 if(isset($_SESSION['user_is_logged_in'])){
    
    $first_Name = $_SESSION['user_data']['firstName'];
    $last_Name = $_SESSION['user_data']['lastName'];
        
    } else { 

        header("Location: logout.php");
    } 
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FSCEvents</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <!--  CSS -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;700&display=swap" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->

    <link rel="icon" type="image/jpg" href="fsc-solo.svg">
</head>

<body>
    <div class="account_header">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" style="background-color:#006f71">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                     <?php if(isset($_SESSION['admin_data'])) { ?>
                        <a class="navbar-brand navbar-light" href="view_users.php">FSC<strong>ADMIN</strong></a>
                       <a class="navbar-brand navbar-light" style="text-transform: uppercase;"href="view_users.php">Promote An Account</a>
                        
                         <a class="navbar-brand navbar-light" style="text-transform: uppercase;"href="create_events.php">Create Events</a>
                         <?php } else { ?>   <a class="navbar-brand navbar-light" href="see_events.php">FSC<strong>EVENTS</strong></a> 
                         <?php } ?>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href=""></a></li>
                    </ul>

                   <ul class="nav navbar-nav navbar-right">

    <li><a href="my_account.php">My Account</a></li>
      <li><a href="see_events.php" >Dashboard</a></li>
     <li><a href="includes/logout.php">Sign out</a></li></ul> </div>
     </div>
    </nav>
    </div>
    </body>