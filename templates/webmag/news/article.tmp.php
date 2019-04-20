<div class="col-md-4">
    <div class="post">
        <a class="post-img" href="/news/<?print(News::getArticleField('id'));?>/"><img src="/templates/<?echo __TEMPLATE;?>/news/img/post-3.jpg" alt=""></a>
        <div class="post-body">
            <div class="post-meta">
                <span class="post-date"><?print(Main::getFormattedDateTime('DD.MM.YY', News::getArticleField('date')));?></span>
            </div>
            <h3 class="post-title">
                <a href="/news/<?print(News::getArticleField('id'));?>/"><?print(News::getArticleField('title'));?></a> 
            </h3>
        </div>
    </div>
</div>