<?php
// Подключаем модель BasketModel и создаём новый объект
    require_once 'app/models/BasketModel.php';
    $basketModel = new BasketModel();
?>

<header>
    <div class="container top-menu">
        <div class="nav">
            <a href="/">Главная</a>
            <a href="/contact">Контакты</a>
            <a href="/contact/about">Про компанию</a>
        </div>
        <div class="tel">
            <i class="fas fa-phone"></i> +7 943 341 64 34
        </div>
    </div>
    <div class="container middle">
        <div class="logo">
            <img src="/public/img/logo.svg" alt="Logo">
            <span>Мы знаем чего вы хотите!</span>
        </div>
        <div class="auth-checkout">
            <a href="/basket">

                <button class="btn basket">Корзина <b>(<?=$basketModel->countItems()?>)</b></button>
            </a><br>
            <!-- Если пользователь не авторизован, то выводим ссылки на авторизацию и
             регистрацию. Иначе выводим ссылку на личный кабинет пользователя -->
            <?php if($_COOKIE['login'] == ''):?>
                <a href="/user/auth">
                    <button class="btn auth">Войти</button>
                </a>
                <a href="/user/reg">
                    <button class="btn">Регистрация</button>
                </a>
            <?php else: ?>
                <a href="/user/dashboard">
                    <button class="btn dashboard">Кабинет пользователя</button>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="container menu">
        <ul>
            <li><a href="/categories">Все товары</a></li>
            <li><a href="/categories/shoes">Обувь</a></li>
            <li><a href="/categories/hats">Кепки</a></li>
            <li><a href="/categories/shirts">Футболки</a></li>
            <li><a href="/categories/watches">Часы</a></li>
        </ul>
    </div>
</header>