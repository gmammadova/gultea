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

        public function get_all() {
            $query = 'SELECT * FROM products';
            $stmt = $this->mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            $final_result = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $images_result = $this->mysqli->query('SELECT CONCAT("images/products/", id, ".", extension) FROM images WHERE product_id=' . $row['id']);
                    $row['images'] = $images_result->fetch_all();
                    $images_result->free();

                    $reviews_result = $this->mysqli->query('SELECT rating FROM reviews WHERE product_id=' . $row['id']);
                    $row["reviews"] = $reviews_result->fetch_all();
                    $reviews_result->free();

                    array_push($final_result, $row);
                }
            }

            $result->free();

            return $final_result;
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

        public function create_image($product_id, $name, $extension) {
            $query = 'INSERT INTO images (name, extension, product_id) VALUES (?, ?, ?)';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('ssi', $name, $extension, $product_id);
            $stmt->execute();
            $stmt->close();

            return $this->mysqli->insert_id;
        }
        public function create_product($title, $description, $price, $is_featured) {
            $query = 'INSERT INTO products (title, description, price, is_featured) VALUES (?, ?, ?, ?)';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('ssdi', $title, $description, $price, $is_featured);
            $stmt->execute();
            $stmt->close();

            return $this->mysqli->insert_id;
        }
    }
?>