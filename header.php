<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php
        $page_name = basename($_SERVER['SCRIPT_NAME'], '.php');
        switch ($page_name) {
            case "index":
                echo "Empire - Homepage";
                break;
            case "enroll_training" :
                echo "Enroll in training";
                break;
            case "roll_out" :
                echo "Chicken out";
                break;
            case "registration" :
                echo "Register";
                break;
            case "login" :
                echo "Login";
                break;
            case "profile" :
                echo "Soldier profile";
                break;
            case "soldiers" :
                echo "Lost souls";
                break;
            case "get_gear" :
                echo "Get swag";
                break;
            case "remove_gear" :
                echo "Remove gear";
                break;
            default:
                echo "Empire";
        }
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="js/js.js"></script>


</head>

<body>


<header>

    <nav class="navbar navbar-inverse">


        <div class="container-fluid">

            <div class="navbar-header">

                <?php
                if (isset($_SESSION["userID"])) {
                    ?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php
                }
                ?>
                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
                <?php
                if (!isset($_SESSION["userID"])) {
                    ?>

                    <a class="navbar-brand" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                    <a class="navbar-brand" href="registration.php"><span
                                class="glyphicon glyphicon-registration-mark"></span> Register</a>

                    <?php
                } else {
                    ?>
                    <a class="navbar-brand" href="soldiers.php"><span></span>View your comrades</a>
                    <?php
                }
                ?>
            </div>


            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION["userID"])) {
                    if ($_SESSION["username"] == "admin") {
                        ?>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin functions<span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="removeUsers.php"><span class="glyphicon glyphicon-lock"></span> <b>Execute
                                            soldiers</b></a></li>
                                <li><a href="rud_training.php"><span class="glyphicon glyphicon-lock"></span>
                                        <b>Manage training courses</b></a></li>
                                <li><a href="rud_gear.php"><span class="glyphicon glyphicon-lock"></span> <b>Manage
                                            gear</b></a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION["username"]; ?>
                            <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> <b>Profile</b></a>
                            </li>
                            <li><a href="managment/logout.inc.php"><span class="glyphicon glyphicon-log-out"></span>
                                    <b>Logout</b></a></li>
                            <?php
                            if (isset($_SESSION["userID"]) && $_SESSION["userID"] != "1") {
                                ?>
                                <li><a href="enroll_training.php"><span class="glyphicon glyphicon-plus"></span>
                                        <b>Roll in</b></a></li>
                                <li><a href="roll_out.php"><span class="glyphicon glyphicon-minus"></span>
                                        <b>Roll out</b></a></li>
                                <li><a href="get_gear.php"><span class="glyphicon glyphicon-plus"></span>
                                        <b>Get gear</b></a></li>
                                <li><a href="remove_gear.php"><span class="glyphicon glyphicon-minus"></span>
                                        <b>Remove gear</b></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>

</header>
<div id="particles-js">
    <script src="js/particles.js"></script>
    <script src="js/app.js"></script>
</div>