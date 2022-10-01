<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual,string $proximo) : bool {
    if($actual !== $proximo) {
        return true;
    } else {
        return false;
    }
}

// Funcion que comprueba usuario logueado 
function isAuth():void{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

// Funcion que comprueba usuario logueado sea administrador 
function isAdmin():void{
    if (!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}