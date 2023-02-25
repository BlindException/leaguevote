<?php
try {
    require "../../Models/DB.php";
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "reset") {
        $gResponse = htmlspecialchars($_POST["GResponse"]);
        $recaptcha_secret = "6LedXNEdAAAAAG5JZDEWgjCtsOh_xXBBA36GnIys";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $gResponse);
        $response = json_decode($response, true);

        if ($response["success"] != true) {
            header("Location:https://robertprockjr.com/leaguevote/views/users/robot.html");
        } else if ($response["success"] == true) {
            $password = htmlspecialchars($_POST['EditUserPassword']);
            $userID = $_SESSION['user_id'];
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $db = new DB();
            $db->Connect();
            $sql = "UPDATE Users SET password = ? WHERE id = ?";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute([$hash, $userID]);
            header("Location:https://robertprockjr.com/leaguevote/Views/Index.php");
            exit();
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "resetInApp") {
        $password = htmlspecialchars($_POST['EditUserPassword']);
        $userID = $_SESSION['user_id'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $db = new DB();
        $db->Connect();
        $sql = "UPDATE Users SET password = ? WHERE id = ?";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([$hash, $userID]);
        header("Location:https://robertprockjr.com/leaguevote/Views/Index.php");
        exit();
    }
} catch (Error $e) {
    echo ($e->getMessage());
}
?>