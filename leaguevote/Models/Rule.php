<?php
class Rule
{
    public $ID;
    public $GroupID;
    public $Group;
    public $CreatorID;
    public $Creator;
    public $CategoryID;
    public $Category;
    public $Title;
    public $Description;
    public $DateCreated;
    public $daysBeforeMajority;
    public $numOfVotes;
    public $IsClosed;
    public $DateClosed;
    public $ResultID;
    public $Result;
    public $Votes = array();
    public $Options = array();
    public $Conn;
    public function __construct($conn)
    {
        $this->Conn = $conn;
    }


    public function deleteRule()
    {
        $sql = "DELETE FROM Rules WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
    }
    public function readRuleById($id)
    {
        $sql = "SELECT * FROM Rules WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $this->ID = $result['Id'];
        $this->Title = $result['title'];
        $this->Description = $result['description'];
        $this->CreatorID = $result['creator_id'];
        $user = new User($this->Conn);
        $user->readUser($result['creator_id']);
        $this->Creator = $user;
        $this->GroupID = $result['group_id'];
        $group = new Group($this->Conn);
        $group->readGroupByID($this->GroupID);
        $this->Group = $group;
        $this->Group->getMembersOfGroup();
        $this->CategoryID = $result['category_id'];
        $category = new Category($this->Conn);
        $category->readCategoryById($this->CategoryID);
        $this->Category = $category;
        $this->DateCreated = $result['date_created'];
        if (isset($result['is_closed']) == true) {
            $this->IsClosed = $result['is_closed'];
        }
        if (isset($result['date_closed']) == true) {
            $this->DateClosed = $result['date_closed'];
        }
        if (isset($result['result_id']) == true) {
            $this->ResultID = $result['result_id'];
            $option = new Option($this->Conn);
            if ($this->ResultID == 0) {
                $option->ID = 0;
                $option->Text = "No Winner";
                $option->RuleID = $this->ID;
            } else {
                $option->readOneOption($result['result_id']);
            }
            $this->Result = $option;
        }
        if (isset($result['days_before_majority']) == true) {
            $this->daysBeforeMajority = $result['days_before_majority'];
        }
    }

    public function getVotes()
    {
        $sql = "SELECT * FROM Votes WHERE rule_id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
        $result = $stmt->fetchall();
        for ($i = 0; $i < count($result); $i++) {
            $vote = new Vote($this->Conn);
            $vote->ID = $result[$i]['id'];
            $vote->RuleID = $result[$i]['rule_id'];
            $vote->UserID = $result[$i]['user_id'];
            $vote->OptionID = $result[$i]['option_id'];
            $vote->DateOfVote = $result[$i]['date_of_vote'];
            array_push($this->Votes, $vote);
        }
        return $this->Votes;
    }
    public function getOptions()
    {
        $sql = "SELECT * FROM Options WHERE rule_id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
        $result = $stmt->fetchAll();
        for ($i = 0; $i < count($result); $i++) {
            $option = new Option($this->Conn);
            $option->ID = $result[$i]['id'];
            $option->Text = $result[$i]['text'];
            $option->RuleID = $result[$i]['rule_id'];
            array_push($this->Options, $option);
        }
        return $this->Options;
    }
    public function countVotes()
    {
        $this->numOfVotes = count($this->Votes);
        return $this->numOfVotes;
    }
    public function closeVoting()
    {
        if ($this->Votes == null) {
            $this->getVotes();
            $this->countVotes();
        }
        if ($this->Options == null) {
            $this->getOptions();
            $this->tallyVotes();
        }

        $resultID = null;
        $dateClosed = null;
        $isClosed = 0;

        $allVotesCast = $this->areAllVotesCast();

        $isLeadTooBig = $this->isLeadTooBig();

        $landslide = $this->landslideCheck();

        $str = "P" . $this->daysBeforeMajority . "D";
        $majDI = new DateInterval($str);
        $dateForMajority = new DateTime($this->DateCreated, new DateTimeZone("America/New_York"));


        $dateForMajority->add($majDI);
        $today = new DateTime(`"Now"`, new DateTimeZone("America/New_York"));


        if (date > $today) {
            if ($allVotesCast == 1) {
                $resultID = $this->declareResult();
                $isClosed = 1;
                $dateClosed = date_format($today, 'Y-n-j');
            } else if ($allVotesCast != 1) {
                $resultID = null;
                $isClosed = 0;
                $dateClosed = null;
            }
        } else if ($today >= $dateForMajority && $landslide == 1 || $today >= $dateForMajority && $allVotesCast == 1) {
            $resultID = $this->declareResult();
            $isClosed = 1;
            $dateClosed = date_format($today, 'Y-n-j');
        }
        $sql = "UPDATE Rules SET is_closed = ?, date_closed = ?, result_id = ? WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$isClosed, $dateClosed, $resultID, $this->ID]);
    }

    public function tallyVotes()
    {
        if ($this->Votes == null) {
            $this->getVotes();
        }
        if ($this->Options == null) {
            $this->getOptions();
        }
        foreach ($this->Votes as $vote) {
            foreach ($this->Options as $option) {
                if ($vote->OptionID == $option->ID) {
                    $option->VotesReceived++;

                }
            }

        }

    }
    public function isLeadTooBig()
    {
        if ($this->Votes == null) {
            $this->getVotes();
            $this->countVotes();
        }


        if ($this->Options == null) {
            $this->getOptions();
            $this->tallyVotes();
        }

        $numOfMembers = count($this->Group->Members);
        echo ("There are " . $numOfMembers . " members");

        $votesLeft = $numOfMembers - $this->numOfVotes;
        echo ("Votes Left: " . $votesLeft);
        $votesForOptions = array();
        for ($i = 0; $i < count($this->Options); $i++) {
            $votesForOptions[$i] = $this->Options[$i]->VotesReceived;
        }
        rsort($votesForOptions);
        $leader = $votesForOptions[0];

        $runnerUp = $votesForOptions[1];
        echo ("Runner Up is: " . $runnerUp);
        $lead = $leader - $runnerUp;

        if ($lead > $votesLeft) {
            $result = true;
            //break;
        } else {
            $result = false;
        }


        return $result;
    }
    public function areAllVotesCast()
    {
        if ($this->Votes == null) {
            $this->getVotes();
        }
        if ($this->numOfVotes == null) {
            $this->countVotes();
        }
        if (count($this->Group->MaxTeams) == $this->numOfVotes) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    public function landslideCheck()
    {
        if ($this->Votes == null) {
            $this->getVotes();
            $this->countVotes();
        }
        if ($this->Options == null) {
            $this->getOptions();
            $this->tallyVotes();
        }



        $halfMembers = count($this->Group->Members) / 2;
        foreach ($this->Options as $option) {
            if ($option->VotesReceived == null) {
                $this->tallyVotes();
                echo "<br>";


            }
            if ($option->VotesReceived > $halfMembers) {
                $result = true;
                break;
            } else {
                $result = false;
            }

        }
        return $result;

    }
    public function declareResult()
    {
        if ($this->Votes == null) {
            $this->getVotes();
            $this->countVotes();
        }
        if ($this->Options == null) {
            $this->getOptions();
            $this->tallyVotes();
        }
        $votesForOptions = array();
        for ($i = 0; $i < count($this->Options); $i++) {
            $votesForOptions[$i] = $this->Options[$i]->VotesReceived;
        }
        rsort($votesForOptions);
        $leader = $votesForOptions[0];
        $runnerUp = $votesForOptions[1];
        foreach ($this->Options as $option) {
            if ($leader == $runnerUp) {
                $result = 0;
            } else if ($leader > $runnerUp && $leader == $option->VotesReceived) {
                $result = $option->ID;
                break;
            }
        }
        return $result;
    }
    public function createNewRule($creatorID, $groupID, $categoryID, $title, $description, $daysBeforeMajority)
    {
        $today = date('y-n-d');
        $sql = "INSERT INTO Rules (creator_id, group_id, category_id, title, description, date_created, days_before_majority) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$creatorID, $groupID, $categoryID, $title, $description, $today, $daysBeforeMajority]);
    }
    public function createOptionForRule($text, $ruleID)
    {
        $sql = "INSERT INTO Options (text, rule_id) VALUES (?, ?)";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$text, $ruleID]);
    }
}
?>