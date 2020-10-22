<?php 

namespace app\Models;
use app\Controllers\LogController;


class Sales implements Entity {

    public $id;
    public $entityName;

    public function __construct() 
    {
        $this->id = '003';
        $this->entityName = 'sales';
    }

    function insert(array $row ){
        
        $strItem = str_replace(array('[',']'), '', $row[2]);
        $arrItem = explode('|', $strItem);
        if(is_array($arrItem) && count($arrItem)) {
            $row[2] = $arrItem;
            $_SESSION['db'][$this->entityName][trim($row[1])] = $this->insertKeys($row);
        } else {
            $errorMsg = 'Erro ao inserir linha no Sales, formato invalido';
            LogController::writeErrorLog($errorMsg);
        }
    }

    function insertKeys(array $row){
        return array(
            'id_entity' => trim($row[0]),
            'id_sale' => trim($row[1]),
            'item' =>  array(
                'id_item'   => trim($row[2][1]),
                'dsc_item' => trim($row[2][0]),
                'qtd'   => trim($row[2][2]),
                'price'   => trim($row[2][3]),
                'final_price' => (trim($row[2][2]) * trim($row[2][3]))
            )
            ,
            'id_salesman' => trim($row[3]),
        );
    }

    function total()
    {
        return (isset($_SESSION['db'][$this->entityName])) ? count($_SESSION['db'][$this->entityName]) : 0;
    }

    function moreExpensiveSale() 
    {
        if(isset($_SESSION['db'][$this->entityName]) && is_array($_SESSION['db'][$this->entityName])) {
            
            $baseData = $_SESSION['db'][$this->entityName];

            $itens =  array_column($baseData, 'item');            
            $precos =  array_column($itens, 'final_price');
            $moreExpensivePrice = max( $precos );

            foreach( $baseData as $row) {
                if( $row['item']['final_price'] >= $moreExpensivePrice ){
                    $moreExpensive = $row;
                    $moreExpensivePrice = $row['item']['final_price'];
                }
            }
            return $moreExpensive;
        }
    }
    
}