<?php


class User extends Controller {

    public function reg(){

        $data = [];
        // Если передаются данные из формы, то вызываем модель UserModel и устанавливаем туда
        // данные
        if(isset($_POST['name'])){
            $user = $this->model('UserModel');
            $user->setData($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);

            //Проводим валидацию. Если форма заполнена корректно, то добавляем пользователя в БД.
            // Иначе выводим ошибку
            $isValid = $user->validForm();
            if($isValid == "Верно")
                $user->addUser();
            else
                $data['message'] = $isValid;
        }

        //Вызываем шаблон и передаём данные
        $this->view('user/reg', $data);
    }

    public function dashboard() {

        // Вызываем модель UserModel и устанавливаем данные пользователя для передачи в шаблон
        $user = $this->model('UserModel');
        $data = ['user' => $user->getUser()];

        // Если пользователь нажал кнопку 'Выйти', то удаляем элемент login из куки и
        // переадресовываем пользователя на авторизацию
        if(isset($_POST['exit_btn'])) {
            $user->logOut();
            exit();
        }

        // Если передаются данные для загрузки фото, то работаем с этим фото
        if(isset($_FILES['image_user'])) {
            // Получаем расширение фото. Обрезаем фото по символу "."
            $ext = substr(
                $_FILES['image_user']['name'], strpos($_FILES['image_user']
                ['name'], '.'),
                strlen($_FILES['image_user']['name']) - 1
            );
            // Создаем новое имя для фото
            $filename = time().$ext;
            // Указываем папку в которую все будет загружено
            $uploaddir = __DIR__.'/../../public/img/';

            // Указываем имя и папку файла в одну переменную
            $file = $uploaddir . basename($filename);

            $maxsize = 524288; // Максимальный размер 500 КБ
            if($_FILES['image_user']['name'] == '') // Если файл не был указан, то выводим ошибку
                $data['error'] = 'Вы не указали файла для загрузки';
            // Если размер больше или равен 0, то выводим ошибку
            else if(($_FILES['image_user']['size'] >= $maxsize) || ($_FILES["image_user"]["size"]
                    == 0))
                $data['error'] = "Файл слишком большой. Максимум <b>500 КБ</b>";
            else {
                // Загружаем фото в папку проекта через move_uploaded_file
                move_uploaded_file($_FILES['image_user']['tmp_name'], $file);

                // Добавляем название фото в БД к пользователю
                $user->addFotoToUser($filename);

                // Еще раз получаем данные пользователя из БД для передачи в шаблон
                $data['user'] = $user->getUser();
            }
        }

        // Вызываем шаблон и передаём данные
        $this->view('user/dashboard', $data);
    }

    public function auth(){

        $data = [];
        // Если передаются данные из формы, то вызываем модель UserModel и проверяем
        // введённые данные
        if(isset($_POST['email'])){
            $user = $this->model('UserModel');
            $data['message'] = $user->auth($_POST['email'], $_POST['pass']);
        }

        //Вызываем шаблон и передаём данные
        $this->view('user/auth', $data);
    }
}