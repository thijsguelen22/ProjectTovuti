
<link rel="stylesheet" type="text/css" href="./inc/main.css" />
<?php
session_start();
require(__DIR__ . "/inc/header.php");
require(__DIR__ . "/inc/functions.php");
require(__DIR__ . "/inc/connector.php");
if(IsLoggedInCheck($_SESSION)) {
    if(isset($_GET['toetsID'])) {
        $ToetsArr = GetToetsVragen($pdo, $_GET['toetsID']);
        $_SESSION['ToetsArr'] = $ToetsArr;
        include('./inc/VraagWindow.php');
        //var_dump(GetToetsVragen($pdo, 1)[2]);
    } else {
        echo '<div id="login">';
        //var_dump(GetAvailableToetsen($pdo, "AO"));
        echo GetAvailableToetsen($pdo, "AO");
        echo '</div>';
    }
} else {
    header("Location: ".$_SERVER['HTTP_HOST']);
}

?>