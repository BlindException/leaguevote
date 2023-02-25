<?php
class Message
{
    public $Sender;
    public $Recipients = array();
    public function __construct($sender, $recipients)
    {
        $this->Sender = $sender;
        $this->Recipients = $recipients;
    }

    public function sendInvite($groupID, $groupName)
    {
        $info = encryptURL($groupID);
        $url = "https://robertprockjr.com/leaguevote/index.php?q=" . $info;
        $message = "<html>
<head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous' />
    <title>You have been invited to join a group.</title>
        <link href='https://robertprockjr.com/leaguevote/CSS/SiteStyle.css' rel='stylesheet' />
</head>
<body>
<p>Greetings,</p><br/>

<p>You have been invited by " . $this->Sender->First . " " . $this->Sender->Last . " to join their voting group " . $groupName . " on LeagueVote, the new app that lets you settle league decisions fairly and without pressure or politics. To accept the invitation, click the link below and create your new account on LeagueVote or sign into an existing LeagueVote account to add this group to the list of groups you belong to and can vote with.</p><br/><br/>

<p><a href ='" . $url . "'>Accept Invitation</a></p><br/><br/>
</body>
</html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: noreply-admin@leaguevote.com" . "\r\n";
        $headers .= "Return-Path: noreply-admin@leaguevote.com" . "\r\n";
        $headers .= "Reply-To: noreply-admin@leaguevote.com" . "\r\n";
        $headers .= "Organization: LeagueVote.com" . "\r\n";
        $headers .= "X-Priority: 3" . "\r\n";
        $subject = 'New LeagueVote Invitation';

        foreach ($this->Recipients as $sendTo) {
            mail($sendTo, $subject, $message, $headers);
        }
    }
    public function sendUsername()
    {
        $url = "https://robertprockjr.com/leaguevote/views/login.php";
        $url1 = "https://robertprockjr.com/leaguevote/views/users/recoveraccount.html";
        $message = "<html>
<head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous' />
    <title>Account Recovery.</title>
        <link href='https://robertprockjr.com/leaguevote/CSS/SiteStyle.css' rel='stylesheet' />
</head>
<body>
<p>Greetings " . $this->Sender->First . ",</p><br/>

<p>Your LeagueVote username is " . $this->Sender->Username . "</p><br/><br/>

<p><a href ='" . $url . "'>Login</a></p><br/><br/>
<p>or</p>
<p><a href ='" . $url1 . "'>Need To Reset Your Password?</a></p><br/><br/>
</body>
</html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: noreply-admin@leaguevote.com" . "\r\n";
        $headers .= "Return-Path: noreply-admin@leaguevote.com" . "\r\n";
        $headers .= "Reply-To: noreply-admin@leaguevote.com" . "\r\n";
        $headers .= "Organization: LeagueVote.com" . "\r\n";
        $headers .= "X-Priority: 3" . "\r\n";
        $subject = 'LeagueVote Username Recovery';
        foreach ($this->Recipients as $sendTo) {
            mail($sendTo, $subject, $message, $headers);
        }
    }

    public function resetPassword()
    {
        $info = encryptPasswordURL($this->Sender->ID);
        $url = "https://robertprockjr.com/leaguevote/controllers/index/recover.php?q=" . $info;

        $message = "<html>
<head></head>
<body>
<p>Greetings " . $this->Sender->First . ",</p><br/>

<p>To reset your LeagueVote password, click the link below</p><br/><br/>

<p><a href ='" . $url . "'>Change My Password</a></p><br/><br/>
</body>
</html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: noreply@robertprockjr.com" . "\r\n";
        $headers .= "Return-Path: noreply@robertprockjr.com" . "\r\n";
        $headers .= "Reply-To: noreply@robertprockjr.com" . "\r\n";
        $headers .= "Organization: LeagueVote.com" . "\r\n";
        $headers .= "X-Priority: 3" . "\r\n";
        $subject = 'Change LeagueVote Password';
        foreach ($this->Recipients as $sendTo) {
            mail($sendTo, $subject, $message, $headers);
        }
    }
}
?>