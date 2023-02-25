<?php
session_start();
require "../../Models/DB.php";
require "../../Models/User.php";
require "../../Models/Group.php";
require "../../Models/Member.php";
require "../../Models/Invitation.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["q"] != null) {
    $db = new DB();
    $db->Connect();
    $q = strtolower($_GET["q"]);
    $stmt = $db->conn->prepare("SELECT `id` FROM `Users` WHERE `email` = ?");
    $stmt->execute([$q]);
    $result = $stmt->fetchAll();
    echo (json_encode(count($result)));
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["u"] != null) {
    $db = new DB();
    $db->Connect();
    $u = strtolower($_GET["u"]);
    $stmt = $db->conn->prepare("SELECT `id` FROM `Users` WHERE `username` = ?");
    $stmt->execute([$u]);
    $result = $stmt->fetchAll();
    echo (json_encode(count($result)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gResponse = htmlspecialchars($_POST["GResponse"]);
    $recaptcha_secret = "6LedXNEdAAAAAG5JZDEWgjCtsOh_xXBBA36GnIys";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $gResponse);
    $response = json_decode($response, true);




    if ($response["success"] == true) {
        $firstName = htmlspecialchars(ucfirst($_POST["FirstName"]));
        $lastName = htmlspecialchars(ucfirst($_POST["LastName"]));
        $email = htmlspecialchars(strtolower($_POST["Email"]));
        $username = htmlspecialchars(strtolower($_POST["Username"]));
        $password = htmlspecialchars($_POST["Password"]);


        $db = new DB();
        $db->Connect();
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES T WHERE T.TABLE_SCHEMA = 'League_Vote' AND T.TABLE_NAME = 'Users'";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $nextID = $result["AUTO_INCREMENT"];
        $userID = $nextID;
        $_SESSION['user_id'] = $userID;
        $user = new User($db->conn);
        $user->createUser($firstName, $lastName, $email, $username, $password);
        if (isset($_SESSION["groupToken"]) && $_SESSION["token"] == "valid") {
            require "../../Enc_Config.php";

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
        header("Location:https://robertprockjr.com/leaguevote/Views/Index.php");
    } else {
        header("Location:https://robertprockjr.com/leaguevote/views/users/robot.html");
    }
}
?>