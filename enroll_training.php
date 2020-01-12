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
$userTraining = $user->getTraining();
?>
<form action="enroll_training.php" method="post">
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
            $sql = "SELECT * FROM training";
            $dbresult = $conn->query($sql);
            if (mysqli_num_rows($dbresult) > 0) {
                while ($row = $dbresult->fetch_assoc()) {
                    if (!$user->hasTraining($row["id_training"])) {
                        echo "<tr>";
                        echo "<td>" . $row["name_training"] . "</td>";
                        echo "<td> <input type='checkbox' name=training[]" . " value=" . $row["id_training"] . "></td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary btn-block usr-submit-btn hidden" name="submit-training">Enroll in
            selected trainings <span class="badge chb-num"></span></button>
    </div>
</form>
<?php
$trainings = [];
if (isset($_POST["submit-training"])) {
    $trainings = $_POST["training"];
    for ($i = 0; $i < count($trainings); $i++) {
        $userID = $_SESSION["userID"];
        $trainingID = (int)$trainings[$i];

        $sql = "INSERT INTO users_training (id_user, id_training) VALUES ('$userID', '$trainingID')";
        $conn->query($sql);
    }
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<?php
require "footer.php";
?>
