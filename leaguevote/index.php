<?php
session_start();
try {
    require "Models/DB.php";
    require "Models/Category.php";
    require "Models/Group.php";
    require "Models/User.php";
    require "Models/Member.php";
    require "Models/Rule.php";
    require "Models/Vote.php";
    require "Models/Option.php";
    require "Models/Message.php";
    require "Models/Invitation.php";
    require "Enc_Config.php";
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["q"] != null && $_GET["q"] != '') {
        $joinToken = decryptURL($_GET["q"]);
        $_SESSION["groupToken"] = $joinToken[0];
        $_SESSION["token"] = $joinToken[1];
    }

    header("Location:https://robertprockjr.com/leaguevote/Views/welcome.php");

} catch (Error $e) {
    echo ($e->getMessage());
}
?>