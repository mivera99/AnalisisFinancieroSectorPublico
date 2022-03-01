<?php
session_start();

$scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringMUN'])));
$endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionMUN'])));
$ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['poblacion'])));
$fondliq = htmlspecialchars(trim(strip_tags($_REQUEST['poblacion'])));

?>