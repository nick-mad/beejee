<?php $this->layout('site::layout'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1>Список задач</h1>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-labeled btn-success pull-right" style="margin-top: 20px;"
                    onclick="location.href='/add';">
                <span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Добавить задачу
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?= $this->escape($message) ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-12">
            <?php if (!empty($tasks) && count($tasks)) : ?>
                <div class="table-responsive">
                    <table id="table-list" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                <a href="?<?= $orderName ?>">имя пользователя</a>
                                <span class="glyphicon glyphicon-sort-by-alphabet"></span>
                            </th>
                            <th>
                                <a href="?<?= $orderEmail ?>">email</a>
                                <span class="glyphicon glyphicon-sort-by-alphabet"></span>
                            </th>
                            <th>текст задачи</th>
                            <th>
                                <a href="?<?= $orderStatus ?>">статус</a>
                                <span class="glyphicon glyphicon-sort-by-alphabet"></span>
                            </th>
                            <?php if (user_is_logged()) : ?>
                                <th>действие</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= $this->escape($task->name) ?></td>
                                <td><?= $this->escape($task->email) ?></td>
                                <td><?= $this->escape($task->text) ?></td>
                                <td>
                                    <?= $task->status ? '<span class="label label-success">выполнено</span>' : '<span class="label label-default">не выполнено</span>' ?>
                                    <?= $task->edit_admin ? '<br><span class="label label-warning">отредактировано администратором</span>' : '' ?>
                                </td>
                                <?php if (user_is_logged()) : ?>
                                    <td><a href="/edit/<?= $this->escape($task->id) ?>">редактировать</a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($pagination['needed']) : ?>
                    <ul class="pagination ">
                        <?php for ($i = 1; $i <= $pagination['last_page']; $i++): ?>
                            <li><a class="<?= $i == $pagination['page'] ? 'active' : '' ?>"
                                   href="?page=<?= $i . ($pagination['href'] ? '&' . $pagination['href'] : '') ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                <?php endif; ?>
            <?php else: ?>
                <p>Список задач пуст</p>
            <?php endif; ?>
        </div>
    </div>
</div>