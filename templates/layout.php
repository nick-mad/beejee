<!DOCTYPE html>
<html lang="ru">
<head>
    <title>BeeJee - tasks</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%;
        }

        body {
           background-color: #efefef;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="separator"></div>
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php if (!user_is_logged()) : ?>
                    <li>
                        <a href="/login">
                            <span class="glyphicon glyphicon-log-in"></span> Авторизация
                        </a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="/logout">
                            <span class="glyphicon glyphicon-log-out"></span> Выйти
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div id="content">
    <?= $this->section('content') ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>