<?php
require "../../Models/DB.php";
require "../../Models/Rule.php";
require "../../Models/User.php";
require "../../Models/Group.php";
require "../../Models/Category.php";
require "../../Models/Member.php";
require "../../Models/Vote.php";
require "../../Models/Option.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $ruleID = $_GET["rule"];
    $userID = $_SESSION["user_id"];
    $voteValue = $_GET["vote"];
    $db = new DB();
    $db->Connect();
    try {

        $rule = new Rule($db->conn);
        $rule->readRuleById($ruleID);
        if ($rule->IsClosed != true) {
            $vote = new Vote($db->conn);
            $vote->createVote($ruleID, $userID, $voteValue);
            $rule = new Rule($db->conn);
            $rule->readRuleById($ruleID);
            $rule->closeVoting();
        }

    } catch (Error $e) {
        echo ($e->getMessage());
    }
}
?>