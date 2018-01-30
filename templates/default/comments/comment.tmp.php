<section class="comment">
    <div class="comment__info"><?echo Comments::getCommentField('author', __MODULE)?></div>
    <?echo Comments::getCommentField('text', __MODULE);?>
</section>