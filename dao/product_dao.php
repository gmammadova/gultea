<?php
    require_once('abstract_dao.php');
    require_once('./model/product.php');

    class ProductDAO extends AbstractDAO {
        function __construct() {
            try{
                parent::__construct();
            } catch(mysqli_sql_exception $e){
                throw $e;
            }
        }  
        
        public function get_product($product_id) {
            $query = 'SELECT * FROM products WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $product = false;
            if($result->num_rows == 1){
                $temp = $result->fetch_assoc();
                $product = new Product($temp['id'], $temp['title'], $temp['description'], $temp['price'], $temp['is_featured']);
            }
            
            $result->free();
            return $product_id;
        }

        public function create_image($product_id, $name) {
            $query = 'INSERT INTO images (name, product_id) VALUES (?, ?)';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('si', $name, $product_id);
            $stmt->execute();
            $stmt->close();

            return $this->mysqli->insert_id;
        }
        public function create_product($title, $description, $price, $is_featured) {
            $query = 'INSERT INTO products (title, description, price, is_featured) VALUES (?, ?, ?, ?)';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('ssii', $title, $description, $price, $is_featured);
            $stmt->execute();
            $stmt->close();

            return $this->mysqli->insert_id;
        }
    }
?>