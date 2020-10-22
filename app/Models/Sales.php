<?php 

namespace app\Models;
use app\Controllers\LogController;


class Sales implements Entity {

    public $id;

    public function __construct() 
    {
        $this->id = '003';
    }

    function insert(array $row ){
        
        $strItem = str_replace(array('[',']'), '', $row[2]);
        $arrItem = explode('|', $strItem);
        if(is_array($arrItem) && count($arrItem)) {
            $row[2] = $arrItem;
            $_SESSION['db']['sales'][] = $row;
        } else {
            $errorMsg = 'Erro ao inserir linha no Sales, formato invalido';
            LogController::writeErrorLog($errorMsg);
        }
    }

    function insertKeys(array $row){
        
    }
    
}