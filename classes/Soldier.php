<?php

require "managment/dbConnection.php";

class Soldier {
    private $id;
    private $name;
    private $surname;
    private $username;

    public function __construct($id, $name, $surname, $username) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
    }

    public function getUserID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getUsername() {
        return $this->username;
    }



    public function getTraining() {
        $result = [];
        global $conn;
        $sql = "SELECT * FROM users_training WHERE id_user=" . $this->id;
        $dbresult = $conn->query($sql);
        if (mysqli_num_rows($dbresult) > 0) {
            while ($row = $dbresult->fetch_assoc()) {
                $result[] = $row["id_training"];
            }
        }
        return $result;
    }


    public function hasTraining($id) {
        $training = $this->getTraining();
        for ($i=0; $i<count($training); $i++) {
            if ($training[$i] == $id) {
                return true;
            }
        }
        return false;
    }


    public function getTrainingNames() {
        $result = [];
        global $conn;
        $sql = "SELECT name_training FROM training tr JOIN users_training ut ON (tr.id_training = ut.id_training) WHERE id_user=" . $this->id;
        $dbresult = $conn->query($sql);
        if (mysqli_num_rows($dbresult) > 0) {
            while ($row = $dbresult->fetch_assoc()) {
                $result[] = $row["name_training"];
            }
        }
        return $result;
    }

    /**
     * TOTO DOROBIT A AJ V DATABAZE
     */
    public function getGear() {
        $result = [];
        global $conn;
        $sql = "SELECT * FROM users_gear WHERE id_user=" . $this->id;
        $dbresult = $conn->query($sql);
        if (mysqli_num_rows($dbresult) > 0) {
            while ($row = $dbresult->fetch_assoc()) {
                $result[] = $row["id_gear"];
            }
        }
        return $result;
    }


    public function hasGear($id) {
        $gear = $this->getGear();
        for ($i=0; $i<count($gear); $i++) {
            if ($gear[$i] == $id) {
                return true;
            }
        }
        return false;
    }


    public function getGearNames() {
        $result = [];
        global $conn;
        $sql = "SELECT name_gear FROM gear gr JOIN users_gear ug ON (gr.id_gear = ug.id_gear) WHERE id_user=" . $this->id;
        $dbresult = $conn->query($sql);
        if (mysqli_num_rows($dbresult) > 0) {
            while ($row = $dbresult->fetch_assoc()) {
                $result[] = $row["name_gear"];
            }
        }
        return $result;
    }


}

?>
