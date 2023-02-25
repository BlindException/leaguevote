<?php
class Invitation
{
    public $ID;
    public $Group;
    public $Sender;
    public $Email;
    public $DateSent;
    public $Conn;
    public function __construct($conn)
    {
        $this->Conn = $conn;
    }
    public function createInvitation($groupID, $senderID, $email)
    {
        $today = date('y-n-d');
        $sql = "INSERT INTO Invitations (group_id, sender_id, email, date_sent) VALUES (?, ?, ?, ?)";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$groupID, $senderID, $email, $today]);
    }
    public function readInvitation($inviteID)
    {
        $sql = "SELECT * FROM Invitations WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$inviteID]);
        $result = $stmt->fetch();
        $this->ID = $result["Id"];
        $group = new Group($this->Conn);
        $group->readGroupByID($result["group_id"]);
        $this->Group = $group;
        $user = new User($this->Conn);
        $user->readUser($result["sender_id"]);
        $this->Sender = $user;
        $this->Email = $result["email"];
        $this->DateSent = $result["date_sent"];
    }
    public function deleteInvitation($inviteID)
    {
        $sql = "DELETE FROM Invitations WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$inviteID]);
    }
    public function deleteInvitationByEmail($groupID, $email)
    {
        $sql = "DELETE FROM Invitations WHERE group_id =? && email = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$groupID, $email]);
    }
}
?>