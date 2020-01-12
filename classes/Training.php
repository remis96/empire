<?php

require "managment/dbConnection.php";

class Training {
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function getTrainingName() {
        global $conn;
        $sql = "SELECT name_training FROM training WHERE id_training=" . $this->id;
        $dbresult = $conn->query($sql);
        $row = $dbresult->fetch_assoc();
        return $row["name_training"];
    }
}

?>