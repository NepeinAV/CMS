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
                    <article>
                        <div class="article__image"></div>
                        <header>
                            <h1 class="article__title">
                                <?echo News::getArticleField('title');?>
                            </h1>
                        </header>
                        <main class="article__text">
                            <?echo News::getArticleField('text');?>
                        </main>
                        <footer class="article__info">
                            <section>Автор:
                                <?echo News::getArticleField('author');?> | Дата:
                                    <?echo Main::getFormattedDateTime('DD.MM.YY', News::getArticleField('date'));?>
                            </section>
                        </footer>
                    </article>
                    <?echo Components::getComponent('comments', 'news');?>
                        <?echo Components::getComponent('pagenavigator', 'news', 'comments')?>
                </main>
                <aside>
                    <?echo Modules::getModule('index', 'logform');?>
                </aside>
            </div>
</body>

</html>