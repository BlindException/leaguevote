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

        foreach ($user->Groups as $group) {

            $group->Rules += $group->getClosedRulesForGroup();
            $count += count($group->Rules);

            foreach ($group->Rules as $rule) {

                if ($rule->Options == null) {
                    $rule->getOptions();
                }
                $rule->countVotes();
                $id = $rule->ID;
                $creator = $rule->Creator->Username;
                $group = $rule->Group->Name;
                $category = $rule->Category->Name;
                $title = $rule->Title;
                $description = $rule->Description;
                $options = $rule->Options;
                $voteCount = $rule->numOfVotes;
                if ($rule->Result->ID = 0) {
                    $rule->Result->Text = "No Winner";
                }
                $winner = $rule->Result->Text;
                $dateClosed = $rule->DateClosed;
                $winningVotes = $rule->Result->VotesReceived;
                echo "<div id = 'divForClosedRule$id' class =container mb-4 mt-2'><div class = 'row d-flex'>
<div>Group: $group</div><div>Rule Category: $category</div><div>Rule Title: $title</div><div>Rule Description: $description</div><div>Winner: $winner</div><div>Date Voting Closed: $dateClosed</div>
</div>
</div>";
            }

        }
    }
    if ($count <= 0) {
        echo "<div>No Results To Display</div>";
    }
} catch (Error $e) {
    echo ($e);
}
?>