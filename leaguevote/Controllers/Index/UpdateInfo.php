<?php
try {
    require "../../Models/DB.php";
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "edit") {
        $fName = htmlspecialchars(ucfirst($_POST['EditFirstName']));
        $lName = htmlspecialchars(ucfirst($_POST['EditLastName']));
        $email = htmlspecialchars(strtolower($_POST['EditEmail']));
        $userID = $_SESSION['user_id'];
        $db = new DB();
        $db->Connect();
        $sql = "UPDATE Users SET firstname = ?, lastname = ?, email = ? WHERE id = ?";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([$fName, $lName, $email, $userID]);
        header("Location:https://robertprockjr.com/leaguevote/Views/Index.php");
    }
} catch (PDOException $e) {
    echo ($e->getMessage());
}
?>