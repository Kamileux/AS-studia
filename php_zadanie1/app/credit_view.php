<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator Budzetowy</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/credit.php" method="post">
	<label for="id_x">Kwota</label>
	<input id="id_x" type="text" name="kwota"/><br />
	<label for="id_y">Oprocentowanie</label>
	<input id="id_y" type="text" name="procent"/><br />
	<label for="id_z">Liczba lat </label>
	<input id="id_z" type="text" name="lata"/><br />
	<input type="submit" value="Oblicz" />
</form>	



</body>
</html>
