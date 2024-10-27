
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Kalkulatory</title>
</head>
<body>
<h2>Kalkulator</h2>
<form method="post" action="calc.php">
<label for="x">Liczba 1:</label>
<input type="number" id="x" name="x"><br>

<label for="op">Operacja:</label>
<select id="op" name="op">
<option value="plus">+</option>
<option value="minus">-</option>
<option value="times">*</option>
<option value="div">/</option>
</select><br>

<label for="y">Liczba 2:</label>
<input type="number" id="y" name="y"><br>

<button type="submit">Oblicz</button><br>

</form>

</html>