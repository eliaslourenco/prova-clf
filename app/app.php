<?php 

// Eu inicio aqui a sessao pois irei utiliza-la para guardar os dados "temporários" que irão durar apenas uma requisicao,
session_start();
// Vou armazenar aqui os dados que irei processar
$_SESSION['db'] = Array(); 

// inclusao dos models
include_once('Models/Entity.php');
include_once('Models/Sales.php');
include_once('Models/Salesman.php');
include_once('Models/Customer.php');
// Inclusao dos controllers
include_once('Controllers/DataFileController.php');
include_once('Controllers/ReportController.php');
include_once('Controllers/LogController.php');
