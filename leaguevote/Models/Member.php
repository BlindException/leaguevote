<?php
class Member extends User
{
    public $GroupID;
    public $DateJoined;

    public function createMember($groupID)
    {
        $sql = "INSERT INTO Members (user_id, group_id, date_joined)VALUES(?, ?, ?)";
        $today = date('y-n-d');
        if ($this->ID == null) {
            $this->ID = $_SESSION["user_id"];
        }
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID, $groupID, $today]);
    }
    public function deleteMember($groupID)
    {
        $sql = "DELETE FROM Members WHERE user_id = ? && group_id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID, $groupID]);
    }
}
?>