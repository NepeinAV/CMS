<section class="commentform">
    <form name="commentform" method="post">
        <textarea name="text" class="commentform__text" noresize></textarea>
        <input type="hidden" name="p_module" value="<?echo Components::getParam('postingform', 'p_module');?>">
        <input type="submit" name="addcomment" class="commentform__addcomment" placeholder="Отправить">
    </form>
</section>