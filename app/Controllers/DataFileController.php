<?php

namespace app\Controllers;

use app\Models\Entity;
use app\Models\Customer;
use app\Models\Sales;
use app\Models\Salesman;

class DataFileController
{
    
    private $objModelSales;
    private $objModelCustomer;
    private $objModelSalesman;
    private $data;

    public function __construct() 
    {
        $this->objModelCustomer = new  Customer();
        $this->objModelSalesman = new  Salesman();
        $this->objModelSales = new  Sales();
    }

    /**
     * Funcao responsavel por "ler" os arquivos da pasta data/in e encaminhar para registro nas entidades
     */
    public function readFiles() 
    {
        $dir = './data/in';
        $files = scandir($dir);

        foreach($files as $file) {

            $filePath = $dir .'/'. $file;
            if( is_file($filePath) ) {
                $this->processFile($filePath);
            }
        }  
        return true;
    }

    /***
     * Funcao responsavel por processar a entrada de dados do arquivo que contem os dados
     */
    public function processFile($file)
    {

        if($this->validateFormatFile($file, 'dat')) {
            $content = file_get_contents($file);
            $this->shareByEntity($content);

        } else {
            $errorMsg = 'Erro de formato, somente arquivos .dat serão processados, referente ao arquivo' . $file;
            LogController::writeErrorLog($errorMsg);
            
        }    
    }

    /**
     * Distribui para a entidade a qual o dado pertence e solicita sua inclusao 
     */
    public function shareByEntity(string $content) 
    {
        $arrRows = explode(';', $content);
        
        if( is_array($arrRows) && count($arrRows) > 0 ) {
            foreach($arrRows as $row) {

                $dataRow = explode(',', $row);

                $idRow = ($dataRow[0]) ? $dataRow[0] : 000;

                switch ($idRow) {
                    case $this->objModelCustomer->id:
                        $this->insertEntityRow($this->objModelCustomer, $dataRow);
                        break;
                    case $this->objModelSalesman->id:
                        $this->insertEntityRow($this->objModelSalesman, $dataRow);
                        break;
                    case $this->objModelSales->id:
                        $this->insertEntityRow($this->objModelSales, $dataRow);
                        break;
                    default:
                        $errorMsg = 'Invalid data at' . $row;
                        LogController::writeErrorLog($errorMsg);
                        break;
                }
            }
        }
    }

    /**
     * Recebo o objeto Entity e encaminha para inserir os dados desta linha
     */
    public function insertEntityRow(Entity $objEntity, $row)
    {
        $objEntity->insert($row);
    }

    /**
     * 
     */
    public function validateFormatFile($file, $format)
    {
        $fileInfo = pathinfo($file);
        return ($fileInfo['extension'] == $format) ? true : false;
    }
    
    public function processData() 
    {
        
    }
}