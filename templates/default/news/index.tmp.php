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
            <?echo News::showArticles();?>
            <section class="pagenav"><?echo News::getPages();?></section>
        </main>
        
    </body>

</html>