<?php 

namespace app\Models;


class Salesman implements Entity {

    public $id;
    public $entityName;

    public function __construct() 
    {
        $this->id = '001';
        $this->entityName = 'salesman';
    }

    function insert(array $row ){
        $_SESSION['db'][$this->entityName][trim($row[1])] = $this->insertKeys($row);
        return true;
    }

    function insertKeys(array $row){
        return array(
            'id_entity' => trim($row[0]),
            'cpf' => trim($row[1]),
            'name' => trim($row[2]),
            'salary' => trim($row[3]),
        );
    }

    function total()
    {
        return (isset($_SESSION['db'][$this->entityName])) ? count($_SESSION['db'][$this->entityName]) : 0;
    }

    function meanSalary()
    {
        $arrSalary = (isset($_SESSION['db'][$this->entityName])) ? array_column($_SESSION['db'][$this->entityName], 'salary') : array();
        
        $totalSalary = (array_sum($arrSalary));
        
        $qtdSalesman = $this->total();
        return ($qtdSalesman >  0 ) ? ($totalSalary / $qtdSalesman) : 0;
        
    }

    /**
     * Identifico o pior vendedor atraves da quantidade de vendas o que gerou menos retorno e o pior
     */
    function WorstSalesman()
    {
        $this->totalSales();
        
        $baseData = $_SESSION['db'][$this->entityName];
        $salesValues =  array_column($baseData, 'total_sales');
        $worstSalesValue = min( $salesValues );

        foreach( $baseData as $row) {
            if( $row['total_sales'] <= $worstSalesValue ){
                $worstSalesman = $row;
                $worstSalesValue = $row['total_sales'];
            }
        }
        return $worstSalesman;

    }

    /**
     * Calcula o total de vendas de cada vendedor
     */
    function totalSales() {
        foreach( $_SESSION['db'][$this->entityName] as $key => $salesman) {
            
            $totalVendas = 0;
            $qtdVendas = 0;

            foreach ($_SESSION['db']['sales'] as $sale) {
                
                if ( $sale['id_salesman'] == $key ) {
                    $totalVendas += $sale['item']['final_price'];
                    $qtdVendas++;
                    $_SESSION['db'][$this->entityName][$key]['total_sales'] = $totalVendas;
                    $_SESSION['db'][$this->entityName][$key]['qtd_sales'] = $qtdVendas;
                }
            }
        }
        
    }
    
}