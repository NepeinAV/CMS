<!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title><?echo Modules::getTitle();?></title>
        <link rel="stylesheet" href="/templates/default/news/css/style.css" />
        <script src="/templates/default/news/js/script.js"></script>
    </head>

    <body>

        <?echo Template::addTmp('header');?>

        <?echo Template::addTmp('menu');?>

        <main class="wrap">
            <article>
                <div class="article__image"></div>
                <header>
                    <h1 class="article__title"><?echo News::getArticleField('title');?></h1>
                </header>    
                <main class="article__text">
                    <?echo News::getArticleField('text');?>
                </main>
                <footer class="article__info">
                    <section>Автор: <?echo News::getArticleField('author');?> | Дата: <?echo News::getArticleFormattedDateTime();?></section>
                </footer>
            </article>
        </main>
        
    </body>

</html>