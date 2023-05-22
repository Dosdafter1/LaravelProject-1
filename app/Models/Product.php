<?php
    namespace App\Models;
    class Product {
        public string $name;
        public float $price;
        public static function SaveProductToFile($products){
            $json = json_encode($products, JSON_PRETTY_PRINT);
            file_put_contents(__DIR__.'\products.json', $json);
        }
        public static function GetAllProductsFromFiles(){
            $json = file_get_contents(__DIR__.'\products.json');
            $data = json_decode($json, true); 
            return $data;
        }
        public static function GetProductsFromFilesByName($s){
            $data = Product::GetAllProductsFromFiles();
            if($data!=null)
            {
            $filteredProducts = array_filter($data,
                        function($prod) use($s){
                            return str_contains(strtolower($prod['name']),strtolower($s));
            });
            $res =[];
            foreach($filteredProducts as $c)
            {
                $res[]=$c;
            }
            return $res;
            }
            return null;
        }
    }
 ?>