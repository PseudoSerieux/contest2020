<?php
session_start();

$bdd = new PDO('mysql:host=localhost; dbname=puissance4', 'root', '');

function printBeautify($text)
{

    echo $text . "\n";

}

function formatErrorMsg($errors, $icon = "&#9888;")
{

    $return = "";
    foreach ($errors as $key => $msg) {
        //AFFICHE les éléments "$msg"
        $return.='<p class="msg_error">' . $icon . ' ' . upper($msg) . '</p>';
    }
    return $return;
}

function upper($str){
    return mb_strtoupper($str, 'UTF8');
}