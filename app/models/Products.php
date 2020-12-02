<?php
require 'DB.php';

class Products {
    private $_db = null;

    public function __construct() {
    // Подключаемся к БД
        $this->_db = DB::getInstance();
    }

    public function getProducts() {
    // Берём все товары из БД и возвращаем в виде двумерного массива
        $result = $this->_db->query("SELECT * FROM `products` 
    ORDER BY `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProducts() {
    // Считаем кол-во товаров в БД
        $result = $this->_db->query("SELECT `id` FROM `products`");
        return count($result->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getProductsLimited($order, $limit) {
    // Берём указанное в аргументе число товаров, сортируя по указанному в аргументе
    // признаку и возвращаем в виде двумерного массива
        $result = $this->_db->query("SELECT * FROM `products` ORDER BY 
    $order DESC LIMIT $limit");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsCategory($category) {
    // Берём все товары из указанной в аргументе категории и возвращаем в виде
    // двумерного массива
        $result = $this->_db->query("SELECT * FROM `products` 
    WHERE `category` = '$category' ORDER BY `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneProduct($id) {
    //Берём данные товара указанного в аргументе и возвращаем в виде одномерного массива
        $result = $this->_db->query("SELECT * FROM `products` 
    WHERE `id` = '$id'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductsCart($items) {
    //Берём данные товаров по указанным id в аргументе и возвращаем
    // в виде двумерного массива
        $result = $this->_db->query("SELECT * FROM `products` 
    WHERE `id` IN ($items)");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}