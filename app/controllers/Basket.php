<?php
    class Basket extends Controller {
        public function index() {
            // Вызываем модель BasketModel
            $data = [];
            $cart = $this->model('BasketModel');

            // Если передаётся id товара, то добавляем его в корзину и в сессию
            if(isset($_POST['item_id']))
                $cart->addToCart($_POST['item_id']);

            // Если передаётся id товара для удаления, то товар удаляется из корзины и сессии
            if(isset($_POST['item_id_delete'])) {
                $cart = $this->model('BasketModel');
                $cart->deleteFromCart($_POST['item_id_delete']);
            }

            // Если пользователь нажал кнопку "Удалить все товары", то товары удаляются из корзины,
            // а также удаляется сессия
            if(isset($_POST['delete_all'])) {
                $cart = $this->model('BasketModel');
                $cart->deleteSession();
            }

            // Если сессия не установлена, то выводится сообщение "Пустая корзина". Иначе вызывается
            // модель Products и берутся товары из БД по указанным id в сессии
            if(!$cart->isSetSession())
                $data['empty'] = 'Пустая корзина';
            else {
                $products = $this->model('Products');
                $data['products'] = $products->getProductsCart($cart->getSession());
            }

            // Вызываем шаблон и передаём данные
            $this->view('basket/index', $data);
        }
    }