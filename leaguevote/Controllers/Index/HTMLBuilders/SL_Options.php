<?php
session_start();
try {
    //var_dump($_SESSION);
    require "../../../Models/DB.php";
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["Table"] == "createdGroups") {
        require "../../../Models/user.php";
        require "../../../Models/group.php";
        $db = new DB();
        $db->Connect();
        $user = new User($db->conn);
        $user->readUser($_SESSION["user_id"]);
        $user->getCreatedGroups();
        $createdGroupOptions = array();
        $default = "<option value = '' selected>Select a Group</option>";
        array_push($createdGroupOptions, $default);
        for ($i = 0; $i < count($user->Groups); $i++) {
            $groupID = $user->Groups[$i]->ID;
            $groupName = $user->Groups[$i]->Name;
            $createdGroupOption = "<option value ='" . $groupID . "'>" . $groupName . "</option>";
            array_push($createdGroupOptions, $createdGroupOption);
        }

        $createdGroupOptions = json_encode($createdGroupOptions, true);
        print_r($createdGroupOptions);
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["Table"] === "Categories") {
        require "../../../Models/Category.php";
        $db = new DB();
        $db->Connect();
        $category = new Category($db->conn);
        $categories = $category->readAllCategories();
        $default = "<option value = '' selected >Select a Rule Category</option>";
        $categoryOptions = array();

        array_push($categoryOptions, $default);
        for ($i = 0; $i < count($categories); $i++) {
            $categoryOption = "<option value ='" . $categories[$i]->ID . "'>" . $categories[$i]->Name . "</option>";
            array_push($categoryOptions, $categoryOption);
        }
        $categoryOptions = json_encode($categoryOptions, true);
        print_r($categoryOptions);
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["Table"] == "Groups") {

        require "../../../Models/User.php";
        require "../../../Models/Group.php";
        require "../../../Models/member.php";
        $db = new DB();
        $db->Connect();
        $user = new User($db->conn);
        $user->readUser($_SESSION["user_id"]);
        $user->getGroups();
        $groups = $user->Groups;
        $groupOptions = array();
        $default = "<option value = '' selected>Select a Group</option>";
        array_push($groupOptions, $default);
        for ($i = 0; $i < count($groups); $i++) {
            $groupID = $groups[$i]->ID;
            $groupName = $groups[$i]->Name;
            $groupOption = "<option value ='" . $groupID . "'>" . $groupName . "</option>";
            array_push($groupOptions, $groupOption);
        }
        $groupOptions = json_encode($groupOptions, true);
        print_r($groupOptions);


    }
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["Table"] == "CreatedRules") {
        require "../../../Models/User.php";
        require "../../../Models/Group.php";
        require "../../../Models/Rule.php";
        require "../../../Models/Option.php";
        require "../../../Models/member.php";
        require "../../../Models/category.php";

        $groupID = $_GET["GroupID"];
        $db = new DB();
        $db->Connect();
        $user = new User($db->conn);
        $user->readUser($_SESSION["user_id"]);
        $user->getCreatedRules($groupID);
        $createdRuleOptions = array();
        $default = "<option value = '' selected>Select a rule</option>";
        array_push($createdRuleOptions, $default);
        for ($i = 0; $i < count($user->Rules); $i++) {
            $ruleID = $user->Rules[$i]->ID;
            $ruleTitle = $user->Rules[$i]->Title;
            $createdRuleOption = "<option value ='" . $ruleID . "'>" . $ruleTitle . "</option>";
            array_push($createdRuleOptions, $createdRuleOption);
        }
        $createdRuleOptions = json_encode($createdRuleOptions, true);
        print_r($createdRuleOptions);
    }
} catch (Error $e) {
    echo ($e->getMessage());
}
?>