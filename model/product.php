<?php
    class Product {
        private $id;
        private $title;
        private $description;
        private $price;
        private $is_featured;
                
        function __construct($id, $title, $description, $price, $is_featured){
            $this->setId($id);
            $this->setName($name);
            $this->setAddress($address);
            $this->setSalary($salary);
        }		
        
        public function get_id(){
            return $this->id;
        }
        
        public function set_id($id){
            $this->id = $id;
        }

        public function get_title() {
            return $this->title;
        }

        public function set_title($title) {
            $this->title = $title;
        }

        public function get_description() {
            return $this->description;
        }

        public function set_description($description) {
            $this->description = $description;
        }

        public function get_price() {
            return $this->price;
        }

        public function set_price($price) {
            $this->price = $price;
        }

        public function get_is_featured() {
            return $this->is_featured;
        }

        public function set_is_featured($is_featured) {
            $this->is_featured = $is_featured;
        }
    }
?>