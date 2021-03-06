<?php
session_start();
require_once "functions.php";
preventXSS($_POST);
unsetAdmin();
print_r($_SESSION);

if(isset($_POST["disconnect"]) && $_POST["disconnect"] == "disconnect"){
    session_unset();
    session_destroy();
    header("Location: index.php");
}
unset($_POST["disconnect"]);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ParisNow</title>
	<meta name="description" content="ceci est ma premiere page WEB">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>

    <script src="js/jquery-3.2.1.min.js"></script>

</head>
<body>
	<div class="container-fluid">
        <header>
            <div id="logo">
                <a class="nav-link" href="index.php"><img src="img/logo.png" alt="logo paris now"></a>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto ml-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="user.php">Page perso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userTicket.php">Mes Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Art&Culture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">ParisByNight</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Nature&Bien-être</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Forum</a>
                </li>

                <?php
                if(!empty($_SESSION["token"])) {
                    $result = getInfo("*");
                    if ($result["member_status"] == 2 or $result["member_status"] == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="bOffice - Users.php">Admin</a>
                    </li>
                    <?php
                }
            }
            if(empty($_SESSION["token"])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">S'inscrire/Se connecter</a>
                </li>
                <?php }

                else{
                   ?>
                   <li class="nav-item">
                    <form method="POST">
                        <button action="submit" class="btn" name="disconnect" value="disconnect">Se déconnecter</button>
                    </form>
                </li>
                <?php } ?>
            </ul>

        </div>
    </nav>



