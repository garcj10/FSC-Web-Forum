<?php 
// Call ob_start and session_start functions
    ob_start();
    session_start();

if(isset($_SESSION['user_is_logged_in'])){
    
                        header("Location: ../my_account.php");
    
                } else 
?>
    <html>
    <head>
       
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="js/jquery.js"></script>
        <script src="js/scripts.js"></script>
        
       <!-- <link href="css/custom.css" rel="stylesheet"> -->

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

     <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->

   <link rel="icon" type="image/jpg" href="fsc-solo.svg">
    </head>
    <!-- Change Webpage Background-Color -->
    <body style="background-color:#f8f9fa; padding-top: 80px;">           
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">

        <div class="container-fluid" style="background-color:#006f71">

            <div class="navbar-header">
                <button type="button" style="background-color:#006f71"class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-light" href="index.php" style="color: #f3f3f3">FSC<strong>EVENTS</strong></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
               
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="index.php" style="color: #f3f3f3">Login</a></li>
                      <li><a href="register_account.php" style="color: #f3f3f3">Register</a></li>
            </ul> 
            </div>
        </div>
    </nav>