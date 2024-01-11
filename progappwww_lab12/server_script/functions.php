<?php
/**
 * Skrypt zawierający przykładowy kod PHP z dodanymi komentarzami w języku polskim.
 */

// Ustawienie raportowania błędów
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Dołączenie plików konfiguracyjnych i klas
include "Cfg.php";
include "Database.php";
include "Vehicle.php";

// Utworzenie instancji obiektu bazy danych
$db = Database::getInstance();

// Sprawdzenie poprawności połączenia z bazą danych
if ($db->connect_error) {
    echo "Błąd w połączeniu z bazą danych: " . $db->connect_error;
}

/**
 * Funkcja zwracająca losową ciekawostkę.
 */
function getFunFact()
{
    $db = Database::getInstance();

    // Pobranie liczby ciekawostek
    $result = $db->query("SELECT COUNT(`id`) as `count` FROM `ciekawostki`");
    $data = $result->fetch_assoc();
    $max = intval($data['count']);
    $result->free_result();

    // Wylosowanie numeru ciekawostki
    $random = rand(1, $max);

    // Pobranie wylosowanej ciekawostki
    $result = $db->query("SELECT `tekst` FROM `ciekawostki` WHERE `id` = $random LIMIT 1");
    $data = $result->fetch_assoc();

    echo $data['tekst'];
}

/**
 * Funkcja dodająca podkreślenie przed ciągiem znaków.
 * @param string $str - ciąg znaków, przed którym ma zostać dodane podkreślenie.
 */
function placeUnderScoreBeforeString(string &$str)
{
    $tempStr = "_";
    $tempStr .= $str;
    $str = $tempStr;
}

/**
 * Funkcja wyświetlająca treść strony o podanym identyfikatorze.
 * @param int $id - identyfikator strony
 * @return string - treść strony w formie HTML
 * @throws InvalidArgumentException - wyjątek rzucany w przypadku niepoprawnego typu argumentu $id
 * @throws Exception - wyjątek rzucany, gdy strona nie zostanie znaleziona
 */
function showPage($id = 1)
{
    $db = Database::getInstance();

    // Sprawdzenie poprawności typu argumentu $id
    if (!is_int($id)) {
        throw new InvalidArgumentException('Invalid argument type for $id. Must be of type int.');
    }

    // Zapytanie SQL pobierające treść strony o podanym identyfikatorze
    $query = "SELECT `page_content` FROM `page_list` WHERE id = ? LIMIT 1";

    // Przygotowanie i wykonanie zapytania SQL zabezpieczonego przed SQL injection
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Pobranie wyników zapytania
    $result = $stmt->get_result();
    $pageData = $result->fetch_assoc();

    // Sprawdzenie czy strona została znaleziona
    if (!$pageData) {
        throw new Exception("Page not found");
    }

    // Zwrócenie treści strony zdekodowanej z encji HTML
    return html_entity_decode($pageData['page_content']);
}

/**
 * Funkcja zwracająca tytuł strony o podanym identyfikatorze.
 * @param int $id - identyfikator strony
 * @return string - tytuł strony
 * @throws Exception - wyjątek rzucany, gdy strona nie zostanie znaleziona
 */
function getTitle($id = 1)
{
    $db = Database::getInstance();

    // Zapytanie SQL pobierające tytuł strony o podanym identyfikatorze
    $query = "SELECT `page_title` FROM `page_list` WHERE id = ? LIMIT 1";

    // Przygotowanie i wykonanie zapytania SQL zabezpieczonego przed SQL injection
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Pobranie wyników zapytania
    $result = $stmt->get_result();
    $pageData = $result->fetch_assoc();

    // Sprawdzenie czy strona została znaleziona
    if (!$pageData) {
        throw new Exception("Page not found");
    }

    // Zwrócenie tytułu strony
    return $pageData['page_title'];
}

/**
 * Funkcja wyświetlająca alert z przesłaną wiadomością.
 * @param string $message - treść wiadomości
 */
function sendAlert($message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>
