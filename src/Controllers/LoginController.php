<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use League\Plates\Engine;

class LoginController
{
    public function loginForm(Engine $template)
    {
        if (user_is_logged()) {
            redirect('/');
        }

        $html = $template->render(
            'site::login.form'
        );

        (new Response($html))->send();
    }

    public function login(Engine $template)
    {
        if (user_is_logged()) {
            redirect('/');
        }

        $request = Request::createFromGlobals();
        $login = $request->get('login');
        $password = $request->get('password');

        $error = [];

        if ($login === 'admin' && $password === '123') {
            $_SESSION['logged_user'] = true;
            redirect('/');
        } elseif ($login === null || $password === null) {
            $error = 'Поля логина и пароля обязательны для заполнения';
        } else {
            $error = 'Логин или пароль неверны';
        }

        $html = $template->render('site::login.form', ['error' => $error]);

        (new Response($html))->send();
    }

    public function logout()
    {
        unset($_SESSION['logged_user']);
        setcookie('rememberme', '', time() - 3600, '/');
        session_destroy();
        redirect('/');
    }
}
