<?php

require "managment/dbConnection.php";

class Gear {
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function getGearName() {
        global $conn;
        $sql = "SELECT name_gear FROM gear WHERE id_gear=" . $this->id;
        $dbresult = $conn->query($sql);
        $row = $dbresult->fetch_assoc();
        return $row["name_gear"];
    }
}

?>