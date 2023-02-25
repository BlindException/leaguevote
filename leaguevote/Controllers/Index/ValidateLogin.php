<?php
try {
  require "../../Models/DB.php";
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = htmlspecialchars(strtolower($_GET["Username"]));
    $password = htmlspecialchars($_GET["Password"]);
    $db = new DB();
    $db->Connect();
    $sql = "SELECT password FROM Users WHERE username = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([$username]);
    $result = $stmt->fetch();
    $verify = password_verify($password, $result);
    echo (json_encode($verify, true));
  } else {
    echo "Not post request";
  }

} catch (Error $e) {
  echo (json_encode($e->getMessage(), true));
}
?>