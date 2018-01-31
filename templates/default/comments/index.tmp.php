<section class="comments">
    <div class="comments__title">Комментарии:</div>
    <?echo Comments::showComments();?>
        <?echo Components::getComponent('pagenavigator', 'news', 'comments')?>
            <?echo Template::addTmp('addform', 'comments');?>
</section>