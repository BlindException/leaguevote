<?php
session_start();
require "../../Models/DB.php";
require "../../Enc_Config.php";
require "../../Models/User.php";
require "../../Models/Member.php";
require "../../Models/Group.php";
require "../../Models/invitation.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["Username"]);
    $password = htmlspecialchars($_POST["Password"]);
    $db = new DB();
    $db->Connect();
    $sql = "SELECT id, password FROM Users WHERE username = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([$username]);
    $result = $stmt->fetch();
    $dbPassword = $result["password"];
    $verify = password_verify($password, $dbPassword);
    if ($verify == true) {
        $_SESSION["user_id"] = $result['id'];

        if (isset($_SESSION["groupToken"]) && $_SESSION["token"] == "valid") {
            $groupID = $_SESSION["groupToken"];
            $member = new Member($db->conn);
            $member->readUser($_SESSION["user_id"]);
            $group = new Group($db->conn);
            $group->readGroupByID($groupID);
            $group->checkIfFull();
            if ($group->IsFull != true) {
                $member->createMember($groupID);
                $invite = new Invitation($db->conn);
                $invite->deleteInvitationByEmail($group->ID, $member->Email);
            }
        }


        $login = "valid";
        $login = json_encode($login, true);
        echo ($login);

    } else {
        $login = "invalid";
        $login = json_encode($login, true);
        echo ($login);
    }


}

?>