<?php
namespace store\Entities;

use Connect as Db;
use Dompdf;

class Order {

    private $ref;
    private $items = [];
    private $tbl = 'pedidos';
    private $joinProduct = 'pedidos_articulos';
    private $product = 'articles';

    public function __construct($ref)
    {
        $this->ref = $ref;
    }

    public function getOrder()
    {

        $sql = "SELECT $this->product.ref as prodRef, 
                $this->product.art_name as proName, 
                $this->joinProduct.unidades as amount,
                $this->joinProduct.precio as prodPrice
                  
                FROM  $this->tbl
                INNER JOIN $this->joinProduct
                INNER JOIN $this->product
                ON $this->tbl.ref = $this->joinProduct.ref 
                
                WHERE $this->tbl.ref= $this->ref 
                AND $this->product.artid = $this->joinProduct.artid" ;
        $conn = new Connect();
        $result = $conn->query($sql);
            //if (!$result)
        if (!$result){
            return FALSE;
        }

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;

    }

    /**
     * @param $ref
     */
    public function getCustomer(){
        $sql = "SELECT * FROM  $this->tbl
              
                WHERE $this->tbl.ref= $this->ref LIMIT 1" ;
        $conn = new Connect();
        $result = $conn->query($sql);
        //if (!$result)
        if (!$result){
            return FALSE;
        }

        return $result->fetch_assoc();

    }
    public function setOrder($ref)
    {

    }


}
