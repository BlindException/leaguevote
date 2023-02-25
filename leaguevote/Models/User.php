<?php
class User
{
    public $ID;
    public $First;
    public $Last;
    public $Email;
    public $Username;
    public $Password;
    public $DateCreated;
    public $Groups = array();
    public $Rules = array();
    public $Conn;
    public function __construct($conn)
    {
        $this->Conn = $conn;
    }
    public function createUser($first, $last, $email, $username, $password)
    {
        $today = date('y-n-d');
        $sql = "INSERT INTO Users (firstname, lastname, email, username, password, date_created)VALUES(?,?,?,?,?, ?)";
        $stmt = $this->Conn->prepare($sql);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$first, $last, $email, $username, $hash, $today]);
    }
    public function getGroups()
    {
        try {
            $sql = "SELECT Groups.id AS group_id FROM Groups INNER JOIN Members ON Groups.id = Members.group_id WHERE Members.user_id = ?";
            $stmt = $this->Conn->prepare($sql);
            $stmt->execute([$this->ID]);
            $result = $stmt->fetchall();
            for ($i = 0; $i < count($result); $i++) {
                $group = new Group($this->Conn);
                $group->readGroupbyID($result[$i]['group_id']);
                array_push($this->Groups, $group);
            }
            return $this->Groups;
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }
    public function getCreatedGroups()
    {
        try {
            $sql = "SELECT Groups.id AS group_id FROM Groups INNER JOIN Members ON Groups.id = Members.group_id WHERE Members.user_id = ? &&Groups.creator_id =?";
            $stmt = $this->Conn->prepare($sql);
            $stmt->execute([$this->ID, $this->ID]);
            $result = $stmt->fetchall();
            for ($i = 0; $i < count($result); $i++) {
                $group = new Group($this->Conn);
                $group->readGroupbyID($result[$i]['group_id']);
                array_push($this->Groups, $group);
            }
            return $this->Groups;
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }
    public function getAllRules($group_id = null)
    {
        try {
            $sql = "SELECT Rules.id, Users.username, Groups.Name, Categories.name, Rules.title, Rules.description FROM Rules INNER Join Users ON Rules.creator_id = Users.id INNER JOIN Groups ON Rules.group_id = Groups.id INNER JOIN Categories ON Rules.category_id = Categories.id WHERE Rules.group_id = ? && Rules.is_closed = false && Rules.is_closed <> true && Users.id = ? NOT IN(SELECT user_id FROM Voters)";
            $stmt = $this->Conn->prepare($sql);
            if ($group_id != null) {
                $stmt->execute([$group_id, $this->ID]);
                $this->Rules = $stmt->fetchall();
                return $this->Rules;
            } else {
                for ($i = 0; $i < count($this->Groups); $i++) {
                    $groupID = $this->Groups[$i]['id'];

                    $stmt->execute([$groupID, $this->ID]);
                    $rule = $stmt->fetchall();
                    array_push($this->Rules, $rule[0]);
                }
                return $this->Rules;
            }
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }
    public function getCreatedRules($groupID)
    {
        $sql = "SELECT id FROM Rules WHERE creator_id = ? && group_id =?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID, $groupID]);
        $rules = $stmt->fetchAll();
        $createdRules = array();
        for ($i = 0; $i < count($rules); $i++) {
            $ruleID = $rules[$i]["id"];
            $createdRule = new Rule($this->Conn);
            $createdRule->readRuleById($ruleID);
            array_push($createdRules, $createdRule);
        }
        $this->Rules = $createdRules;
        return $this->Rules;
    }
    public function readUser($id)
    {
        $sql = "SELECT * FROM Users WHERE id =?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        $this->ID = $user['Id'];
        $this->First = $user['firstname'];
        $this->Last = $user['lastname'];
        $this->Email = $user['email'];
        $this->Username = $user['username'];
        $this->DateCreated = $user['date_created'];
    }
    public function deleteUser()
    {
        $sql = "DELETE FROM Users WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$this->ID]);
    }

    public function getUncreatedGroups()
    {
        try {
            $sql = "SELECT Groups.id AS group_id FROM Groups INNER JOIN Members ON Groups.id = Members.group_id WHERE Members.user_id = ?&& Groups.creator_id != ?";
            $stmt = $this->Conn->prepare($sql);
            $stmt->execute([$this->ID, $this->ID]);
            $result = $stmt->fetchall();
            for ($i = 0; $i < count($result); $i++) {
                $group = new Group($this->Conn);
                $group->readGroupbyID($result[$i]['group_id']);
                array_push($this->Groups, $group);
            }
            return $this->Groups;
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }
}
?>