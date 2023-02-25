<?php
session_start();
try {
    require "../../Models/DB.php";
    require "../../Models/User.php";
    require "../../Models/Message.php";
    require "../../enc_config.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Forgot"]) == true) {
        $gResponse = htmlspecialchars($_POST["GResponse"]);
        $recaptcha_secret = "6LedXNEdAAAAAG5JZDEWgjCtsOh_xXBBA36GnIys";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $gResponse);
        $response = json_decode($response, true);

        if ($response["success"] != true) {
            header("Location:https://robertprockjr.com/leaguevote/views/users/robot.html");
        } else if ($response["success"] == true) {
            $email = htmlspecialchars(strtolower($_POST["Email"]));
            $forgot = htmlspecialchars(strtolower($_POST["Forgot"]));
            $db = new DB();
            $db->Connect();
            $sql = "SELECT id FROM Users WHERE email = ?";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();
            $user = new User($db->conn);
            $user->readUser($result["id"]);
            $recipient = [$email];

            $message = new Message($user, $recipient);

            if ($forgot == "username") {
                $message->sendUsername();
            }
            if ($forgot == "password") {
                $message->resetPassword();
            }
            header("Location:https://robertprockjr.com/leaguevote/views/login.php");
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["q"]) == true) {
        $info = decryptPasswordURL(htmlspecialchars($_GET["q"]));
        $_SESSION["user_id"] = $info[0];
        header("Location:https://robertprockjr.com/leaguevote/views/users/forgotpassword.html");
    }

} catch (PDOException $e) {
    echo ($e->getMessage());
}
?>