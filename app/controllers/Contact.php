<?php
     class Contact extends Controller {
         public function index(){

         // Если передаются данные через форму, то вызываем модель Contact
         // и устанавливаем туда данные
             $data = [];
             if (isset($_POST['name'])){
                 $mail = $this->model('ContactModel');
                 $mail->setData($_POST['name'], $_POST['email'],
                    $_POST['age'], $_POST['message']);

                 // Делаем валидацию. Если данные заполнены корректно, то
                 // отправляем письмо, иначе выводим ошибку
                 $isValid = $mail->validForm();
                 if($isValid == "Верно")
                     $data['message'] = $mail->mail();
                 else
                     $data['message'] = $isValid;
             }

             // Вызываем шаблон и передаём данные
             $this->view("contact/index", $data);
         }

         public function about($param = '') {
         //Вызываем шаблон about и передаём параметр
             $data = ['param' => $param];
             $this->view('contact/about', $data);
         }
     }