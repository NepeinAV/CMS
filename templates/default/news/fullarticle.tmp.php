<!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title><?print(Modules::getTitle());?> - полная новость</title>
        <link rel="stylesheet" href="/templates/default/news/css/style.css" />
        <script src="/templates/default/news/js/script.js"></script>
        <style>
            .article__next{
                display: none;
            }
        </style>
    </head>

    <body>

        <?echo Template::addTmp('header');?>

        <main class="wrap flex flexc">
            <div class="flex flexr">
                <?echo Template::addTmp('menu');?>
                <div id="right">
                    <?echo Template::addTmp('article');?>
                </div>
            </div>
        </main>
        <?echo Template::addTmp('footer');?>
        
    </body>

</html>