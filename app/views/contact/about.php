<?php require 'public/blocks/header.php'?>

<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Страница про компанию</title>
        <meta name="description" content="Страница про компанию">

        <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous" >
    </head>
    <body>
        <div class="container main">
            <h1>Про компанию</h1>
            <p>Здесь просто текст про компанию</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur, eaque eligendi
                minima minus molestiae mollitia quod. Ab, amet culpa esse est excepturi harum itaque,
                praesentium quas quos, reprehenderit repudiandae?</p>
            <!-- Проверяем есть ли параметр -->
            <?php if($data['param'] != ''): ?>
                <br><br>
                <!-- Если есть дополнительный параметр, то выводим его -->
                <h2>Есть дополнительный параметр</h2>
                <p>Данные из URL: <b><?=$data['param']?></b></p>
            <?php endif; ?>
        </div>

        <?php require 'public/blocks/footer.php'?>
    </body>
</html>