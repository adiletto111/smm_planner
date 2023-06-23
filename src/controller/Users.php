<?php

namespace App\Controller;

class Users
{
    public function run()
    {

        $db = \App\Service\DB::get();
        $stmt = $db->prepare("
            SELECT 
                *
            FROM
                `users`    
        ");
        $stmt->execute();

        $view = new \App\View\Users();
        $view->render([
            'title' => 'Пользователи',
            'data' => $stmt->fetchAll(),
        ]);
    }

    public function runAdd()
    {

        $validator = $this->getValidator();
        
        //var_dump($validator->check($_POST));
        
        //var_dump($validator->getMessages()); 

        if($_POST && $validator->check($_POST)){
            $db = \App\Service\DB::get();
            $stmt = $db->prepare("
                INSERT INTO
                    `users` (
                        `email`,
                        `password`,
                        `name`,
                        `privilege`
                    ) VALUES (
                        :email,
                        :password,
                        :name,
                        :privilege
                    )
            ");
            $stmt->execute([
                ':email' => $_POST['email'],
                ':password' => $_POST['password'],
                ':name' => $_POST['name'],
                ':privilege' => $_POST['privilege'],
            ]);
            header('Location: /users');
        }
        //return;
        $view = new \App\View\Users\Form();
        $view -> render([
            'title' => 'Создание нового пользователя',
            'data' => $_POST,
            'messages' => $validator->getMessages(),
        ]);
    }

    private function getValidator()
    {

        $validator = new \App\Service\Validator();
        $validator
            ->setRule('email', function($value){
                return preg_match('/^[^@]+@[^@]+$/', $value);
            }, 'Неправильный адрес электронной почты')
            ->setRule('name', function($value){
                return preg_match('/.{2,50}/', $value);
            }, 'Некорректно заполнено поле Имя!')
            ->setRule('password', function($value){
                return preg_match('/.{2,50}/', $value);
            }, 'Пороль должен быть длинной не менее 8 символов!')
            ->setRule('confirm-password', function($value, $data){
                return isset($data['password']) && $data['password'] === $value; 
            }, 'введенный пороль не соответствует оригиналу!')
            ->setRule('privilege', function($value){
                return in_array((int) $value, [0, 1]);
            }, 'Не верное значения привиления');

            return $validator;
        
    }
}