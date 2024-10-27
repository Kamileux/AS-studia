<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<h2>Kalkulator Kredytowy</h2>
<form method="post" action="calc.php">
<label for="amount">Kwota kredytu:</label>
<input type="number" id="amount" name="amount"><br>
<label for="interest">Oprocentowanie (%):</label>
<input type="number" id="interest" name="interest"><br>
<label for="months">Liczba miesięcy:</label>
<input type="number" id="months" name="months"><br>

<button type="submit" name="calculate_credit">Oblicz ratę miesięczną</button><br>
</form>
</body>
</html>