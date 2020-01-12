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
$userGear = $user->getGear();
?>
<form action="get_gear.php" method="post">
    <div class="table-wrap">

        <table class="table">
            <thead>
            <tr>
                <th>Name of training</th>
                <th class="th-volba">Choose</th>
            </tr>
            </thead>

            <tbody id="myTable">
            <?php
            $sql = "SELECT * FROM gear";
            $dbresult = $conn->query($sql);
            if (mysqli_num_rows($dbresult) > 0) {
                while ($row = $dbresult->fetch_assoc()) {
                    if (!$user->hasGear($row["id_gear"])) {
                        echo "<tr>";
                        echo "<td>" . $row["name_gear"] . "</td>";
                        echo "<td> <input type='checkbox' name=subjects[]" . " value=" . $row["id_gear"] . "></td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary btn-block usr-submit-btn hidden" name="submit-subjects">Get gear <span class="badge chb-num"></span></button>
    </div>
</form>
<?php
$gears = [];
if (isset($_POST["submit-subjects"])) {
    $gears = $_POST["subjects"];
    for ($i = 0; $i < count($gears); $i++) {
        $userID = $_SESSION["userID"];
        $gearID = (int)$gears[$i];

        $sql = "INSERT INTO users_gear (id_user, id_gear) VALUES ('$userID', '$gearID')";
        $conn->query($sql);
    }
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<?php
require "footer.php";
?>
