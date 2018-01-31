<section class="logform">
    <?if(!User::isUserSignedIn()):?>
        <form name="logform" method="POST" action="/">
            <input type="text" name="name" placeholder="Логин">
            <input type="password" name="password" placeholder="Пароль">
            <input type="submit" name="signin" value="Войти">
        </form>
        <?else:?>
            Hello,
            <?echo User::getCurrUserField('name');?> |
                <a href="/logout/">Выйти</a>
                <?endif;?>
</section>