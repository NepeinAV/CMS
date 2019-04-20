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
    <main>
        <div class="regform">
            <h1>Регистрация</h1>
            <?echo Modules::getModule('index', 'regform');?>
        </div>
    </main>
</body>

</html>