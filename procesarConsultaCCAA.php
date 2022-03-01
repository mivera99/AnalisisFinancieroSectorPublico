<?php
session_start();

$scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoring'])));
$poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacion'])));
$endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['poblacion'])));
$ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['poblacion'])));
$fondliq = htmlspecialchars(trim(strip_tags($_REQUEST['poblacion'])));

?>