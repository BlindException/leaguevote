<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["g-recaptcha-response"]) {
    $recaptcha_secret = "6LedXNEdAAAAAG5JZDEWgjCtsOh_xXBBA36GnIys";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $_POST['g-recaptcha-response']);
    $response = json_decode($response, true);

}
?>