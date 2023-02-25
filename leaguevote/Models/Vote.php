<?php
class Vote
{
    public $ID;
    public $RuleID;
    public $userID;
    public $OptionID;
    public $DateOfVote;
    public $Conn;
    public function __construct($conn)
    {
        $this->Conn = $conn;
    }
    public function createVote($ruleID, $userID, $vote)
    {
        try {
            $today = date('y-n-d');
            $sql = "INSERT INTO Votes(rule_id, user_id, option_id, date_of_vote)VALUES(?,?,?,?)";
            $stmt = $this->Conn->prepare($sql);
            $stmt->execute([$ruleID, $userID, $vote, $today]);
            $sql = "INSERT INTO Voters VALUES(?,?)";
            $stmt = $this->Conn->prepare($sql);
            $stmt->execute([$userID, $ruleID]);
        } catch (Error $e) {
            echo ($e->getMessage());
        }
    }
    public function readVote($id)
    {
        $sql = "SELECT * FROM Votes WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $this->ID = $result['id'];
        $this->RuleID = $result['rule_id'];
        $this->userID = $result['user_id'];
        $this->OptionID = $result['option_id'];
        $this->DateOfVote = $result['ate_of_vote'];
    }


}
?>