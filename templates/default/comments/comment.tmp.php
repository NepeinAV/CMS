<section class="comment">
    <div class="comment__info">
        Автор:
        <?echo User::getUserDataByID(Comments::getCommentField('user_id'), 'name');?> 
        | Дата: <?echo Main::getFormattedDateTime('DD.MM.YY', Comments::getCommentField('date'));?>
    </div>
    <?echo Comments::getCommentField('text');?>
</section>