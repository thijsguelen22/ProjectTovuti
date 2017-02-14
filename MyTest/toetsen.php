
<link rel="stylesheet" type="text/css" href="./inc/main.css" />
<?php
session_start();
require(__DIR__ . "/inc/header.php");
require(__DIR__ . "/inc/functions.php");
require(__DIR__ . "/inc/connector.php");
if(IsLoggedInCheck($_SESSION)) {
    if(IsTeacherCheck($_SESSION)) {
        if(isset($_POST['submit'])) {
            $postarr = array();
            $postcounter = 0;
            foreach ($_POST as &$value) {
                $postarr[$postcounter] = $value;
                $postcounter++;
            }
            UpdateEnableTest($pdo, $_POST['toets'], $postarr[1]);
            echo '<div id="login"><h2>Leerling succesvol gekoppeld aan toets</h2"></div>';
        } else {
            echo '<div id="login"><h2>Toets klaarzetten voor leerling</h2>';
            echo '<form method="POST">';
            echo EnableTest($pdo, $_SESSION['UserId'])[1];
            echo EnableTest($pdo, $_SESSION['UserId'])[0];
            echo '<input style="width: 80px;" type="submit" value="verstuur" name="submit" />';
            echo "</form>";
        }
    } else {
        if(isset($_GET['toetsID'])) {
            $ToetsArr = GetToetsVragen($pdo, $_GET['toetsID']);
            $_SESSION['ToetsArr'] = $ToetsArr;
            $_SESSION['GemaakteToetsID'] = $_GET['toetsID'];
            include('./inc/VraagWindow.php');
        } else {
            echo '<div id="login"><h2>Openstaande toetsen:</h2>';
            $AvailableTests = GetOpenToetsen($pdo, $_SESSION['UserId']);
            for($i=0;$i<count($AvailableTests);$i++) {
                echo GetAvailableToetsen($pdo, $AvailableTests[$i]);
            }
            echo '</div>';
        }
    }
} else {
    header("Location: ".$_SERVER['HTTP_HOST']);
}
?>