<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>
        <?print(Modules::getModuleTitle());?> - Регистрация
    </title>
    <link rel="stylesheet" href="/templates/default/news/css/style.css" />
    <script src="/templates/default/news/js/script.js"></script>
</head>

<body>

    <?echo Template::addTmp('header', 'news');?>

        <?echo Template::addTmp('menu', 'news');?>
            <div class="flex_c wrap">
                <main>
                    <h1>Регистрация</h1>
                    <?echo User::$error;?>
                    <form name="reg_user_form" class="reguserform" method="post">
                        <input type="text" name="name" placeholder="Логин">
                        <input type="password" name="password" placeholder="Пароль">
                        <input type="password" name="passwordr" placeholder="Повторите пароль">
                        <input type="submit" name="reg_user" value="Зарегистрироваться">
                    </form>
                </main>
            </div>
</body>

</html>