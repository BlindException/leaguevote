<?php
try {
    require "../../Models/DB.php";
    require "../../Models/User.php";
    require "../../Models/Group.php";
    require "../../Models/Member.php";
    require "../../Models/Rule.php";
    require "../../Models/Vote.php";
    require "../../Models/Category.php";
    require "../../Models/Option.php";
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $db = new DB();
        $db->Connect();
        $user = new User($db->conn);

        $count = 0;
        $user->readUser($_SESSION['user_id']);
        $user->getGroups();
        foreach ($user->Groups as $value) {
            $value->getOpenRulesForGroup($user->ID);
            $count += count($value->Rules);


            foreach ($value->Rules as $rule) {
                $rule->countVotes();
                $id = $rule->ID;
                $creator = $rule->Creator->Username;
                $group = $value->Name;
                $category = $rule->Category->Name;
                $title = $rule->Title;
                $description = $rule->Description;
                $options = $rule->Options;
                $voteCount = $rule->numOfVotes;
                $str = "P" . $rule->daysBeforeMajority . "D";
                $majDI = new DateInterval($str);
                $dateForMajority = new DateTime($rule->DateCreated, new DateTimeZone("America/New_York"));
                $dateForMajority->add($majDI);
                $dateForMajority->setTimezone(new DateTimeZone("America/New_York"));
                $today = new DateTime(`"Now"`, new DateTimeZone("America/New_York"));
                $daysLeft = $dateForMajority->diff($today);
                $majorityMessage = "";
                if ($today > $dateForMajority) {
                    $majorityMessage = "Majority rules are in effect. Once a mathematical majority have voted, voting will close";
                } else if ($dateForMajority > $today) {
                    if ($daysLeft->y > 5) {
                        $majorityMessage = "No Majority Rules. Voting will not close until all members have cast a vote";
                    } else if ($daysLeft->y >= 1 || $daysLeft->m >= 1) {
                        $majorityMessage = "There are more than 30 days before majority rules go into effect.";
                    } else if ($daysLeft->d >= 1 && $daysLeft->d <= 30) {
                        $majorityMessage = "There are less than " . ($daysLeft->d + 1) . " day(s) before majority rules go into effect.";
                    } else if ($daysLeft->y < 1 && $daysLeft->m < 1 && $daysLeft->d < 1) {
                        $majorityMessage = "You have less than 1 day before majority rules go into effect. There were less than " . $daysLeft->h . " hours and " . $daysLeft->i . " minutes left on last refresh.";
                    }
                }
                echo "<div id = 'divForRule$id' class = 'container mx-auto mb-4 mt-2'><div class = 'row d-flex'>
<div>Group: $group</div><div>Rule Category: $category</div><div>Rule Title: $title</div><div>Number of Votes: $voteCount  </div><div><button id = 'optionBTN$id' onclick = 'showVote($id)' class = 'btn btn-sm btn-success'>Vote</button></div>
</div>
<div class ='row'><div>$majorityMessage</div></div>
<div  id = 'rule$id' style = 'display:none;'><div class = 'row d-flex'>
<div>Rule Description: $description</div></div><div class = 'row d-flex'>";
                foreach ($rule->Options as $option) {
                    echo "<div><button value = '$option->ID' onclick = 'castVote($id, $user->ID, this.value)' class = btn btn-sm btn-success'>I vote $option->Text!</button></div>";
                }
                echo "</div>
</div>";
            }

        }
        if ($count <= 0) {
            echo "<div>No Rules To Display</div>";
        }
    }
} catch (Error $e) {
    echo ($e);
}
?>