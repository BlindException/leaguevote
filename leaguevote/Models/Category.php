<?php
class Category
{
    public $ID;
    public $Name;
    public $Conn;
    public function __construct($conn)
    {
        $this->Conn = $conn;
        return $this->Conn;
    }
    public function readCategoryById($id)
    {
        $sql = "SELECT * FROM Categories WHERE id = ?";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $this->ID = $result['Id'];
        $this->Name = $result['Name'];
    }
    public function readAllCategories()
    {
        $sql = "SELECT * FROM Categories";
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $Categories = [];
        for ($i = 0; $i < count($result); $i++) {
            $category = new Category($this->conn);
            $category->ID = $result[$i]["Id"];
            $category->Name = $result[$i]["Name"];
            array_push($Categories, $category);
        }
        return $Categories;
    }
}
?>