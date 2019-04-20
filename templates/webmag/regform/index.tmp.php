<?echo User::$error;?>
<form name="reg_user_form" class="post-reply" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="name" class="input" placeholder="Логин">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="password" class="input" placeholder="Пароль">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="passwordr" class="input" placeholder="Повторите пароль">
            </div>
        </div>
    </div>
    <input type="submit" name="reg_user" class="primary-button" value="Зарегистрироваться">
</form>