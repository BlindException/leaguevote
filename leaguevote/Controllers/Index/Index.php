<?php
session_start();
try {
    require "../Models/DB.php";
    require "../Models/User.php";


    //    if($_SESSION['user_id']==null){
    //header("Location:https://robertprockjr.com/leaguevote/Views/Login.html");
    //}else
    //    {
    $db = new DB();
    $db->Connect();
    $user = new User($db->conn);
    $user->readUser($_SESSION['user_id']);
} catch (PDOException $e) {
    echo ($e->getMessage());
}
//}
?>