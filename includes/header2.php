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

    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

    <!-- <link href="css/custom.css" rel="stylesheet"> -->

    <!--  Google font -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;700&display=swap" rel="stylesheet">

    <!--  CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->

    <link rel="icon" type="image/jpg" href="fsc-solo.svg">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
   <div class="header_two">
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" style="background-color:#006f71">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" style="background-color:#006f71" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-light" href="index.php">FSC<strong>EVENTS</strong></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
    </body>