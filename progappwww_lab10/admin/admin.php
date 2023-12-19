<!DOCTYPE html>
<html>
<head>
    <!-- Include jQuery and custom script files with deferred loading -->
    <script src="../script/jquery.js" defer></script>
    <script src="../script/script.js" defer></script>
    <link rel="stylesheet" href="../style/style.css">
    <script>
        window.addEventListener("load", myInit, true); function myInit(){
            rememberSelectedItem(document.getElementById('queryList'))
            rememberSelectedItem(document.getElementById('categoryList'))
        }
    </script>
</head>
<body>
<main>
<?php

// Rozpoczęcie sesji
session_start();

// Dołączenie pliku z funkcjami serwera
include "../server_script/functions.php";
require_once "../server_script/Category.php";

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
            echo Category::showAllCategories();

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

            if (isset($_GET['subCat'])) {
                if ($_GET['subCat'] === "Wybierz") {
                    if ($_GET['categories'] != 'add') {
                        echo $this->editCategoryForm($_GET['categories']);
                    } else {
                        echo $this->addCategoryForm();
                    }
                } else {
                    if ($_GET['categories'] === 'add') {
                        echo "Wrong option";
                    } else {
                        $this->removePage($_GET['categories']);
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

        if(isset($_POST['editCategory']))
        {
            $data = array(
                $_GET['categories'],
                $_POST['name'],
                $_POST['parent']
            );
            Category::updateCategory($data);
        }

        if(isset($_POST['addCategory']))
        {
            $data = array(
                $_POST['name'],
                $_POST['parent']
            );
            Category::addCategory($data);
        }

        // Sprawdzenie przesłanych danych z formularza logowania
        if(isset($_POST['sub']))
        {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $this->login($_POST['login'], $_POST['password']);
            }
        }
        else if(isset($_POST['remind']))
        {
            $this->remindPassword();
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
            <div id="sznyc">
                <form name="loginForm" method="post" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
                    <table>
                        <tr>
                            <td>Login: </td><td><input type="text" id="login" name="login" placeholder="Wpisz login"></td>
                        </tr>
                        <tr>
                            <td>Hasło: </td><td><input type="password" id="passw" name="password" placeholder="Wpisz hasło"></td>
                        </tr>
                        <tr>
                        <td><input type="submit" id="sub" name="sub" value="Zaloguj się"></td>
                        <td><input type="submit" id="remind" name="remind" value="Przypomnij hasło"></td>
                        </tr>
                    </table>
                </form>
            </div>';
    }

    /**
     * Metoda generująca formularz wylogowania
     */
    private function logoutForm()
    {
        return '
            <div id="sznyc">
                <h1>PANEL WYLOGOWANIA<h1>
                <form name="loginForm" method="post" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
                    <input type="submit" id="sub" name="logout" value="Wyloguj się">
                </form>
            </div>';
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
            header("Location:admin.php");
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
            header("Location:admin.php");
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
            header("REFRESH:0");
        } else {
            echo "Page couldn't be added";
        }

        $stmt->close();
    }

    private function editCategoryForm($id)
    {
        $result = $this->db->query("SELECT `parent`, `name`FROM `categories` WHERE `id` = $id");
        $data = $result->fetch_assoc();
        
        $parentId = intval($_GET['categories']);

        if($parentId != 0)
        {
            $result2 = $this->db->query("SELECT `parent` FROM `categories` WHERE `id` = $parentId");
            $data2 = $result2->fetch_assoc();

            $parentId = intval($data2['parent']);
            if($parentId != 0)
            {
                $result3 = $this->db->query("SELECT `name` FROM `categories` WHERE `id` = $parentId");
                $data3 = $result3->fetch_assoc(); 
            }

        }

        
        $form = '<form name="contentForm" method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <label for="title">Name:</label>
            <input type="text" id="name" name="name" value="' . $data['name'] . '">
            <label for="parent">Parent:</label>
            <select id="parent" name="parent">';
            foreach(Category::getAllCategories() as $category)
            {
                if(isset($data3['name']))
                {
                    if($category['name'] == $data3['name'])
                        $form.='<option value='.$category['id'].' selected="selected">'.$category['name'].'</option>';
                    else
                        $form.='<option value='.$category['id'].'>'.$category['name'].'</option>';
                }
                else
                {
                    $form.='<option value='.$category['id'].'>'.$category['name'].'</option>';
                }
            }

            $form.='<option value = "NOPARENT">NO PARENT</option>
            </select>
        <input type="submit" name="editCategory" value="Edit Category">
        </form>';

        return $form;
    }

    private function addCategoryForm()
    {
        $form = '<form name="contentForm" method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <label for="title">Title:</label>
            <input type="text" id="name" name="name" value="name">
            <select id="parent" name="parent">';
            foreach(Category::getAllCategories() as $category)
            {
                $form.='<option value='.$category['id'].'>'.$category['name'].'</option>';
            }

            $form.='<option value = "NOPARENT">NO PARENT</option>
            </select>
            <input type="submit" name="addCategory" value="Submit Category">
        </form>';

        return $form;
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
        $select = '<h1>STRONY</h1><form name="selectPage" method="get" action="' . $_SERVER['REQUEST_URI'] . '"><select name = "pages" id = "queryList">';

        while ($data = $result->fetch_assoc()) {
            $select .= '<option value="' . $data['id'] . '">' . $data['page_title'] . '</option>';
        }
        $select .= '<option value="add">Add new page</option></select>';
        $select .= '<input type="submit" name = "sub" value="Wybierz">';
        $select .= '<input type="submit" name = "sub" value="Usuń"></form>';
        return $select;
    }

    private function remindPassword()
    {
        require_once "../mail.php";
    }
}

// Utworzenie instancji klasy PageManager i wywołanie metody render
$pageManager = new PageManager();
$pageManager->render();
?>
</main>
</body>
</html>
