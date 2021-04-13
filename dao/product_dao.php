<?php
    require_once('abstract_dao.php');
    require_once('./model/product.php');

    class EmployeeDAO extends AbstractDAO { 
        function __construct() {
            try{
                parent::__construct();
            } catch(mysqli_sql_exception $e){
                throw $e;
            }
        }  
        
        public function get_product($product_id){
            $query = 'SELECT * FROM products WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $product = false;
            if($result->num_rows == 1){
                $temp = $result->fetch_assoc();
                $product = new Product($temp['id'], $temp['name'], $temp['address'], $temp['salary']);
            }
            
            $result->free();
            return $product_id;
        }
    }
?>