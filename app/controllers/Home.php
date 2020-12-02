<?php
    class Home extends Controller {
        public function index() {
            // Вызываем модель Products
            $products = $this->model('Products');

            // Вызываем шаблон и передаём данные 5 товаров
            $this->view('home/index', $products->getProductsLimited("id", "5"));
        }
    }