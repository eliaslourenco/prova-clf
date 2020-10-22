<?php

use app\Controllers\DataFileController;
include_once('app/App.php');

$objDataFiles  = new DataFileController();
// Leio e armazeno os dados dos arquivos .dat
$objDataFiles->readFiles();
print_r($_SESSION); die();



// instancio o controller files
// ->readFiles()
// ->processData()
// ->writeFileOutput
// Retorno mensagem e imprimo retorno na tela
