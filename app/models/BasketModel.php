<?php
    session_start();

    class BasketModel{
        private $session_name = 'cart';

        public function isSetSession(){
            // Проверяем, установлена ли сессия
            return isset($_SESSION[$this->session_name]);
        }

        public function getSession(){
            // Устанавливаем сессию
            return $_SESSION[$this->session_name];
        }

        public function addToCart($itemID){
            // Если сессия не установлена, то она принимает значение id товара. Иначе добавляем id
            // товара в сессию
            if(!$this->isSetSession())
                $_SESSION[$this->session_name] = $itemID;
            else{
                // Делим сессию по знаку ","
                $items = explode(",", $_SESSION[$this->session_name]);

                $itemExists = false;
                // Перебираем массив с id товаров и сравниваем с id товара выбранного пользователем
                foreach ($items as $el){
                    if($el == $itemID)
                        $itemExists = true;
                }

                // Если выбранного товара ещё нет в корзине, то он туда добавляется
                if (!$itemExists)
                    $_SESSION[$this->session_name] =  $_SESSION[$this->session_name].','.$itemID;
            }
        }

        public function countItems(){
            // Если сессия не установлена, то возвращаем нуль. Иначе делим сессию по знаку "," и
            // считаем кол-во товаров
            if(!$this->isSetSession())
                return 0;
            else{
                $items = explode(",", $_SESSION[$this->session_name]);
                return count($items);
            }
        }

        public function deleteSession(){
            // Удаляем сессию
            unset($_SESSION[$this->session_name]);
        }

        public function deleteFromCart($itemID){
            // Делим сессию по знаку ","
            $items = explode(",", $_SESSION[$this->session_name]);

            // Если в корзине всего один товар, то удаляем сессию
            if(count($items) == 1) {
                $this->deleteSession();
                return;
            }

            // Перебираем массив с товарами через цикл.
            $new_items = [];
            foreach ($items as $el) {
                // Если id товара не равно id товара удаляемого пользователем, то id товара
                // добавляется в другой массив. Таким образом удаляемый товар не будет добавлен
                // в новый массив
                if($el != $itemID)
                    array_push($new_items, $el);
            }

            // Сессия присваивает значение нового массива собранного в одну строку
            $_SESSION[$this->session_name] = implode($new_items, ",");
        }

        public function deleteAllFromCart(){
            //Удаляем сессию
            unset($_SESSION[$this->session_name]);

            //Устанавливаем новую сессию
            $this->getSession();
        }
    }