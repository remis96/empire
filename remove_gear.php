<?php
require "header.php";
require "managment/dbConnection.php";
include "classes/Soldier.php";
include "classes/Training.php";
include "classes/Gear.php";

if (!isset($_SESSION["userID"])) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM users WHERE id=" . $_SESSION["userID"];
$dbresult = $conn->query($sql);
$row = $dbresult->fetch_assoc();

$user = new Soldier($_SESSION["userID"], $row["name"], $row["surname"], $row["username"]);

?>
<form action="remove_gear.php" method="post">
    <div class="table-wrap">

        <table class="table">
            <?php
            $studentSubjects = $user->getGear();
            if (count($studentSubjects) > 0) {
            ?>
            <thead>
            <tr>
                <th>Name of gear</th>
                <th class="th-volba">Choose</th>
            </tr>
            </thead>
            <tbody id="myTable">
            <?php
            for ($i = 0; $i < count($studentSubjects); $i++) {
                $subj = new Gear($studentSubjects[$i]);
                echo "<tr>";
                echo "<td>" . $subj->getGearName() . "</td>";
                echo "<td> <input type='checkbox' onclick='checkboxes()' name=subjects[]" . " value=" . $studentSubjects[$i] . "></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary btn-block usr-submit-btn hidden" name="submit-subjects-canceled">
            Remove gear <span class="badge chb-num"></span></button>
        <?php
        } else {
            ?>
            <div class="alert alert-warning">
                <strong>Alert</strong> You are not enroller in any course
            </div>
            <?php
        }
        ?>
    </div>
</form>
<?php
$subjects = [];
if (isset($_POST["submit-subjects-canceled"])) {
    $subjects = $_POST["subjects"];
    for ($i = 0; $i < count($subjects); $i++) {
        $userID = $_SESSION["userID"];
        $subjectID = (int)$subjects[$i];

        $sql = "DELETE FROM users_gear WHERE id_gear=" . $subjectID . " AND id_user=" . $userID;
        $conn->query($sql);
    }
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<?php
require "footer.php";
?>
