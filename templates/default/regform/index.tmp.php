<?echo User::$error;?>
<form name="reg_user_form" class="reguserform" method="post">
    <input type="text" name="name" placeholder="Логин">
    <input type="password" name="password" placeholder="Пароль">
    <input type="password" name="passwordr" placeholder="Повторите пароль">
    <input type="submit" name="reg_user" value="Зарегистрироваться">
</form>