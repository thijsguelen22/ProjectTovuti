<link rel="stylesheet" type="text/css" href="./inc/main.css">
<?php
session_start();
require(__DIR__ . "/inc/header.php");
require(__DIR__ . "/inc/functions.php");
require(__DIR__ . "/inc/connector.php");
if(IsLoggedInCheck($_SESSION)) {
    echo '<div id="login"><h2><b>U bent al ingelogd. Kijk bij toetsen voor openstaande toetsen.</b></h2>';
} else {
    if($_POST["submit"]) {
        $passwd = hash('sha512', $_POST['password']);
        $LoginRet = (LoginCheck($_POST['email'], $passwd, $pdo));
        if($LoginRet['LoggedIn'] == true) {
            echo '<div id="login"><h2>succesvol ingelogd</h2><br />';
            $_SESSION['LoggedIn'] = $LoginRet['LoggedIn'];
            $_SESSION['level'] = $LoginRet['level'];
            $_SESSION['UserId'] = $LoginRet['UserID'];
            $_SESSION['Docent'] = $LoginRet['Docent'];
        } else {
            echo '<div id="login"><h2>Er was een fout. probeer het opnieuw.</h2><br />';
        }
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