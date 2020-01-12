<?php

require "dbConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "ADD-TRAINING") {
        if (isset($_POST["training-name"])) {
            $sql = "INSERT INTO training (name_training) VALUES( '" . $_POST["training-name"] . "')";
            $conn->query($sql);
        }
    } else if ($action == "DEL-TRAINING") {
        if (isset($_POST["training-id"])) {
            $sql = "DELETE FROM training WHERE id_training=" . $_POST["training-id"];
            $sql2 = "DELETE FROM users_training WHERE id_training= " . $_POST["training-id"];
            $conn->query($sql);
            $conn->query($sql2);
        }
    } else if ($action == "RENAME-TRAINING") {
        if (isset($_POST["training-id"]) && isset($_POST["training-name"])) {
            $sql = "UPDATE training SET name_training = '" . $_POST["training-name"] . "' WHERE id_training= " . $_POST["training-id"];
            $conn->query($sql);
        }
    } else if ($action == "DEL-USER") {
        if (isset($_POST["user-id"])) {
            $sql = "DELETE FROM users WHERE id = " . $_POST["user-id"];
            echo $sql;
            $conn->query($sql);
        }
        //preco to do pici nejde
    } else if ($action == "ADD-GEAR") {
        if (isset($_POST["gear-name"])) {
            $sql = "INSERT INTO gear (name_gear) VALUES( '" . $_POST["gear-name"] . "')";
            $conn->query($sql);
        }

    } else if ($action == "DEL-GEAR") {
        if (isset($_POST["gear-id"])) {
            $sql = "DELETE FROM gear WHERE id_gear=" . $_POST["gear-id"];
            $sql2 = "DELETE FROM users_gear WHERE id_gear= " . $_POST["gear-id"];
            $conn->query($sql);
            $conn->query($sql2);
        }
    } else if ($action == "RENAME-GEAR") {
        if (isset($_POST["gear-id"]) && isset($_POST["gear-name"])) {
            $sql = "UPDATE gear SET name_gear = '" . $_POST["gear-name"] . "' WHERE id_gear= " . $_POST["gear-id"];
            $conn->query($sql);
        }
    }


} else if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"])) {
    $action = $_GET["action"];
    if ($action == "GET-TRAINING-OPTION") {
        $sql = "SELECT * FROM training";
        $dbresult = $conn->query($sql);
        if (mysqli_num_rows($dbresult) > 0) {
            while ($row = $dbresult->fetch_assoc()) {
                echo "<option value=" . $row["id_training"] . ">" . $row["name_training"] . "</option>";
            }
        }
    } else if ($action == "GET-USER") {
        $sql = "SELECT * FROM users ORDER BY id";
        $dbresult = $conn->query($sql);
        if (mysqli_num_rows($dbresult) > 0) {
            while ($row = $dbresult->fetch_assoc()) {
                if ($row["username"] !== "admin") {
                    echo "<option value=" . $row["id"] . ">" . $row["username"] . "</option>";
                }
            }
        }
    } else if ($action == "GET-GEAR-OPTION") {
        $sql = "SELECT * FROM gear";
        $dbresult = $conn->query($sql);
        if (mysqli_num_rows($dbresult) > 0) {
            while ($row = $dbresult->fetch_assoc()) {
                echo "<option value=" . $row["id_gear"] . ">" . $row["name_gear"] . "</option>";
            }
        }
    }
}
