<?php
session_start();
if (isset($_SESSION) == true) {
    session_destroy();

}
header("Location: https://robertprockjr.com/leaguevote/views/login.php");

?>