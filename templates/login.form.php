<?php $this->layout('site::layout'); ?>
<div class="container">
    <div class="col-sm-4 col-sm-offset-4">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><strong>Ошибка:</strong><br/><?php $this->escape($error); ?></div>
        <?php endif; ?>
        <div class="panel panel-primary panel-login">
            <div class="panel-heading"><h3 class="panel-title"><strong>Авторизация</strong></h3></div>
            <div class="panel-body">
                <form id="login_form" action="/login" method="post">
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input type="text" class="form-control" id="login" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>