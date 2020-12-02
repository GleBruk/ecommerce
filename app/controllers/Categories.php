<?php


    class Categories extends Controller{
        public function index($page = 1){
            // Реализуем пагинацию
            $per_page = 3;// Кол-во товаров, которые будут размещаться на каждой странице
            // Если мы находимся на первой странице, то переменная $page присваивает нуль. Иначе $page
            // присваивает значение по формуле (($page - 1) * $per_page).
            $page = $page == 1 ? 0 : ($page - 1) * $per_page;
            //Определяем лимит для SQL запроса.
            $limit = $page.','.$per_page;

            // Вызываем модель Products
            $products = $this->model('Products');

            // Считаем кол-во страниц, на которых будут размещаться товары
            $pagesForPagination = ceil($products->countProducts() / $per_page);

            $data = [
                // Берём товары из БД с учетом лимита
                'products' => $products->getProductsLimited('id', $limit),
                'title' => 'Все товары на сайте',
                // Указываем кол-во страниц
                'pages' => $pagesForPagination
            ];
            // Вызываем шаблон и передаём данные
            $this->view('categories/index', $data);
        }
        public function shoes(){
            // Вызываем модель Products
            $products = $this->model('Products');
            // Берём из БД товары из категории shoes
            $data = ['products' => $products->getProductsCategory('shoes'), 'title' => 'Категория обувь'];
            // Вызываем шаблон и передаём данные
            $this->view('categories/index', $data);
        }

        public function hats(){
            // Вызываем модель Products
            $products = $this->model('Products');
            // Берём из БД товары из категории hats
            $data = ['products' => $products->getProductsCategory('hats'), 'title' => 'Категория кепки'];
            // Вызываем шаблон и передаём данные
            $this->view('categories/index', $data);
        }
        public function shirts(){
            // Вызываем модель Products
            $products = $this->model('Products');
            // Берём из БД товары из категории shirts
            $data = ['products' => $products->getProductsCategory('shirts'), 'title' => 'Категория футболки'];
            // Вызываем шаблон и передаём данные
            $this->view('categories/index', $data);
        }

        public function watches(){
            // Вызываем модель Products
            $products = $this->model('Products');
            // Берём из БД товары из категории watches
            $data = ['products' => $products->getProductsCategory('watches'), 'title' => 'Категория часы'];
            // Вызываем шаблон и передаём данные
            $this->view('categories/index', $data);
        }
    }
