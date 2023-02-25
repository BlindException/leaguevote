<?php
session_start();
require "../../Models/DB.php";
require "../../Models/User.php";
require "../../Models/Group.php";
require "../../Models/Member.php";
require "../../Models/Invitation.php";
require "../../Models/Message.php";
require "../../Enc_Config.php";
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "count") {
        $groupID = htmlspecialchars($_POST["GroupID"]);

        $db = new DB();
        $db->Connect();
        $group = new Group($db->conn);
        $group->readGroupByID($groupID);
        if ($group->Members == null) {
            $group->getMembersOfGroup();
        }
        if ($group->Invitations == null) {
            $group->getInvitationsForGroup();
        }

        $max = $group->MaxTeams;
        $memCount = count($group->Members);
        $inviteCount = count($group->Invitations);
        $combined = $memCount + $inviteCount;
        $count = $max - $combined;
        $count = json_encode($count, true);
        echo ($count);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "invites") {
        $groupID = htmlspecialchars($_POST["GroupID"]);

        $db = new DB();
        $db->Connect();
        $group = new Group($db->conn);
        $group->readGroupByID($groupID);
        $group->getInvitationsForGroup();
        $invites = array();
        foreach ($group->Invitations as $invite) {
            $id = $invite->ID;
            $email = $invite->Email;
            $inviteRow = "<div class = 'row'><div class = 'col-2'><label for = 'invite" . $id . "' class = 'form-check-label'>Select Invitation</label><input type = 'checkbox' value = '" . $id . "' id = 'invite" . $id . "' class = 'form-check invites' name = 'Invites[]'></div><div class = 'col-10'><div class = 'row'><p>Email:</P><p>" . $email . "</p></div></div></div>";
            array_push($invites, $inviteRow);
        }
        if (count($invites) === 0) {
            $inviteRow = "<div class = 'row'><p>You have no open invitations for " . $group->Name . ".</p></div>";
            array_push($invites, $inviteRow);
        }
        $invites = json_encode($invites, true);
        print_r($invites);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "invite") {
        $groupID = htmlspecialchars($_POST["InviteGroupID"]);
        unset($recipients[array_search('', $_POST["Recipients"])]);
        $recipients = $_POST["Recipients"];
        $filteredRecipients = array();
        foreach ($recipients as $recipient) {
            $filteredRecipient = htmlspecialchars(strtolower($recipient));
            array_push($filteredRecipients, $filteredRecipient);
            if ($filteredRecipient == '') {
                array_pop($filteredRecipients);
            }
        }

        $db = new DB();
        $db->Connect();
        $member = new Member($db->conn);
        $member->readUser($_SESSION["user_id"]);
        $group = new Group($db->conn);
        $group->readGroupByID($groupID);
        $message = new Message($member, $filteredRecipients);
        $message->sendInvite($group->ID, $group->Name);
        $invite = new Invitation($db->conn);
        foreach ($filteredRecipients as $recipient) {
            $invite->createInvitation($groupID, $member->ID, $recipient);
        }

        header("Location:https://robertprockjr.com/leaguevote/views/index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "create") {
        $db = new DB();
        $db->Connect();

        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES T WHERE T.TABLE_SCHEMA = 'League_Vote' AND T.TABLE_NAME = 'Groups'";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $nextID = $result["AUTO_INCREMENT"];
        $name = htmlspecialchars(ucwords($_POST["NewGroupName"]));
        $size = htmlspecialchars($_POST["NewGroupSize"]);
        $creatorID = $_SESSION["user_id"];
        $group = new Group($db->conn);
        $group->createGroup($name, $creatorID, $size);
        $member = new Member($db->conn);
        $member->readUser($_SESSION["user_id"]);
        $member->createMember($nextID);

        header("Location:https://robertprockjr.com/leaguevote/views/index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "edit") {
        $db = new DB();
        $db->Connect();
        $groupID = htmlspecialchars($_POST["EditGroupID"]);
        $name = htmlspecialchars(ucwords($_POST["EditGroupName"]));
        $size = htmlspecialchars($_POST["EditGroupSize"]);
        $group = new Group($db->conn);
        $group->readGroupByID($groupID);
        $group->updateGroup($name, $size);
        header("Location:https://robertprockjr.com/leaguevote/views/index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "delete") {
        $groups = $_POST["GroupCBs"];
        $filteredGroups = array();
        if (!is_array($groups)) {
            $filteredGroup = htmlspecialchars($groups);
            array_push($filteredGroups, $filteredGroup);
        } else if (is_array($groups)) {
            foreach ($groups as $groupCB) {
                $filteredGroup = htmlspecialchars($groupCB);
                array_push($filteredGroups, $filteredGroup);
            }
        }
        $db = new DB();
        $db->Connect();
        $group = new Group($db->conn);

        foreach ($filteredGroups as $filteredGroupID) {
            $group->readGroupByID($filteredGroupID);
            $group->deleteGroup();
        }

        header("Location:https://robertprockjr.com/leaguevote/views/index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "loadEdit") {
        $groupID = htmlspecialchars($_POST["GroupID"]);
        $db = new DB();
        $db->Connect();
        $group = new Group($db->conn);
        $group->readGroupByID($groupID);
        $groupName = $group->Name;
        $groupSize = $group->MaxTeams;
        $data = array($groupName, $groupSize);
        $data = json_encode($data, true);
        print_r($data);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "members") {
        $groupID = htmlspecialchars($_POST["GroupID"]);
        $db = new DB();
        $db->Connect();
        $group = new Group($db->conn);
        $group->readGroupByID($groupID);
        $group->getMembersOfGroup();
        $members = array();
        foreach ($group->Members as $member) {
            $id = $member->ID;
            $name = $member->First . ' ' . $member->Last;
            $email = $member->Email;
            $memberRow = "<div class = 'row'><div class = 'col-2'><label for = 'member" . $id . "' class = 'form-check-label'>Select Member</label><input type = 'checkbox' value = '" . $id . "' id = 'member" . $id . "' class = 'form-check member' name = 'Members[]'></div><div class = 'col-10'><div class = 'row'><p>Name:</P><p>" . $name . "</p></div><div class ='row'><p>Email:</p><p>" . $email . "</p></div></div></div></div>";
            array_push($members, $memberRow);
            if ($id === $group->CreatorID) {
                array_pop($members);
            }
        }

        if (count($members) === 0) {
            $memberRow = "<div class = 'row'><p>No Members to remove. If you are the creator of this group, you cannot remove yourself, only delete the Group.</p></div>";
            array_push($members, $memberRow);
        }
        $members = json_encode($members, true);
        print_r($members);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "leave") {
        $groupID = $_POST["LeaveCBs"];
        $leaves = array();
        if (!is_array($groupID)) {
            $filteredLeave = htmlspecialchars($groupID);
            array_push($leaves, $filteredLeave);
        } else if (is_array($groupID)) {
            foreach ($groupID as $id) {
                $filteredLeave = $id;
                array_push($leaves, $filteredLeave);
            }
        }
        $db = new DB();
        $db->Connect();
        $member = new Member($db->conn);
        $member->readUser($_SESSION["user_id"]);
        foreach ($leaves as $leaveID) {
            $member->deleteMember($leaveID);
            $group = new Group($db->conn);
            $group->readGroupByID($leaveID);
            $group->checkIfFull();
        }
        header("Location:https://robertprockjr.com/leaguevote/views/index.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "deleteMembers") {
        $groupID = htmlspecialchars($_POST["DeleteMembersGroupID"]);
        $members = $_POST["Members"];
        $filteredMembers = array();

        foreach ($members as $member) {
            $filteredMember = htmlspecialchars($member);
            array_push($filteredMembers, $filteredMember);
        }

        $db = new DB();
        $db->Connect();
        $member = new Member($db->conn);
        foreach ($filteredMembers as $memberID) {

            $member->readUser($memberID);
            $member->deleteMember($groupID);
        }
        $group = new Group($db->conn);
        $group->readGroupByID($groupID);
        $group->checkIfFull();
        header("Location:https://robertprockjr.com/leaguevote/views/index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "deleteInvites") {
        $groupID = htmlspecialchars($_POST["DeleteInvitesGroupID"]);
        $invites = $_POST["Invites"];
        $filteredInvites = array();
        foreach ($invites as $invite) {
            $filteredInvite = htmlspecialchars($invite);
            array_push($filteredInvites, $filteredInvite);
        }

        $db = new DB();
        $db->Connect();
        $invite = new Invitation($db->conn);
        foreach ($filteredInvites as $inviteID) {
            $invite->readInvitation($inviteID);
            $invite->deleteInvitation($inviteID);
        }

        header("Location:https://robertprockjr.com/leaguevote/views/index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "groups") {
        $db = new DB();
        $db->Connect();
        $user = new User($db->conn);
        $user->readUser($_SESSION["user_id"]);
        $user->getCreatedGroups();
        $displayGroups = array();
        foreach ($user->Groups as $group) {
            $id = $group->ID;
            $name = $group->Name;
            $groupRow = "<div class = 'row'><div class = 'col-2'><label for = 'groupCB" . $id . "' class = 'form-check-label'>Select Group</label><input type = 'checkbox' value = '" . $id . "' id = 'groupCB" . $id . "' class = 'form-check groups' name = 'GroupCBs[]'></div><div class = 'col-10'><div class = 'row'><p>Group Name:</P><p>" . $name . "</p></div></div></div>";
            array_push($displayGroups, $groupRow);
        }

        if (count($displayGroups) === 0) {
            $groupRow = "<div class = 'row'><p>You have no Groups to delete.</p></div>";
            array_push($displayGroups, $groupRow);
        }
        $displayGroups = json_encode($displayGroups, true);
        print_r($displayGroups);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["Action"] == "leaveGroups") {
        $db = new DB();
        $db->Connect();
        $user = new User($db->conn);
        $user->readUser($_SESSION["user_id"]);
        $user->getUncreatedGroups();
        $leavingGroups = array();
        foreach ($user->Groups as $group) {
            $id = $group->ID;
            $name = $group->Name;
            $groupRow = "<div class = 'row'><div class = 'col-2'><label for = 'leaveCB" . $id . "' class = 'form-check-label'>Select Group</label><input type = 'checkbox' value = '" . $id . "' id = 'leaveCB" . $id . "' class = 'form-check groups' name = 'LeaveCBs[]'></div><div class = 'col-10'><div class = 'row'><p>Group Name:</P><p>" . $name . "</p></div></div></div>";
            array_push($leavingGroups, $groupRow);
        }
        if (count($user->Groups) === 0) {
            $leaveRow = "<div class = 'row'>You have no Groups to leave. Please note, you cannot leave a group you have created, you will have to delete it instead.</div>";
            array_push($leavingGroups, $leaveRow);
        }
        $leavingGroups = json_encode($leavingGroups, true);
        print_r($leavingGroups);
    }
} catch (PDOException $e) {
    echo ($e->getMessage());
}
?>