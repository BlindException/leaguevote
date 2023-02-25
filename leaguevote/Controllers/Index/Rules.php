<?php
session_start();
require "../../Models/DB.php";
require "../../Models/user.php";
require "../../Models/Group.php";
require "../../Models/Rule.php";
require "../../Models/Option.php";
require "../../Models/Category.php";
require "../../Models/member.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "create") {
    $creatorID = $_SESSION["user_id"];
    if (!isset($_POST["CreateDaysBeforeMajority"])) {
        $daysBeforeMajority = 7300;
    } else if (isset($_POST["CreateDaysBeforeMajority"])) {
        $daysBeforeMajority = htmlspecialchars($_POST["CreateDaysBeforeMajority"]);
    }
    $groupID = htmlspecialchars($_POST["CreateRuleGroupID"]);
    $categoryID = htmlspecialchars($_POST["CreateRuleCategoryID"]);
    $title = htmlspecialchars(ucwords($_POST["CreateRuleTitle"]));
    $description = htmlspecialchars(ucwords($_POST["CreateRuleDescription"]));
    $numOfOptions = htmlspecialchars($_POST["CreateNumOfOptions"]);
    $ruleOptions = $_POST["CreateRuleOptions"];
    $filteredRuleOptions = array();
    foreach ($ruleOptions as $ruleOption) {
        $filteredOption = htmlspecialchars($ruleOption);
        array_push($filteredRuleOptions, $filteredOption);
    }

    $db = new DB();
    $db->Connect();
    $rule = new Rule($db->conn);
    $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES T WHERE T.TABLE_SCHEMA = 'League_Vote' AND T.TABLE_NAME = 'Rules'";
    $stmt = $db->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    $nextID = $result["AUTO_INCREMENT"];
    $ruleID = $nextID;
    $rule->createNewRule($creatorID, $groupID, $categoryID, $title, $description, $daysBeforeMajority);
    for ($i = 0; $i < count($filteredRuleOptions); $i++) {
        $rule->createOptionForRule($filteredRuleOptions[$i], $ruleID);
    }
    header("Location:https://robertprockjr.com/leaguevote/views/index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "delete") {
    $ruleCBs = $_POST["Rules"];
    $db = new DB();
    $db->Connect();
    $rule = new Rule($db->conn);
    foreach ($ruleCBs as $value) {
        $rule->readRuleById($value);
        $rule->deleteRule();
    }
    header("Location:https://robertprockjr.com/leaguevote/views/index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "rules") {
    $groupID = $_POST["GroupID"];
    $db = new DB();
    $db->Connect();
    $user = new User($db->conn);
    $user->readUser($_SESSION["user_id"]);
    $user->getCreatedRules($groupID);
    $rules = array();
    for ($i = 0; $i < count($user->Rules); $i++) {
        $ruleID = $user->Rules[$i]->ID;
        $ruleTitle = $user->Rules[$i]->Title;

        $ruleRow = "<div class = 'row'><div class = 'col-2'><label for = 'rule" . $ruleID . "' class = 'form-check-label' >Select Rule</label><input type = 'checkbox' value = '" . $ruleID . "' id = 'rule" . $ruleID . "' class = 'form-check rule' name = 'Rules[]'></div><div class = 'col-10'><div class = 'row'><p>Title:</P><p>" . $ruleTitle . "</p></div></div></div></div>";
        array_push($rules, $ruleRow);
    }
    if (count($rules) === 0) {
        $ruleRow = "<div class = 'row'><p>No Rules to Delete, try creating one first.</p></div>";
        array_push($rules, $ruleRow);
    }
    $rules = json_encode($rules, true);
    print_r($rules);

}
?>