<?global $USER; if ($USER->hasPermission('ADD_COMMENTS')):?>
    <div class="section-row">
        <div class="section-title">
            <h2>Оставьте комментарий</h2>
        </div>
        <?echo PostingForm::$error;?>
        <form class="post-reply" name="commentform" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="input" name="text" placeholder="Введите сообщение" noresize></textarea>
                    </div>
                </div>
               <input type="hidden" name="p_module" value="<?echo Components::getParam('postingform', 'p_module');?>">
            </div>
            <input type="submit" name="addcomment" class="primary-button" placeholder="Отправить">
        </form>
</div>
<?endif;?>