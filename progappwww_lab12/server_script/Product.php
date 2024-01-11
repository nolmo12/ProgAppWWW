<?php
require_once 'Database.php';
require_once 'Category.php';

class Product
{
    private int $id;
    private string $title;
    private string $description;
    private DateTime $creationTime;
    private DateTime $modificationTime;
    private DateTime $expirationTime;
    private float $nettoPrice;
    private float $vat;
    private int $quantity;
    private bool $availability;
    private  Category $category;
    private float $dimensions;
    private string $photo;

    public function __construct(int $id)
    {
        $db = Database::getInstance();

        // Fetch product data from the database based on the provided ID
        $result = $db->query("SELECT * FROM products WHERE id = $id LIMIT 1");
        $data = $result->fetch_assoc();

        // Set properties based on the fetched data
        $this->id = $id;
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->creationTime = new DateTime($data['creation_time']);
        $this->modificationTime = new DateTime($data['modification_time']);
        $this->expirationTime = new DateTime($data['expiration_time']);
        $this->nettoPrice = $data['netto_price'];
        $this->vat = $data['vat'];
        $this->quantity = $data['quantity'];
        $this->availability = boolval($data['availability']);
        $this->category = new Category($data['category_id']);
        $this->dimensions = $data['dimensions'];
        $this->photo = $data['photo'];
    }

    public function updateProduct(array $data)
    {
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        $db = Database::getInstance();
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->modificationTime = new DateTime();
        $this->expirationTime = new DateTime($data['expiration_time']);
        $this->nettoPrice = $data['netto_price'];
        $this->vat = $data['vat'];
        $this->quantity = $data['quantity'];
        $this->availability = $data['availability'];
        $this->category = new Category($data['category_id']);
        $this->dimensions = $data['dimensions'];
        $this->photo = $data['photo'];

        $stmt = $db->prepare("UPDATE `products` SET `title` = ?, `description` = ?, `netto_price` = ?, `vat` = ?, `quantity` = ?, `availability` = ?, `category_id` = ?, `dimensions` = ?, `photo` = ?, `modification_time` = ?, `expiration_time` = ? WHERE `id` = ?");
        $stmt->bind_param("ssddiiidsssi", $this->title, $this->description, $this->nettoPrice, $this->vat, $this->quantity, $this->availability, $data['category_id'], $this->dimensions, $this->photo, $now, $data['expiration_time'], $this->id);

        if ($stmt->execute()) {
            echo "Product updated successfully";
        } else {
            echo "Product couldn't be updated";
        }
        $stmt->close();
    }

    public static function removeProduct($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM `products` WHERE `id` = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Product removed successfully";
        } else {
            echo "Product couldn't be removed";
        }

        $stmt->close();
    }

    public static function addProduct(array $data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO `products`(`title`, `description`, `expiration_time`, `netto_price`, `vat`, `quantity`, `availability`, `category_id`, `dimensions`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssddiiids", $data['title'], $data['description'], $data['expiration_time'], $data['netto_price'], $data['vat'], $data['quantity'], $data['availability'], $data['category_id'], $data['dimensions'], $data['photo']);
        if ($stmt->execute()) {
            echo "Product added successfully";
        } else {
            echo "Product couldn't be added";
        }

        $stmt->close();
    }

    public static function showAllProducts()
    {
    $db = Database::getInstance();
    $result = $db->query("SELECT `id`, `title` FROM `products` LIMIT 100");
    $select = '<h1>PRODUKTY</h1><form name="selectProduct" method="get" action="' . $_SERVER['REQUEST_URI'] . '"><select name = "products" id = "productList">';

    while ($data = $result->fetch_assoc()) {
        $select .= '<option value="' . $data['id'] . '">' . $data['title'] . '</option>';
    }

    $select .= '<option value="add">Add new product</option></select>';
    $select .= '<input type="submit" name = "subProd" value="Wybierz">';
    $select .= '<input type="submit" name = "subProd" value="Usuń"></form>';
    return $select;
    }

    // Add getter methods for other properties

    public function __toString(): string
    {
        return "Product ID: {$this->id}, Title: {$this->title}, Price: {$this->nettoPrice}, Quantity: {$this->quantity}, Category: {$this->category->getName()}";
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreationTime(): DateTime
    {
        return $this->creationTime;
    }

    // You can customize the return type based on your needs

    public function setCreationTime(DateTime $creationTime): void
    {
        $this->creationTime = $creationTime;
    }

    public function getModificationTime(): DateTime
    {
        return $this->modificationTime;
    }

    // You can customize the return type based on your needs

    public function setModificationTime(DateTime $modificationTime): void
    {
        $this->modificationTime = $modificationTime;
    }

    public function getExpirationTime(): DateTime
    {
        return $this->expirationTime;
    }

    // You can customize the return type based on your needs

    public function setExpirationTime(DateTime $expirationTime): void
    {
        $this->expirationTime = $expirationTime;
    }

    public function getNettoPrice(): float
    {
        return $this->nettoPrice;
    }

    public function setNettoPrice(float $nettoPrice): void
    {
        $this->nettoPrice = $nettoPrice;
    }

    public function getVat(): float
    {
        return $this->vat;
    }

    public function setVat(float $vat): void
    {
        $this->vat = $vat;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $db = Database::getInstance();
        $query = "UPDATE `products` SET `quantity` = ? WHERE `id` = ? LIMIT 1";
        $stmt = $db->prepare($query);
        
        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param("ii", $quantity, $this->id);
        
            // Execute the statement
            if ($stmt->execute()) {
                echo "Update successful";
            } else {
                echo "Update failed: " . $stmt->error;
            }
        
            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $db->error;
        }

        $this->quantity = $quantity;
    }

    public function getAvailability(): bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): void
    {
        $this->availability = $availability;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getDimensions(): float
    {
        return $this->dimensions;
    }

    public function setDimensions(float $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }
}

?>