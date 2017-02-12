<link rel="stylesheet" type="text/css" href="./inc/main.css">

<?php
session_start();
require(__DIR__ . "/inc/header.php");
require(__DIR__ . "/inc/functions.php");
require(__DIR__ . "/inc/connector.php");
if(IsLoggedInCheck($_SESSION)) {
    echo '<div id="login"><h2><b>BIEM!</b></h2>';
} else {
    if($_POST["submit"]) {
        $LoginRet = (LoginCheck($_POST['email'], $_POST['password'], $pdo));
        var_dump($LoginRet);
        if($LoginRet['LoggedIn'] = true) {
            $_SESSION['LoggedIn'] = true;
            $_SESSION['level'] = $LoginRet['level'];
            header("Location: ".$_SERVER['HTTP_HOST']);
        }
        var_dump($_POST);

        echo '</div>';
    } else {
?>
<div id="login">
	<h1 style="text-align: center; color: #FF6A00;">My-test.nl login</h1>
	<form method="POST">
		<table>
		<tr><td>E-mail:</td><td><input type="email" name="email" id="email" /></td></tr>
		<tr><td>Wachtwoord:</td><td><input type="password" name="password" /></td></tr>
		<tr><td><br /><input style="width: 80px;" type="submit" value="login" name="submit" /></td><td></td></tr>
		</table>
	</form>
</div>
<?php
    }
}

?>