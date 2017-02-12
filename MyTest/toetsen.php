
<link rel="stylesheet" type="text/css" href="./inc/main.css" />
<?php
session_start();
require(__DIR__ . "/inc/header.php");
require(__DIR__ . "/inc/functions.php");
require(__DIR__ . "/inc/connector.php");
if(IsLoggedInCheck($_SESSION)) {
    if(IsTeacherCheck($_SESSION)) {
        if(isset($_POST['submit'])) {
                //echo "dit is leerling ".$_POST['leerling'.$k];
            $postarr = array();
            $postcounter = 0;
            foreach ($_POST as &$value) {
                $postarr[$postcounter] = $value;
                $postcounter++;
            }
            UpdateEnableTest($pdo, $_POST['toets'], $postarr[1]);
            echo '<div id="login"><h2>Leerling succesvol gekoppeld aan toets</h2"></div>';
            //$sql = "INSERT INTO `leerlingtoetsen` (ToetsId, UserId, IsGemaakt) VALUES (:ToetsId, :LeerlingId, :IsGemaakt)";
            
        } else {
            echo '<div id="login"><h2>Toets klaarzetten voor leerling</h2>';
            //var_dump(EnableTest($pdo, $_SESSION['UserId']));
            echo '<form method="POST">';
            echo EnableTest($pdo, $_SESSION['UserId'])[1];
            echo EnableTest($pdo, $_SESSION['UserId'])[0];
            echo '<input style="width: 80px;" type="submit" value="verstuur" name="submit" />';
            echo "</form>";
        }
    } else {
        if(isset($_GET['toetsID'])) {
        echo "dikke tieten";
            $ToetsArr = GetToetsVragen($pdo, $_GET['toetsID']);
            $_SESSION['ToetsArr'] = $ToetsArr;
            $_SESSION['GemaakteToetsID'] = $_GET['toetsID'];
            include('./inc/VraagWindow.php');
            //var_dump(GetToetsVragen($pdo, 1)[2]);
        } else {
            echo '<div id="login"><h2>Openstaande toetsen:</h2>';
            //var_dump(GetAvailableToetsen($pdo, "AO"));
            $AvailableTests = GetOpenToetsen($pdo, $_SESSION['UserId']);
            for($i=0;$i<count($AvailableTests);$i++) {
                echo GetAvailableToetsen($pdo, $AvailableTests[$i]);
            }
            //echo GetAvailableToetsen($pdo, "AO");
            //var_dump($AvailableCategories);
            //echo $_SESSION['UserId'];
            echo '</div>';
        }
    }
} else {
    header("Location: ".$_SERVER['HTTP_HOST']);
}

?>