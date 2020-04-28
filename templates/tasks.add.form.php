<?php $this->layout('site::layout'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Добавление задачи</h1>
        </div>
    </div>
    <?php if (isset($errors) && $errors): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <strong>Внимательно проверьте форму на ошибки!</strong>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <form action="/add" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Имя пользователя:</label>
                    <input type="text" class="form-control" id="email" name="name"
                           value="<?= $this->escape($task->name) ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"
                           value="<?= $this->escape($task->email) ?>">
                </div>
                <div class="form-group">
                    <label for="text">Текст задачи:</label>
                    <textarea class="form-control" rows="5" id="text"
                              name="text"><?= $this->escape($task->text) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
</div>
