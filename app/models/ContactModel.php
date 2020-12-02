<?php
    class ContactModel {
        private $name;
        private $email;
        private $age;
        private $message;

        public function setData($name, $email, $age, $message){
        // Устанавливаем данные из контроллера
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->message = $message;
        }

        public function validForm(){
        // Проводим валидацию
            if(strlen($this->name) < 3){
                return "Имя слишком короткое";
            } else if (strlen($this->email) < 3)
                return "Email слишком короткий";
            else if (!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
                return "Вы ввели не возраст";
            else if (strlen($this->message) < 10)
                return "Сообщение слишком короткое";
            else
                return "Верно";
        }

        public function mail(){
            // Указываем адрес получателя
            $to = "gleb-ruksha@rambler.ru";
            // Создаём сообщение
            $message = "Имя: " . $this->name . ". Возраст: " . $this->age . ". Сообщение: "
                . $this->message;

            // Указываем тему
            $subject = "=?utf-8?B?".base64_encode("Сообщение с нашего сайта")."?";
            // Указываем адрес отправителя
            $headers = "From: $this->email\r\nReply-to: $this->email\r\nContent-type: text/html;
             charset=utf-8\r\n";
            // Отправляем сообщение
            $success = mail($to, $subject, $message, $headers);

            // Если сообщение не отправилось, то выводим ошибку. Иначе возвращаем true
            if(!$success)
                return "Сообщение не было отправлено";
            else
                return true;
        }

    }