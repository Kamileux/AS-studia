<?php
require_once dirname(__FILE__).'/../config.php';

$kwota = $_REQUEST ['kwota'];
$procent = $_REQUEST ['procent'];
$lata = $_REQUEST ['lata'];


if ( ! (isset($lata) && isset($procent) && isset($kwota))) {
    
    $messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}


if ( $kwota == "") {
    $messages [] = 'Nie podano kwoty';
}
if ( $procent == "") {
    $messages [] = 'Nie podano oprocentowania';
}
if ( $lata == "") {
    $messages [] = 'Nie podano liczby miesięcy';
}


if (empty( $messages )) {
    
    
    if (! is_numeric( $kwota )) {
        $messages [] = 'Pierwsza wartość nie jest poprawną kwotą';
    }
    
    if (! is_numeric( $procent)) {
        $messages [] = 'Druga wartość nie jest poprawna';
    }
    
    if (! is_numeric( $lata)) {
        $messages [] = 'Trzecia wartość nie jest poprawna';
    }
    
}

if (empty ( $messages )) {
    
    
    $kwota = floatval($kwota);
    $procent = floatval($procent);
    $lata = intval($lata);
    $miesiace = $lata * 12 ; 
 
    $miesieczna_rata = ($kwota + $kwota * $procent/100)/$miesiace ; 
  
    $messages[] =  "Miesięczna rata wynosi: " . $miesieczna_rata ;
    
    
}
foreach($messages as $tabelka){
    echo  $tabelka . "<br/>" ; 
}

include 'credit_view.php';
