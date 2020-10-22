<?php

use app\Controllers\DataFileController;
use app\Controllers\ReportController;
// Start na aplication
include_once('app/App.php');

// Instancio meus objetos reponsaveis por processar os arquivos e gerar o relatorio
$objDataFiles  = new DataFileController();
$objReport = new ReportController();

// Leio, valido e armazeno os dados dos arquivos .dat
$objDataFiles->readFiles();

// Realiza a analise solicitada e retorna os dados experados
$output = $objReport->get();

// Faço o output do formulario
$writeResult = $objDataFiles->writeReportFile($output);

// Exibo o resultado e finalizo a aplicacao
$created = (isset($writeResult['success'])) ? $writeResult['success'] == 1 : 0;

if($created) {
    die("Relatório gerado com sucesso: {$output}\nDisponível no arquivo: ". $writeResult['path']);
}
