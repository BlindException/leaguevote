<?php
class Group
{
    public $ID;
    public $Name;

    public $CreatorID;
    public $Creator;
    public $DateCreated;
    public $MaxTeams;
    public $IsFull;
    public $Members = array();
    public $Invitations = array();
    public $Rules = array();
    public $Conn;
    public function __construct($conn)
    {
        $this->Conn = $conn;
        return $this->Conn;
    }
    public function createGroup($name, $creatorID, $maxTeams)
    {
        $isFull = false;
        $today = date('Y-m-d');
        $sql = "INSERT INTO Groups (name, creator_id, date_created, max_teams, is_full)VALUES(?,?,?,?,?)";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$name, $creatorID, $today, $maxTeams, $isFull]);
    }
    public function updateGroup($name, $maxTeams)
    {
        $sql = "UPDATE Groups SET name= ?, max_teams = ? WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$name, $maxTeams, $this->ID]);
    }
    public function deleteGroup()
    {
        $sql = "DELETE FROM Groups WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
    }
    public function readGroupByID($id)
    {
        $sql = "SELECT * FROM Groups WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $this->ID = $result['Id'];
        $this->Name = $result['Name'];

        $this->CreatorID = $result['creator_id'];
        $this->DateCreated = $result['date_created'];
        $this->MaxTeams = $result['max_teams'];
        $this->IsFull = $result['is_full'];
    }
    public function setCreator()
    {
        $creator = new User($this->Conn);
        $creator->readUser($this->CreatorID);
        $this->Creator = $creator;
        return $this->Creator;
    }
    public function getMembersOfGroup()
    {
        $sql = "SELECT Users.id, Users.firstname, Users.lastname, Users.email, Users.username, Users.date_created, Members.date_joined FROM Users INNER JOIN Members ON Users.id = Members.user_id WHERE group_id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
        $result = $stmt->fetchall();
        for ($i = 0; $i < count($result); $i++) {
            $user = new Member($this->Conn, $this->ID, $result[$i]['date_joined']);
            $user->ID = $result[$i]['id'];
            $user->First = $result[$i]['firstname'];
            $user->Last = $result[$i]['lastname'];
            $user->Email = $result[$i]['email'];
            $user->Username = $result[$i]['username'];
            $user->DateCreated = $result[$i]['date_created'];

            array_push($this->Members, $user);
        }
        return $this->Members;
    }
    public function getOpenRulesForGroup($userID)
    {
        $sql = "SELECT * FROM Rules WHERE group_id =? && is_closed!= True&& ? NOT IN(SELECT user_id FROM Votes WHERE rule_id = Rules.id)";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID, $userID]);
        $result = $stmt->fetchall();
        for ($i = 0; $i < count($result); $i++) {
            $rule = new Rule($this->Conn);
            $rule->readRuleById($result[$i]['Id']);
            $rule->getVotes();
            $rule->numOfVotes = $rule->countVotes();
            $rule->getOptions();
            array_push($this->Rules, $rule);
        }
        return $this->Rules;
    }
    public function getClosedRulesForGroup()
    {
        $sql = "SELECT * FROM Rules WHERE group_id =? && is_closed= 1";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
        $result = $stmt->fetchall();

        for ($i = 0; $i < count($result); $i++) {
            $rule = new Rule($this->Conn);
            //try{
            $rule->readRuleById($result[$i]['Id']);
            $rule->getVotes();
            $rule->numOfVotes = $rule->countVotes();
            $rule->getOptions();
            //}catch(PDOException $f)
            //{echo("this is your error".$f->getMessage());}
            array_push($this->Rules, $rule);
        }
        return $this->Rules;
    }
    public function getInvitationsForGroup()
    {
        $sql = "SELECT id FROM Invitations WHERE group_id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
        $results = $stmt->fetchAll();

        $array = array();
        foreach ($results as $result) {
            $invite = new Invitation($this->Conn);
            $invite->readInvitation($result["id"]);
            array_push($array, $invite);
        }
        $this->Invitations = $array;
        return $this->Invitations;
    }
    public function checkIfFull()
    {
        if ($this->Members == null) {
            $this->getMembersOfGroup();
        }
        $memberCount = count($this->Members);

        if ($memberCount >= $this->MaxTeams) {
            $this->IsFull = true;
        } else if ($memberCount < $this->MaxTeams) {
            $this->IsFull = false;
        }
        $sql = "UPDATE Groups SET is_full =? WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->IsFull, $this->ID]);
    }
}
?>