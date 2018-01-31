<article>
    <div class="article__image"></div>
    <header>
        <h1 class="article__title">
            <a href="/news/<?print(News::getArticleID());?>/">
                <?print(News::getArticleField('title'));?>
            </a>
        </h1>
    </header>
    <main class="article__text">
        <?print(News::getArticleField('text'));?>
    </main>
    <footer class="article__info">
        <section>Автор:
            <?print(User::getUserDataByID(News::getArticleField('user_id'), 'name'));?> | Дата:
                <?print(Main::getFormattedDateTime('DD.MM.YY', News::getArticleField('date')));?>
        </section>
    </footer>
</article>