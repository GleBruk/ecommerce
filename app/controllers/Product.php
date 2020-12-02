<?php
    class Product extends Controller{
        //Выводим на отдельной странице шаблон товара, выбранного пользователем
        public function index($id){
            //Вызываем модель контроллера Products
            $product = $this->model('Products');
            //Вызываем шаблон выбранного товара и передаём его данные из БД
            $this->view('product/index', $product->getOneProduct($id));
        }
    }