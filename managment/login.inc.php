<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {

        require "dbConnection.php";

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (empty($username) || empty($password)) {
            echo "<div class=\"alert alert-danger\">Fill all the credentials</div>";
        } else {
            $sql = "SELECT * FROM users WHERE username=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "<div class=\"alert alert-danger\">Error</div>";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $pwdcheck = password_verify($password, $row["password"]);
                    if ($pwdcheck == false) {
                        echo "<div class=\"alert alert-danger\">Bad password</div>";
                    } else if ($pwdcheck == true) {
                        session_start();
                        $_SESSION["userID"] = $row["id"];
                        $_SESSION["username"] = $row["username"];

                        echo "success";
                    } else {
                        echo "<div class=\"alert alert-danger\">Bad password</div>";
                    }
                } else {
                    echo "<div class=\"alert alert-danger\">Username already taken</div>";
                }
            }
        }
    } else {
        echo "nosuccess";
    }
}
