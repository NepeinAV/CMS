<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>
        <?echo Modules::getModuleTitle();?>
    </title>
    <link rel="stylesheet" href="/templates/default/news/css/style.css" />
    <script src="/templates/default/news/js/script.js"></script>
</head>

<body>

    <?echo Template::addTmp('header');?>

        <?echo Template::addTmp('menu');?>
            <div class="flex_c wrap">
                <main>
                    <?echo Template::addTmp('article', 'news');?>
                        <?echo Components::getComponent('comments', 'news');?>
                </main>
                <aside>
                    <?echo Modules::getModule('index', 'logform');?>
                </aside>
            </div>
</body>

</html>