<?if (!User::isUserSignedIn()):?>
    <section class="logform">
        <?echo User::$error;?>
        <form name="logform" method="POST" action="/" style="margin-bottom: 10px;">
            <input type="text" name="name" placeholder="Логин">
            <input type="password" name="password" placeholder="Пароль">
            <input type="hidden" name="redirect_url" value="<?echo $_SERVER['REQUEST_URI']?>">
            <input type="submit" name="signin" value="Войти">
        </form>
        <a href="/pages/registration/">Зарегистрироваться</a>
    </section>
<?else:
    echo Template::addTmp('profile', 'logform');
endif;?>