<?php
class Vehicle
{
    private $id;
    private $type;
    private $name;
    private $countryOfOrigin;
    private $production_year;
    private $engine_type;
    private $description;
    private $city;

    public function __construct(int $id)
    {

        $db = Database::getInstance();

        $result = $db->query("SELECT * FROM `vehicle` WHERE `id` = $id");
        $data = $result->fetch_assoc();
        $this->id = $id;
        $this->type = $data['type'];
        $this->name = $data['name'];
        $this->countryOfOrigin = $data['country_of_origin'];
        $this->production_year = $data['production_year'];
        $this->engine_type = $data['engine_type'];
        $this->description = $data['description'];
        $this->city = $data['city'];
    }

    public static function insertVehicle($type, $name, $countryOfOrigin, $productionYear, $engineType, $description, $city)
    {
        $db = Database::getInstance();
        $query = "INSERT INTO vehicle (type, name, country_of_origin, production_year, engine_type, description, city) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("sssisss", $type, $name, $countryOfOrigin, $productionYear, $engineType, $description, $city);
            if ($stmt->execute()) {
                // Vehicle inserted successfully
                return true;
            } else {
                // Error inserting vehicle
                return false;
            }
            $stmt->close();
        } else {
            // Error in preparing the statement
            return false;
        }
    }

    public static function getAllVehiclesOfSameType(string $type)
    {
        $db = Database::getInstance();
        $db_query = $db->query("SELECT `id` FROM `vehicle` WHERE `type` = '$type'");
        $vehicles = array();

        while($data = $db_query->fetch_assoc())
        {
            array_push($vehicles, new Vehicle(intval($data['id'])));
        }
        return $vehicles;
    }

    public function getImage()
    {
        $filePath = "<img src='imgs/";
        $vehicle = strtolower($this->name);
        $vehicle = str_replace([' '], '-', $vehicle);
        $vehicle = htmlentities($vehicle);
        $city = strtolower($this->city);
        placeUnderScoreBeforeString($city);
        switch($this->type)
        {
            case "Bus":
                $filePath .= "buses/$vehicle$city.jpg'>";
            break;
            case "Tram":
                $filePath .= "trams/$vehicle$city.jpg'>";
            break;
            case "Train":
                $filePath .= "trains/$vehicle$city.jpg'>";
            break;
            case "Metro":
                $filePath .= "metro/$vehicle$city.jpg'>";
            break;
        }
        return $filePath;
    }

    public function __toString()
    {
        $table = '<table style = "width: 90%; text-align: `center`">';
        $table .= '<tr><th>Rodzaj</th><th>Nazwa</th><th>Kraj pochodzenia</th><th>Rok produkcji</th><th>Rodzaje silnika</th><th>Miasto</th></tr>';
        $table .= '<tr>';
        $table .= '<td>' . $this->type . '</td>';
        $table .= '<td>' . $this->name . '</td>';
        $table .= '<td>' . $this->countryOfOrigin . '</td>';
        $table .= '<td>' . $this->production_year . '</td>';
        $table .= '<td>' . $this->engine_type . '</td>';
        $table .= '<td>' . $this->city . '</td>';
        $table .= '</tr>';
        $table .= '</table>';

        return $table;
    }
        // Setters
        public function setId($id)
        {
            $this->id = $id;
        }
    
        public function setType($type)
        {
            $this->type = $type;
        }
    
        public function setName($name)
        {
            $this->name = $name;
        }
    
        public function setCountryOfOrigin($countryOfOrigin)
        {
            $this->countryOfOrigin = $countryOfOrigin;
        }
    
        public function setProductionYear($production_year)
        {
            $this->production_year = $production_year;
        }
    
        public function setEngineType($engine_type)
        {
            $this->engine_type = $engine_type;
        }
    
        public function setDescription($description)
        {
            $this->description = $description;
        }
    
        public function setCity($city)
        {
            $this->city = $city;
        }
    
        // Getters
        public function getId()
        {
            return $this->id;
        }
    
        public function getType()
        {
            return $this->type;
        }
    
        public function getName()
        {
            return $this->name;
        }
    
        public function getCountryOfOrigin()
        {
            return $this->countryOfOrigin;
        }
    
        public function getProductionYear()
        {
            return $this->production_year;
        }
    
        public function getEngineType()
        {
            return $this->engine_type;
        }
    
        public function getDescription()
        {
            return $this->description;
        }
    
        public function getCity()
        {
            return $this->city;
        }
}
?>