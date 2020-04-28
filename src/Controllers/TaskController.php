<?php

namespace App\Controllers;

use App\Models\Task;
use League\Plates\Engine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{
    public function showTasks(Engine $template)
    {
        $request = Request::createFromGlobals();
        $page = ($request->get('page', 0) > 0) ? $request->get('page') : 1;
        $limit = 3;
        $skip = ($page - 1) * $limit;
        $count = Task::count();

        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');
        $param = [];
        if ($request->query->has('sort')) {
            $param['sort'] = $sort;
        }
        if ($request->query->has('order')) {
            $param['order'] = $order;
        }
        $message = '';
        if (!empty($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $html = $template->render(
            'site::tasks.list',
            [
                'pagination' => [
                    'needed' => $count > $limit,
                    'count' => $count,
                    'page' => $page,
                    'last_page' => (ceil($count / $limit) == 0 ? 1 : ceil($count / $limit)),
                    'limit' => $limit,
                    'href' => http_build_query($param)
                ],
                'orderName' => http_build_query(['page' => $page, 'sort' => 'name', 'order' => $sort !== 'name' ? 'asc' : ($order === 'asc' ? 'desc' : 'asc')]),
                'orderEmail' => http_build_query(['page' => $page, 'sort' => 'email', 'order' => $sort !== 'email' ? 'asc' : ($order === 'asc' ? 'desc' : 'asc')]),
                'orderStatus' => http_build_query(['page' => $page, 'sort' => 'status', 'order' => $sort !== 'status' ? 'asc' : ($order === 'asc' ? 'desc' : 'asc')]),
                'tasks' => Task::skip($skip)->take($limit)->orderBy($sort, $order)->get(),
                'message' => $message
            ]
        );

        (new Response($html))->send();
    }

    public function addTasks(Engine $template)
    {
        $task = new Task();
        $errors = [];

        if ($_POST) {
            $request = Request::createFromGlobals();
            $name = $request->get('name');
            $email = $request->get('email');
            $text = $request->get('text');

            if (empty($name)) {
                $errors[] = 'Укажите имя пользователя';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Укажите валидный email';
            }
            if (empty($text)) {
                $errors[] = 'Укажите текст задачи';
            }

            $task->name = $name;
            $task->email = $email;
            $task->text = $text;

            if (!$errors) {
                $task->save();
                $_SESSION['message'] = 'Задача успешно добавлена!';
                redirect('/');
            }
        }

        $html = $template->render(
            'site::tasks.add.form',
            [
                'task' => $task,
                'errors' => $errors
            ]
        );

        (new Response($html))->send();
    }

    public function editTasks(Engine $template, $id)
    {
        if (!user_is_logged()) {
            redirect('/');
        }

        try {
            $task = Task::findOrFail($id);
        } catch (\Exception $exception) {
            redirect('/');
        }

        $errors = [];

        if ($_POST) {
            $request = Request::createFromGlobals();
            $text = $request->get('text');
            $status = $request->get('status', 0);
            if ($task->text !== $text) {
                $task->edit_admin = 1;
            }
            $task->status = $status;
            $task->text = $text;

            $task->save();
            redirect('/');
        }

        $html = $template->render(
            'site::tasks.edit.form',
            [
                'task' => $task,
                'errors' => $errors
            ]
        );

        (new Response($html))->send();
    }
}
