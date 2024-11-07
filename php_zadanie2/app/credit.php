<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';


function getParams(&$kwota,&$procent,&$lata){
    $kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
    $procent = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : null;
    $lata = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
}

function validate(&$kwota,&$procent,&$lata,&$messages){
    if ( ! (isset($kwota) && isset($procent) && isset($lata))) {
        
        return false;
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
    
    if (count ( $messages ) != 0) return false;
    
        if (! is_numeric( $kwota )) {
            $messages [] = 'Pierwsza wartość nie jest poprawną kwotą';
        }
        
        if (! is_numeric( $procent)) {
            $messages [] = 'Druga wartość nie jest poprawna';
        }
        
        if (! is_numeric( $lata)) {
            $messages [] = 'Trzecia wartość nie jest poprawna';
        }
        
        if (count ( $messages ) != 0) return false;
        else return true;
        
    
}
    
    
function process(&$kwota,&$procent,&$lata,&$messages,&$wynik){
        
        global $role;
        $kwota = floatval($kwota);
        $procent = floatval($procent);
        $lata = intval($lata);
        $miesiace = $lata * 12 ;
        
        if($role == 'admin'){
            $wynik = ($kwota + $kwota * $procent/100)/$miesiace ;
        }
        else{
            if($kwota < 100000){
                $wynik = ($kwota + $kwota * $procent/100)/$miesiace ;
            }
            else{
                $messages [] = 'Tylko administrator może dawać pożyczki powyżej 100000 zł !';
            }
        }
        
        if($wynik != null){
        $wynik = round($wynik, 2); 
        }
}

$kwota = null;
$procent = null;
$lata = null;
$wynik = null;
$messages = array();

getParams($kwota,$procent,$lata);
if ( validate($kwota,$procent,$lata,$messages) ) { 
    process($kwota,$procent,$lata,$messages,$wynik);
}
    
    
    include 'credit_view.php';
    
    
