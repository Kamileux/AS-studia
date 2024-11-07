<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator Budzetowy</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>


<div style="width:90%; margin: 2em auto;">
<form action="<?php print(_APP_URL);?>/app/credit.php" method="post" class="pure-form pure-form-stacked">	
<legend>Kalkulator budżetowy</legend>
<fieldset>
	<label for="id_x">Kwota</label>
	<input id="id_x" type="text" name="kwota"/><br />
	<label for="id_y">Oprocentowanie</label>
	<input id="id_y" type="text" name="procent"/><br />
	<label for="id_z">Liczba lat </label>
	<input id="id_z" type="text" name="lata"/><br />
</fieldset>
	<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin-top: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>


<?php if (isset($wynik)){ ?>
<div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">
<?php echo 'Miesięczna rata wynosi: '.$wynik; ?>
</div>
<?php } ?>

</div>
</body>
</html>
