<?php
class Option
{
    public $ID;
    public $Text;
    public $RuleID;
    public $VotesReceived = 0;
    public $Conn;
    public function __construct($conn)
    {
        $this->Conn = $conn;
    }
    public function createOption($text, $ruleID)
    {
        $sql = "INSERT INTO Options text, rule_id VALUES(?, ?)";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$text, $ruleID]);
    }
    public function readOptionsForRule($ruleID)
    {
        $sql = "SELECT * FROM Options WHERE rule_id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$ruleID]);
        $result = $stmt->fetchall();
        $this->ID = $result[0]['id'];
        $this->Text = $result[0]['text'];
        $this->RuleID = $result[0]['rule_id'];
    }
    public function updateOption($text)
    {
        $sql = "UPDATE Options SET text = ? WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$text, $this->ID]);
    }
    public function deleteOption()
    {
        $sql = "DELETE FROM Options WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
    }
    public function readOneOption($id)
    {
        $sql = "SELECT * FROM Options WHERE id =?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $this->ID = $result['id'];
        $this->Text = $result['text'];
        $this->RuleID = $result['rule_id'];
    }
}
?>