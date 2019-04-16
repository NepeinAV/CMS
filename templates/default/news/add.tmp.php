<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>
        <?print(Modules::getModuleTitle());?> - Добавление новости
    </title>
    <link rel="stylesheet" href="/templates/default/news/css/style.css" />
    <script src="/templates/default/news/js/script.js"></script>
</head>

<body>

    <?echo Template::addTmp('header', 'news');?>
    <?echo Template::addTmp('menu', 'news');?>
    <div class="flex_c wrap">
        <main>
            <?if (User::isUserSignedIn()): ?>
                <h1>Добавление новости</h1>
                <?echo News::$error;?>
                <form name="addarticle_form" class="reguserform" method="post">
                    <input type="text" name="title" placeholder="Заголовок">
                    <textarea name="text" placeholder="Текст новости"></textarea>
                    <input type="submit" name="addarticle" value="Добавить">
                </form>
            <?else:?>
                У вас недостаточно прав для добавления новостей
            <?endif;?>
        </main>
                
        <?print(Template::addTmp('aside', 'news'));?>
    </div>
</body>

</html>