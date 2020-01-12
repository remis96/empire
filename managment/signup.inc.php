<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password-repeat"])) {

        require "dbConnection.php";

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["password-repeat"];

        if (empty($name) || empty($surname) || empty($username) || empty($password) || empty($passwordRepeat)) {
            echo "<div class=\"alert alert-danger\">You need to fill all fields</div>";
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            echo "<div class=\"alert alert-danger\">Username has illegal characters</div>";
        } else if ($password != $passwordRepeat) {
            echo "<div class=\"alert alert-danger\">Your passwords don't match</div>";
        } else {
            $sql = "SELECT username FROM users WHERE username=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "<div class=\"alert alert-danger\"> SQL Err</div>";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    echo "<div class=\"alert alert-danger\">There is already accout with that login</div>";
                } else {
                    $sql = "INSERT INTO users (name, surname, username, password) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "<div class=\"alert alert-danger\">SQL Err</div>";
                    } else {
                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $username, $hashedPwd);
                        mysqli_stmt_execute($stmt);
                        echo "<div class=\"alert alert-success\">Welcome <strong>" . $username . "</strong> You joined the Empire!</div>";
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
}

?>