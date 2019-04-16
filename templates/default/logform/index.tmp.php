<?if (!User::isUserSignedIn()):?>
    <section class="logform">
        <form name="logform" method="POST" action="/">
            <input type="text" name="name" placeholder="Логин">
            <input type="password" name="password" placeholder="Пароль">
            <input type="submit" name="signin" value="Войти">
        </form>
        <a href="/pages/registration/">Зарегистрироваться</a>
    </section>
<?else:
    echo Template::addTmp('profile', 'logform');
endif;?>