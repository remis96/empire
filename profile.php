<?php
require "header.php";
require "managment/dbConnection.php";
include "classes/Soldier.php";

if (!isset($_SESSION["userID"])) {
    header("Location: index.php");
    exit();
}


$sql = "SELECT * FROM users WHERE id=" . $_SESSION["userID"];
$dbresult = $conn->query($sql);
$row = $dbresult->fetch_assoc();

$user = new Soldier($_SESSION["userID"], $row["name"], $row["surname"], $row["username"]);
?>

<div class="table-wrap" style="max-width: 380px;">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card"
             src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Emblem_of_the_First_Galactic_Empire.svg/600px-Emblem_of_the_First_Galactic_Empire.svg.png"
             alt="img"/>
        <div>
            <h2 class="center-align">Profile</h2>
        </div>
        <div class="table-wrap">
            <table class="table profile-table">
                <?php


                echo "<tr>";
                echo "<td>" . $user->getName() . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>" . $user->getSurname() . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>" . $user->getUsername() . "</td>";
                echo "</tr>";


                ?>
            </table>
        </div>
    </div>
    <?php
    if (isset($_SESSION["userID"]) && $_SESSION["userID"] != "1") {
    ?>
    <div class="training-courses">
        <h2>Training courses</h2>
        <table class="table profile-table">
            <?php
            $training = $user->getTrainingNames();
            $err = "You are not currently enrolled in any training";

            if (count($training) > 0) {

                for ($i = 0; $i < count($training); $i++) {
                    echo "<tr>";
                    echo "<td>" . $training[$i] . "</td>";
                    echo "</tr>";

                }
            } else {

                echo "<tr>";
                echo "<td>" . $err . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="training-courses">
        <h2>Gear</h2>
        <table class="table profile-table">
            <?php
            $training = $user->getGearNames();
            $err = "You don't own any gear";
            if (count($training) > 0) {
                for ($i = 0; $i < count($training); $i++) {
                    echo "<tr>";
                    echo "<td>" . $training[$i] . "</td>";
                    echo "</tr>";
                }
            } else {

                echo "<tr>";
                echo "<td>" . $err . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
        <?php
    }
    ?>
</div>


<?php
require "footer.php";
?>


