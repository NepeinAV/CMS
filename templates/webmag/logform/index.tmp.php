<?echo User::$error;?>
<form name="logform" class="post-reply" method="POST" style="margin-bottom:20px;">
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
                <input type="password" name="password" class="input" placeholder="Пароль">
            </div>
        </div>
    </div>
    <input type="hidden" name="redirect_url" value="<?echo $_SERVER['REQUEST_URI']?>">
    <input type="submit" name="signin" class="primary-button" value="Войти">
</form>
<a href="/registration/">Зарегистрироваться</a>
