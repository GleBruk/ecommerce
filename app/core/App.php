<?php
    class App{
        // Данные переменные присвоят значения контроллера, метода и параметры указанные
        // пользователем в url
        protected $controller = 'Home';
        protected $method = 'index';
        protected $params = [];

        public function __construct(){
            // Получаем введённый пользователем url в виде массива
            $url = $this->parseUrl();

            // Если существует указанный пользователем в url контроллер, то переменная
            // $controller присвоит его значение переведя первый символ в верхний регистр,
            // а из массива url удаляется элемент с названием контроллера
            if(file_exists('app/controllers/' . ($url[0]) . '.php')){
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }

            // Подключаем указанный пользователем контроллер. Если контроллер не был
            // указан, то подключается контроллер Home. Затем переменную $controller
            // делаем новым объектом подключенного контроллера
            require_once 'app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;

            // Если существует указанный пользователем в url метод, то переменная
            // $method присвоит его значение, а из массива url удаляется элемент
            // с названием метода
            if(isset($url[1])){
                if(method_exists($this->controller, $url[1])){
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }

            // Если $url не является пустым массивом, то $params принимает его значение
            // обнулив индексы
            $this->params = $url ? array_values($url) : [];

            // Если указаны соответствующие контроллеры, методы и число параметров
            // меньше/равно единицы, то url считается корректным
            $correctUrl = false;
            if(is_a($this->controller, 'Contact') &&
                $this->method == 'about' &&
                count($this->params) <= 1)
                $correctUrl = true;

            if(is_a($this->controller, 'Product') &&
                count($this->params) <= 1)
                $correctUrl = true;

            if(is_a($this->controller, 'Categories') &&
                $this->method == 'index' &&
                count($this->params) <= 1)
                $correctUrl = true;

            // Если url считается некорректным и число параметров не равно нулю,
            // то вызывается страница ошибки
            if(count($this->params) != 0 && !$correctUrl)
                $this->errorPage404();

            // Вызываем метод внутри класса и передаём параметры
            call_user_func_array([$this->controller, $this->method],
                $this->params);
        }

        public function parseUrl() {
            // Берём введёный пользователем url, делим его по знаку "/" и возвращаем
            // в виде массива
            if(isset($_GET['url'])){
                return explode('/', filter_var(
                    rtrim($_GET['url'], '/'),
                    FILTER_SANITIZE_STRING
                ));
            }
        }

        public function errorPage404() {
            $host = '/404.php';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location: '.$host);
        }
    }