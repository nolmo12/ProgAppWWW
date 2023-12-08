<!DOCTYPE html>
<html>
<head>
    <!-- Include jQuery and custom script files with deferred loading -->
    <script src="../script/jquery.js" defer></script>
    <script src="../script/script.js" defer></script>
</head>
<body onload="rememberSelectedItem(document.getElementById('queryList'))">
<main>
<?php

// Rozpoczęcie sesji
session_start();

// Dołączenie pliku z funkcjami serwera
include "../server_script/functions.php";

/**
 * Prosta klasa PHP do zarządzania zawartością na mojej stronie internetowej
 * @author BOLMO <pawelo320@wp.pl>
 */
class PageManager
{
    private $db;

    public function __construct()
    {
        // Inicjalizacja połączenia z bazą danych
        $this->db = Database::getInstance();
    }

    /**
     * Metoda do renderowania panelu administratora.
     * Jeżeli administrator jest zalogowany, to wyświetla formularz wylogowania
     * oraz listę rozwijaną z opcjami edycji podstron.
     * Jeżeli zostanie przesłane $_POST[''], to aktualizuje bazę danych danymi związany z nazwą tablicy asocjacyjnej.
     */
    public function render()
    {
        if (isset($_SESSION['user'])) {
            echo $this->logoutForm();
            echo $this->subPagesList();

            // Sprawdzenie czy przesłano zmienną $_GET['sub']
            if (isset($_GET['sub'])) {
                if ($_GET['sub'] === "Wybierz") {
                    if ($_GET['pages'] != 'add') {
                        echo $this->editPageForm($_GET['pages']);
                    } else {
                        echo $this->addPageForm();
                    }
                } else {
                    if ($_GET['pages'] === 'add') {
                        echo "Wrong option";
                    } else {
                        $this->removePage($_GET['pages']);
                    }
                }
            }
        } else {
            // Jeżeli administrator nie jest zalogowany, wyświetl formularz logowania
            echo $this->loginForm();
        }

        // Sprawdzenie przesłanych danych z formularza edycji
        if (isset($_POST['editContent'])) {
            $data = [$_POST['title'], htmlspecialchars($_POST['content']), $_POST['isActive'], $_GET['pages']];
            $this->updatePage($data);
        }

        // Sprawdzenie przesłanych danych z formularza dodawania
        if (isset($_POST['addContent'])) {
            $data = [$_POST['title'], $_POST['content'], $_POST['isActive']];
            $this->addPage($data);
        }

        // Sprawdzenie przesłanych danych z formularza logowania
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $this->login($_POST['login'], $_POST['password']);
        }

        // Sprawdzenie przesłanych danych z formularza wylogowania
        if (isset($_POST['logout'])) {
            $this->logout();
        }
    }

    /**
     * Metoda generująca formularz logowania
     */
    private function loginForm()
    {
        return '
        <main>
            <div id="sznyc">
                <form name="loginForm" method="post" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
                    <table>
                        <tr>
                            <td>Login: </td><td><input type="text" id="login" name="login" required placeholder="Wpisz login"></td>
                        </tr>
                        <tr>
                            <td>Hasło: </td><td><input type="password" id="passw" name="password" required placeholder="Wpisz hasło"></td>
                        </tr>
                        <tr>
                            <td</td><td><input type="submit" id="sub" name="sub" value="Zaloguj się"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>';
    }

    /**
     * Metoda generująca formularz wylogowania
     */
    private function logoutForm()
    {
        return '
        <main>
            <div id="sznyc">
                <form name="loginForm" method="post" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
                    <input type="submit" id="sub" name="logout" value="Wyloguj się">
                </form>
            </div>
        </main>';
    }

    /**
     * Metoda generująca formularz edycji strony
     */
    private function editPageForm($id)
    {
        $result = $this->db->query("SELECT `page_title`, `page_content`, `status` FROM `page_list` WHERE `id` = $id");
        $data = $result->fetch_assoc();

        $form = '<form name="contentForm" method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="' . $data['page_title'] . '">

            <label for="content">Page Content:</label>
            <textarea id="content" rows=50 cols=100 name="content">' . $data['page_content'] . '</textarea>';

        $form .= '<label>
            <input type="checkbox" id="isActive" name="isActive" value="' . $data['status'] . '" ' . ($data['status'] == 1 ? 'checked' : '') . '>
            Site is active
        </label>

        <input type="submit" name="editContent" value="Submit Content">
        </form>';

        return $form;
    }

    /**
     * Metoda usuwająca stronę
     */
    private function removePage($id)
    {
        $stmt = $this->db->prepare("DELETE FROM `page_list` WHERE `id` = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Page removed successfully";
        } else {
            echo "Page couldn't be removed";
        }

        $stmt->close();
    }

    /**
     * Metoda aktualizująca stronę
     */
    private function updatePage($data)
    {
        $stmt = $this->db->prepare("UPDATE `page_list` SET `page_title` = ?, `page_content` = ?, `status` = ? WHERE `id` = ?");
        $stmt->bind_param("ssii", $data[0], $data[1], $data[2], $data[3]);

        if ($stmt->execute()) {
            echo "Page updated successfully";
        } else {
            echo "Page couldn't be updated";
        }

        $stmt->close();
    }

    /**
     * Metoda generująca formularz dodawania nowej strony
     */
    private function addPageForm()
    {
        $form = '<form name="contentForm" method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="title">

            <label for="content">Page Content:</label>
            <textarea id="content" rows=10 cols=100 name="content"></textarea>
            <label>
                <input type="checkbox" id="isActive" name="isActive" value="1" checked>
                Site is active
            </label>

            <input type="submit" name="addContent" value="Submit Content">
        </form>';

        return $form;
    }

    /**
     * Metoda dodająca nową stronę
     */
    private function addPage($data)
    {
        $stmt = $this->db->prepare("INSERT INTO `page_list`(`page_title`, `page_content`, `status`) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $data[0], $data[1], $data[2]);

        if ($stmt->execute()) {
            echo "Page added successfully";
        } else {
            echo "Page couldn't be added";
        }

        $stmt->close();
    }

    /**
     * Metoda wylogowująca administratora
     */
    private function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header("Refresh:0");
    }

    /**
     * Metoda logująca administratora
     */
    private function login($userName, $pass)
    {
        $userName = strtolower($userName);
        if ($this->checkLogin($userName, $pass)) {
            $_SESSION['user'] = $this->createToken();
            header("Refresh:0");
        } else {
            echo "Logowanie nie powiodło się";
        }
    }

    /**
     * Metoda generująca unikalny token
     */
    private function createToken()
    {
        $token = md5(uniqid(mt_rand(), true));
        return $token;
    }

    /**
     * Metoda sprawdzająca poprawność danych logowania
     */
    private function checkLogin($userName, $pass)
    {
        if (empty($userName) || empty($pass)) {
            return false;
        }
        if ($userName === Cfg::$user_name && $pass === Cfg::$user_pass) {
            return true;
        }
        return false;
    }

    /**
     * Metoda generująca listę rozwijaną z podstronami
     */
    private function subPagesList()
    {
        $result = $this->db->query("SELECT `id`, `page_title` FROM `page_list` LIMIT 100");
        $select = '<form name="selectPage" method="get" action="' . $_SERVER['REQUEST_URI'] . '"><select name = "pages" id = "queryList">';

        while ($data = $result->fetch_assoc()) {
            $select .= '<option value="' . $data['id'] . '">' . $data['page_title'] . '</option>';
        }
        $select .= '<option value="add">Add new page</option></select>';
        $select .= '<input type="submit" name = "sub" value="Wybierz">';
        $select .= '<input type="submit" name = "sub" value="Usuń"></form>';
        return $select;
    }
}

// Utworzenie instancji klasy PageManager i wywołanie metody render
$pageManager = new PageManager();
$pageManager->render();

?>
</main>
</body>
</html>
