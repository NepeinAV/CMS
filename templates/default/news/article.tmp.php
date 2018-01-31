<article>
    <div class="article__image"></div>
    <header>
        <h1 class="article__title">
            <a href="/news/<?echo News::getArticleID();?>/">
                <?echo News::getArticleField('title');?>
            </a>
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