<?php
require "../../Models/DB.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["q"] != null) {
    $db = new DB();
    $db->Connect();
    try {
        $q = htmlspecialchars(strtolower("%{$_GET['q']}%"));
        $sql = "SELECT lastname FROM Users WHERE username LIKE ?";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([$q]);
        $result = $stmt->fetchAll();
        $count = count($result);
        echo (json_encode($count, true));
    } catch (PDOException $e) {
        echo "$e->getMessage()";
    }
}
?>