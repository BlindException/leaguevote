<?php
require "../../Models/DB.php";
require "../../Models/User.php";
require "../../Models/Group.php";
require "../../Models/Rule.php";
require "../../Models/vote.php";
require "../../Models/Category.php";
require "../../Models/Option.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $count = 0;
        $userID = $_SESSION['user_id'];
        $db = new DB();
        $db->Connect();
        $group = new Group($db->conn);
        $group->readGroupbyID($_GET['q']);
        try {

                $group->getOpenRulesForGroup($_SESSION['user_id']);
                $count += count($group->Rules);
                foreach ($group->Rules as $rule) {
                        $rule->getVotes();
                        $id = $rule->ID;
                        $creator = $rule->Creator->username;
                        $group = $value->Name;
                        $category = $rule->Category->Name;
                        $title = $rule->Title;
                        $description = $rule->Description;
                        $options = $rule->Options;
                        $numOfVotes = count($rule->Votes);




                        echo "<div id = 'divForRule$id'><div class = 'row'>
<div class = 'col-7'>$title</div><div class = 'col-2'>Votes:$numOfVotes</div><div class = 'col-3'><button id = '$id' onclick = 'showVote(this.id)'>Vote</button></div>
</div>
<div class = 'row' id = 'rule$id' style = 'display:none;'>
<div class = 'col-7'>$description</div>";
                        foreach ($rule->Options as $option) {
                                echo "<div class = 'col-2'><button value = '$option->ID' onclick = 'castVote($id, $userID, this.value)'>I vote $option->Text!</button></div>";
                        }
                        echo "</div>
</div>";
                }

        } catch (Error $e) {
                echo ($e->getMessage());
        }
}

?>