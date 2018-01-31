<section class="logform">
    <?if(!User::isUserSignedIn()):?>
        <form name="logform" method="POST" action="/">
            <input type="text" name="name" placeholder="Логин">
            <input type="password" name="password" placeholder="Пароль">
            <input type="submit" name="signin" value="Войти">
        </form>
        <a href="/pages/registration/">Зарегистрироваться</a>
        <?else:?>
            Hello,
            <?print(User::getCurrUserData('name'));?> |
                <a href="/logout/">Выйти</a>
                <?endif;?>
</section>