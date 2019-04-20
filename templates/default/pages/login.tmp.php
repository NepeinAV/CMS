<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>
        <?print(Modules::getModuleTitle());?> - Авторизация
    </title>
    <link rel="stylesheet" href="/templates/default/news/css/style.css" />
    <script src="/templates/default/news/js/script.js"></script>
</head>

<body>
    <?global $USER; if (!$USER->isUserSignedIn()):?>
        <div class="flex_c wrap">
            <main>
                <h1>Авторизация</h1>
                <?echo Modules::getModule('index', 'logform');?>
            </main>
        </div>
    <?else:
        echo '<script>window.location.replace("/")</script>';
    endif;?>
</body>

</html>