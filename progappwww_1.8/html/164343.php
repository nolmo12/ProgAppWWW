<?php
$nr_indeksu = '164343';
$nrGrupy = '3';
echo 'czesc'.$nr_indeksu;
echo 'Paweł Bąk '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
echo 'Zastosowanie metody include() <br />';
include '../server_script/functions.php';
getFunFact();
echo '<br>Zastosowanie warunków if else, else if, switch<br>';
$random = rand(1, 10);
if($random == 2)
{
    echo "Zmienna random wynosi: $random <br>";
}
else if($random > 5)
{
    echo 'Zmienna random jest większa od 5<br>';
}
else
{
    echo 'Pozostały przypadek<br>';
}
switch($random)
{
    case 1:
        echo 'Poniedziałek<br>';
        break;
    case 2:
        echo 'Wtorek<br>';
        break;
    case 3:
        echo 'Środa<br>';
        break;
    case 4:
        echo 'Czwartek<br>';
        break;
    case 5:
        echo 'Piątek<br>';
        break;
    case 6:
        echo 'Sobota<br>';
        break;
    case 7:
        echo 'Niedziela<br>';
        break;
    default:
        echo 'Zły dzień tygodnia<br>';
}
echo 'Zastosowanie pętli for() i while() <br>';

for($i = 0; $i < $random; $i++)
{
    echo $i.'<br>';
}

$i = 0;

while($i < $random)
{
    echo $i.'<br>';
    $i += 1;
}

echo 'Zastosowanie $_GET, $_POST i $_SESSION<br>';

if(isset($_GET['xd']))
{
    echo $_GET['xd'];
}
if(isset($_POST['sznyc']))
{
    echo $_POST['sznyc'];
}

$_SESSION['user'] = 'Nolmo';
echo $_SESSION['user'];

echo '<br>Zastosowanie funkcji require_once() <br>';
require_once 'testanim.html';
?>