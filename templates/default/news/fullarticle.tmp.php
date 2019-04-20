<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>
        <?echo Modules::getModuleTitle();?> -
            <?print(News::getArticleField('title'));?>
    </title>
    <link rel="stylesheet" href="/templates/default/news/css/style.css" />
</head>

<body>

    <?echo Template::addTmp('header');?>

        <?echo Template::addTmp('menu');?>
            <div class="flex_c wrap">
                <main>
                    <?echo Template::addTmp('article', 'news');?>
                    <?echo Components::getComponent('index', 'comments', ['p_module' => 'news', 'for_id' => true]);?>
                    <?echo Components::getComponent('index', 'pagenavigator', ['p_module' => 'news', 'p_component' => 'comments'])?>
                    <?echo Components::getComponent('index', 'postingform', ['p_module' => 'news']);?>
                </main>
                <?print(Template::addTmp('aside', 'news'));?>
            </div>
</body>

</html>