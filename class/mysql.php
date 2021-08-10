<?php
class mysql {
    private $mysqli;
   
    function __construct($user, $password, $table) {
        $this->mysqli = new mysqli("localhost", $user, $password, $table);
    }
    function tst() {
        echo $this->mysqli->host_info . "\n";
    }
    function getOneQuery($query, $parmsType = '', $parms=[]) {
        $stmt = $this->executeQuery($query, $parmsType, $parms);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    function getAllQuery($query, $parmsType = '', $parms=[]) {
        $stmt = $this->executeQuery($query, $parmsType, $parms);
        $result = $stmt->get_result();
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    function executeQuery($query, $parmsType = '', $parms=[]) {
        $stmt = $this->mysqli->prepare($query);
        if ($parmsType != '') {
            $stmt->bind_param($parmsType, ...$parms);
        }
        $stmt->execute();
        return $stmt;
    }
}