<?php $this->layout('site::layout'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Редактирование задачи</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="/edit/<?= $this->escape($task->id) ?>" method="post" enctype="multipart/form-data">
                <div class="checkbox">
                    <label><input type="checkbox" name="status" value="1" <?= $task->status ? 'checked' : '' ?>>Выполнено</label>
                </div>
                <div class="form-group">
                    <label for="name">Имя пользователя:</label>
                    <input type="text" class="form-control" id="email" name="name"
                           value="<?= $this->escape($task->name) ?>" disabled="disabled">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"
                           value="<?= $this->escape($task->email) ?>" disabled="disabled">
                </div>
                <div class="form-group">
                    <label for="text">Текст задачи:</label>
                    <textarea class="form-control" rows="5" id="text"
                              name="text"><?= $this->escape($task->text) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button class="btn btn-default" onclick="location.href='/';">Отмена</button>
            </form>
        </div>
    </div>
</div>
