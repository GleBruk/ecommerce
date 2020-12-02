<?php require 'public/blocks/header.php'?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Кабинет пользователя</title>
    <meta name="description" content="Кабинет пользователя">

    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/user.css" charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous" >
</head>
<body>
    <div class="container main">
            <h1>Кабинет пользователя</h1>
        <div class="user-info">
            <!-- Выводим логин пользователя -->
            <p>Привет, <b><?=$data['user']['login']?></b></p>

            <form action="/user/dashboard" method="post" enctype="multipart/form-data">
                <!-- Отображаем ошибки, которые поступают из массива data -->
                <p><?=$data['error']?></p>
                <input type="file" name="image_user">
                <button type="submit" class="btn">Загрузить</button>
            </form>

            <img src="/public/img/<?=$data['user']['img']?>">

            <form action="/user/dashboard" method="post">
                <input type="hidden" name="exit_btn">
                <button type="submit" class="btn">Выйти</button>
            </form>

        </div>
    </div>

<?php require 'public/blocks/footer.php'?>
</body>
</html>