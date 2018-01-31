<section class="comment">
    <div class="comment__info">
        Автор:
        <?echo Comments::getCommentField('author')?> | Дата:
            <?echo Main::getFormattedDateTime('DD.MM.YY', Comments::getCommentField('date'));?>
    </div>
    <?echo Comments::getCommentField('text');?>
</section>