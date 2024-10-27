<?php
$result = '';
$error1 = '';
$error2 = '';
$monthly_payment = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['calculate_credit'])) {
    $number1 = $_POST['x'];
    $number2 = $_POST['y'];
    $operation = $_POST['op'];
    
    if ($number1 === '') {
        $error1 = 'Brakuje pierwszej liczby.';
    }
    if ($number2 === '') {
        $error2 = 'Brakuje drugiej liczby.';
    }
    
    if (empty($error1) && empty($error2) && !empty($operation)) {
        switch ($operation) {
            case 'plus':
                $result = $number1 + $number2;
                break;
            case 'minus':
                $result = $number1 - $number2;
                break;
            case 'times':
                $result = $number1 * $number2;
                break;
            case 'div':
                if ($number2 != 0) {
                    $result = $number1 / $number2;
                } else {
                    $result = 'Nie można dzielić przez zero!';
                }
                break;
            default:
                $result = 'Nieznana operacja';
                break;
        }
    }
}



include 'calc_view.php';

echo "<div style='margin-top: 20px;'>";
if (!empty($error1)) echo "<p style='color: red;'>$error1</p>";
if (!empty($error2)) echo "<p style='color: red;'>$error2</p>";
if (!empty($result) && empty($error1) && empty($error2)) echo "<p>Wynik to: $result</p>";
echo "</div>";



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calculate_credit'])) {
    $amount = $_POST['amount'];
    $interest = $_POST['interest'];
    $months = $_POST['months'];
    
    
    if (!empty($amount) && !empty($interest) && !empty($months)) {
        $total_amount = $amount + ($amount * ($interest / 100));
        $monthly_payment = $total_amount / $months;
    } else {
        $monthly_payment = 'Proszę wypełnić wszystkie pola formularza kredytowego.';
    }
}

include 'credit_view.php';

echo "<div>";
if (!empty($monthly_payment) && is_numeric($monthly_payment)) {
    echo "<p>Miesięczna rata to: " . number_format($monthly_payment, 2) . " PLN</p>";
} elseif (!empty($monthly_payment)) {
    echo "<p style='color: red;'>$monthly_payment</p>";
}
echo "</div>";
?>
