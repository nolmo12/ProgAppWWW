<?php
require_once 'Database.php';

class Category
{
    private int $id;
    private $parent;
    private string $name;

    public function __construct(int $id)
    {
        $db = Database::getInstance();

        // Pobranie danych pojazdu z bazy danych na podstawie identyfikatora
        $result = $db->query("SELECT * FROM `categories` WHERE `id` = $id LIMIT 1");
        $data = $result->fetch_assoc();
        $this->id = $id;
        if(intval($data['parent']) != 0)
            $this->parent = new Category(intval($data['parent']));
        else
            $this->parent = NULL;
        $this->name = $data['name'];
    }

    public function __toString()
    {
        $children = $this->getChildren();
        $text = "<h3>$this->name</h3>";
        if(count($children) != 0)
        {
            $text .= "<ul>";
            foreach($children as $child)
            {
                $text .= "<li>$child</li>";
            }
            $text .= "</ul>";
        }
        return $text;
    }

    private function getChildren()
    {
        $children = [];
        $db = Database::getInstance();
        $result = $db->query("SELECT id FROM `categories` WHERE `parent` = $this->id");
        while($data = $result->fetch_assoc())
        {
            $childrenCategory = new Category(intval($data['id']));
            array_push($children, $childrenCategory);
        }
        return $children;
    }

    public static function getAllCategories()
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT `id`, `parent`, `name` FROM `categories` LIMIT 100");
        $categories = array();
        while($data = $result->fetch_assoc())
        {
            $categoryData = array('id' => $data['id'], 'parent' => $data['parent'], 'name' => $data['name']);
            array_push($categories, $categoryData);
        }
        return $categories;
    }
    public static function showAllCategories()
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT `id`, `parent`, `name` FROM `categories` LIMIT 100");
        $select = '<h1>KATEGORIE</h1><form name="selectCategory" method="get" action="' . $_SERVER['REQUEST_URI'] . '"><select name = "categories" id = "categoryList">';

        while ($data = $result->fetch_assoc()) {
            $select .= '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
        }
        $select .= '<option value="add">Add new category</option></select>';
        $select .= '<input type="submit" name = "subCat" value="Wybierz">';
        $select .= '<input type="submit" name = "subCat" value="Usuń"></form>';
        return $select;
    }

    public static function removeCategory()
    {

    }
    public static function addCategory(array $data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO `categories`( `name`, `parent`) VALUES (?, ?)");
        $stmt->bind_param("si", $data[0], $data[1]);

        if ($stmt->execute()) {
            echo "Page added successfully";
            header("REFRESH:0");
        } else {
            echo "Page couldn't be added";
        }

        $stmt->close();
    }

    public static function updateCategory(array $data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE `categories` SET `name` = ?, `parent` = ? WHERE `id` = ?");
        $stmt->bind_param("ssi", $data[1], $data[2], $data[0]);

        if ($stmt->execute()) {
            echo "Page updated successfully";
            header("Location:admin.php");
        } else {
            echo "Page couldn't be updated";
        }

        $stmt->close();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent): void
    {
        $this->parent = $parent;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
?>