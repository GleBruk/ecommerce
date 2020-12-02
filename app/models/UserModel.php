<?php
    require 'DB.php';

    class UserModel{
        private $login;
        private $email;
        private $pass;
        private $re_pass;

        private $_db = null;

        public function __construct(){
            // Подключаемся к БД
            $this->_db = DB::getInstance();
        }
        public function setData($login, $email, $pass, $re_pass){
            // Устанавливаем данные из контроллера
            $this->login = $login;
            $this->email = $email;
            $this->pass = $pass;
            $this->re_pass = $re_pass;
        }

        public function validForm(){
            // Проводим валидацию

            $check_user = $this->checkUser($this->email);

            if(strlen($this->login) < 3){
                return "Имя слишком короткое";
            } else if (strlen($this->email) < 3)
                return "Email слишком короткий";
            else if($check_user['email'] != '')
                return "Данный email уже занят";
            else if (strlen($this->pass) < 3)
                return "Пароль не менее 3 символов";
            else if ($this->pass != $this->re_pass)
                return "Пароли не совпадают";
            else
                return "Верно";
        }

        public function addUser(){
            // Добавляем пользователя в БД

            $sql = 'INSERT INTO users(login, email, pass, img) VALUES (:login, :email, :pass,
 :img)';
            $query = $this->_db->prepare($sql);

            $pass = password_hash($this->pass, PASSWORD_DEFAULT);

            $query->execute(['login' => $this->login, 'email' => $this->email,
                'pass' => $pass, 'img' => 'noimage.jpg']);

            // Устанавливаем куки и переадресовываем в личный кабинет пользователя
            $this->setAuth($this->email);
        }

        public function checkUser($email){
            // Возвращаем данные пользователя из БД по email указанному в аргументе в виде
            // одномерного массива
            $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function getUser(){
            // Возвращаем данные пользователя из БД по email взятому из куки, в виде
            // одномерного массива
            $email = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function logOut(){
            // Удаляем элемент login из куки и переадресовываем пользователя на авторизацию
            setcookie('login', $this->email, time() - 3600, '/');
            unset($_COOKIE['login']);
            header('Location: /user/auth');
        }

        public function auth($email, $pass){
            //Берём данные пользователя из БД по указанному в форме email, в виде одномерного
            // массива
            $user = $this->checkUser($email);

            // Проверяем введённые пользователем данные. Если данные введены верно, то
            // устанавливаем куки и переадресовываем пользователя в личный кабинет. Иначе
            // выводим ошибку
            if($user['email'] == '')
                return 'Пользователя с таким email не существует';
            else if(password_verify($pass, $user['pass'])) {
                $this->setAuth($email);
            }
            else
                return 'Пароли не совпадают';
        }

        public function setAuth($email){
            //Устанавливаем куки и переадресовываем пользователя в личный кабинет.
            setcookie('login', $email, time() + 3600 * 24 * 7, '/');
            header('Location: /user/dashboard');
        }

        public function addFotoToUser($filename) {
            // Обновляем поле с фото для пользователя с определенным email
            $sql = "UPDATE `users` SET `img` = :image WHERE `email` = :email";
            $query = $this->_db->prepare($sql);

            // В качестве image указываем имя файла, который мы загрузили.
            // В качестве email указываем тот что находится в куки.
            $query->execute(['image' => $filename, 'email' => $_COOKIE['login']]);
        }

        public function getUserPhoto(){
            // Берём данные пользователя из БД по email в виде одномерного массива и возвращаем
            // название фото
            $user = $this->checkUser($_COOKIE['login']);
            return $user['img'];
        }
    }