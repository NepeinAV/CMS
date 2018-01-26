<article>
    <div class="article__image"></div>
    <header>
        <h1 class="article__title"><?echo News::getArticleField('title');?></h1>
        <section>Автор: <?echo News::getArticleField('author');?> | Дата: <?echo News::getArticleField('date');?></section>
    </header>
    <main class="article__text">
        <?echo News::getArticleField('text');?>
    </main>
    <a href="/news/<?echo News::getArticleID();?>/" class="article__next">Читать далее</a>
</article>