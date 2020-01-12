<?php
$conn = mysqli_connect("localhost", "root", "", "empire");
if (!$conn) {
    die("Connection failed: " . $conn->error);
}