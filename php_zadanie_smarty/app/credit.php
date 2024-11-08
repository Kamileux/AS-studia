<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';


function getParams(&$form){
    $form['kwota'] = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
    $form['procent'] = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : null;
    $form['lata'] = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form,&$infos,&$messages,&$hide_intro){
    if ( ! (isset($form['kwota']) && isset($form['procent']) && isset($form['lata']) )) {
        
        return false;
        
    }
    $hide_intro = true;
    $infos [] = 'Przekazano parametry.';
    
    if ( $form['kwota'] == "") {
        $messages [] = 'Nie podano kwoty';
    }
    if ( $form['procent'] == "") {
        $messages [] = 'Nie podano oprocentowania';
    }
    if ( $form['lata'] == "") {
        $messages [] = 'Nie podano liczby miesięcy';
    }
    
    if (count ( $messages ) != 0) return false;
    
    if (! is_numeric( $form['kwota'] )) {
        $messages [] = 'Pierwsza wartość nie jest poprawną kwotą';
    }
    
    if (! is_numeric( $form['procent'])) {
        $messages [] = 'Druga wartość nie jest poprawna';
    }
    
    if (! is_numeric( $form['lata'])) {
        $messages [] = 'Trzecia wartość nie jest poprawna';
    }
    
    if (count ( $messages ) != 0) return false;
    else return true;
    
    
}
	
function process(&$form,&$infos,&$messages,&$wynik){
    $infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
    
    $kwota = floatval($form['kwota']);
    $procent = floatval($form['procent']);
    $lata = intval($form['lata']);
    $miesiace = $lata * 12 ;
    
    
    $wynik = ($kwota + $kwota * $procent/100)/$miesiace ;
   
    if($wynik != null){
        $wynik = round($wynik, 2);
    }
    
}
    
    


$form = array();
$wynik = null;
$messages = array();
$hide_intro = false;
$infos = array();
	

getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ) {
    process($form,$infos,$messages,$wynik);
}
// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Zadanie Smarty');
$smarty->assign('page_description','Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header','Szablony Smarty');

$smarty->assign('hide_intro',$hide_intro);

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('form',$form);
$smarty->assign('wynik',$wynik);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/credit.html');