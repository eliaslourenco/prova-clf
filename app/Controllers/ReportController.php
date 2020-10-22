<?php

namespace app\Controllers;

use app\Models\Customer;
use app\Models\Sales;
use app\Models\Salesman;

class ReportController
{
    
    private $objModelSales;
    private $objModelCustomer;
    private $objModelSalesman;
    private $answers;

    public function __construct() 
    {
        $this->objModelCustomer = new  Customer();
        $this->objModelSalesman = new  Salesman();
        $this->objModelSales = new  Sales();
    }

    /**
     * Responsavel por retornar a saida que sera gravada como relatorio
     */
    public function get() 
    {
        return $this->answers();
        
    }

    /***
     * Carrega e retorna as repostas solicitadas pelo relatorio
     * 
     */
    public function answers()
    {
        // quantidade de clientes 
        $this->answers['qtd_customers'] = $this->getQtdCustomers();
        // Qtd de vendedores
        $this->answers['qtd_salesman'] = $this->getQtdSalesman();
        // média salarial dos vendedore
        $this->answers['mean_salary'] = $this->getMeanSalary();
        // ID da venda mais cara
        $this->answers['more_expensive_sale'] = $this->getMoreExpensiveSale();
        // o pior vendedor
        $this->answers['worst_salesman'] = $this->getWorstSalesman();
       
        return $this->answersToStr();

    }


    public function getQtdCustomers()
    {
        return $this->objModelCustomer->total();
    }
    public function getQtdSalesman()
    {
        return $this->objModelSalesman->total();
    }
    public function getMeanSalary()
    {
        return $this->objModelSalesman->meanSalary();
    }
    public function getMoreExpensiveSale()
    {
        return $this->objModelSales->moreExpensiveSale();
    }
    public function getWorstSalesman()
    {
        return $this->objModelSalesman->WorstSalesman();
    }

    public function answersToStr()
    {
        return
"
Quantidade de Clientes: ". $this->answers['qtd_customers']."
Quantidade de Vendedores: ".$this->answers['qtd_salesman']."
Média Salarial dos Vendedores: R$".str_replace('.', ',', round($this->answers['mean_salary'],2))."
ID da venda mais cara: ".$this->answers['more_expensive_sale']['id_sale']."
Pior Vendedor foi o : ".$this->answers['worst_salesman']['name']." que vendeu apenas o valor de R$" . str_replace('.', ',', $this->answers['worst_salesman']['total_sales']);        
        
    }
    
}