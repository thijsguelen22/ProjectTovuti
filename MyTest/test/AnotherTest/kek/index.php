
<style>
    html {
        font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
		background-image: url("../.././img/wp.jpg");
		background-size: cover;
    }
    #login {
        margin-top: 5% !important;
        margin: auto;
        width: 25%;
        padding: 30px;
        background-color: hsla(0, 0%, 100%, 0.6);
		border-radius: 10px;
    }
</style>
<?php
session_start();
require("../../../inc/header.php");


?>
<div id="login">
	<h1 style="text-align: center; color: #FF6A00;">My-test.nl login</h1>
	<form>
		<table>
		<tr><td>E-mail:</td><td><input type="text" name="email" id="email" /></td></tr>
		<tr><td>Wachtwoord:</td><td><input type="password" name="password" /></td></tr>
		<tr><td><br /><input style="width: 80px;" type="submit" value="login" name="submit" /></td><td></td></tr>
		</table>
	</form>
</div>
<?php


?>