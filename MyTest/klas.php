
<link rel="stylesheet" type="text/css" href="./inc/main.css" />
<?php
session_start();
require(__DIR__ . "/inc/header.php");
require(__DIR__ . "/inc/functions.php");
require(__DIR__ . "/inc/connector.php");
if(IsLoggedInCheck($_SESSION)) {
    if(IsTeacherCheck($_SESSION)) {
        echo '<div id="login"><h2>test</h2></div>';
    }
    header("Location: ".$_SERVER['HTTP_HOST']);
}
header("Location: ".$_SERVER['HTTP_HOST']);
?>