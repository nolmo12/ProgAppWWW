<?php
/**
 * Klasa Vehicle reprezentująca pojazd.
 */
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

    /**
     * Konstruktor klasy Vehicle.
     * @param int $id - identyfikator pojazdu
     */
    public function __construct(int $id)
    {
        $db = Database::getInstance();

        // Pobranie danych pojazdu z bazy danych na podstawie identyfikatora
        $result = $db->query("SELECT * FROM `vehicle` WHERE `id` = $id");
        $data = $result->fetch_assoc();

        // Inicjalizacja pól obiektu danymi z bazy danych
        $this->id = $id;
        $this->type = $data['type'];
        $this->name = $data['name'];
        $this->countryOfOrigin = $data['country_of_origin'];
        $this->production_year = $data['production_year'];
        $this->engine_type = $data['engine_type'];
        $this->description = $data['description'];
        $this->city = $data['city'];
    }

    /**
     * Metoda statyczna do dodawania nowego pojazdu do bazy danych.
     * @param string $type - rodzaj pojazdu
     * @param string $name - nazwa pojazdu
     * @param string $countryOfOrigin - kraj pochodzenia pojazdu
     * @param int $productionYear - rok produkcji pojazdu
     * @param string $engineType - rodzaj silnika pojazdu
     * @param string $description - opis pojazdu
     * @param string $city - miasto, w którym pojazd jest używany
     * @return bool - true, jeśli dodanie pojazdu zakończyło się sukcesem, false w przeciwnym razie
     */
    public static function insertVehicle($type, $name, $countryOfOrigin, $productionYear, $engineType, $description, $city)
    {
        $db = Database::getInstance();

        // Sprawdzenie poprawności roku produkcji
        if ($productionYear > intval(date('Y')) || $productionYear < 1895) {
            return false;
        }

        // Przygotowanie i wykonanie zapytania SQL zabezpieczonego przed SQL injection
        $query = "INSERT INTO vehicle (type, name, country_of_origin, production_year, engine_type, description, city) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sssisss", $type, $name, $countryOfOrigin, $productionYear, $engineType, $description, $city);
            if ($stmt->execute()) {
                // Pojazd został pomyślnie dodany
                return true;
            } else {
                // Błąd podczas dodawania pojazdu
                return false;
            }
        } else {
            // Błąd w przygotowywaniu instrukcji SQL
            return false;
        }
    }

    /**
     * Metoda statyczna zwracająca tablicę wszystkich pojazdów tego samego rodzaju.
     * @param string $type - rodzaj pojazdu
     * @return array - tablica obiektów pojazdów
     */
    public static function getAllVehiclesOfSameType(string $type)
    {
        $db = Database::getInstance();

        // Pobranie identyfikatorów pojazdów o danym rodzaju
        $db_query = $db->query("SELECT `id` FROM `vehicle` WHERE `type` = '$type'");
        $vehicles = array();

        // Utworzenie obiektów pojazdów na podstawie identyfikatorów
        while ($data = $db_query->fetch_assoc()) {
            array_push($vehicles, new Vehicle(intval($data['id'])));
        }
        return $vehicles;
    }

    /**
     * Metoda statyczna do wyświetlania galerii pojazdów.
     * @param array $vehicles - tablica obiektów pojazdów
     */
    public static function printGallery(array $vehicles)
    {
        foreach ($vehicles as $vehicle) {
            echo "<div class='image' onclick='getInfo(" . $vehicle->getId() . ")'>";
            echo $vehicle->getImage();
            echo "</div>";
        }
    }

    /**
     * Metoda do uzyskiwania ścieżki do obrazka reprezentującego pojazd.
     * @return string - ścieżka do obrazka
     */
    public function getImage()
    {
        $filePath = "<img src='imgs/";
        $vehicle = strtolower($this->name);
        $vehicle = str_replace([' '], '-', $vehicle);
        $vehicle = htmlentities($vehicle);
        $city = strtolower($this->city);
        placeUnderScoreBeforeString($city);

        // Ustalanie ścieżki w zależności od rodzaju pojazdu
        switch ($this->type) {
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

    /**
     * Metoda magiczna __toString, która zwraca obiekt w postaci tabeli HTML.
     * @return string - tabela HTML reprezentująca pojazd
     */
    public function __toString()
    {
        $table = '<table style="width: 90%; text-align: `center`">';
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
