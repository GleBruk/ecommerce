<?php

    require '../models/DB.php';

    $_db = DB::getInstance();

    $sql = 'INSERT INTO products(title, anons, text, img, price, category) VALUES(:title, :anons, :text, :img, :price, :category)';

    $query = $_db->prepare($sql);
    $query->execute(['title' => 'Новый продукт',
        'anons' => 'Часы которые носят самые крутые мужики.',
        'text' => 'Часы которые носят ещё более крутые мужики.',
        'img' => 'watch.jpg',
        'price' => 300,
        'category' => 'hats'

    ]);