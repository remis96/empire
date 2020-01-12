<?php
include "managment/dbConnection.php";

$userid = $_POST['userid'];

$sql = "select * from users where id=" . $userid;
$result = mysqli_query($conn, $sql);

$response = "<table border='0' width='100%'>";
while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $name = $row['name'];
    $surname = $row['surname'];
    $username = $row['username'];


    $response .= "<tr>";
    $response .= "<td>Name : </td><td>" . $name . "</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Surname : </td><td>" . $surname . "</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Username : </td><td>" . $username . "</td>";
    $response .= "</tr>";


}
$response .= "</table>";

echo $response;
exit;