<?global $USER; if ($USER->hasPermission('ADD_ARTICLES')):?>
    <div class="section-row">
        <div class="section-title">
            <h2>Добавление новости</h2>
        </div>
        <?echo News::$error;?>
        <form class="post-reply" name="addarticle_form" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="title" class="input" placeholder="Заголовок">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="input" name="text" placeholder="Введите текст новости" noresize></textarea>
                    </div>
                </div>
            </div>
            <input type="submit" name="addarticle" class="primary-button" placeholder="Добавить">
        </form>
    </div>
<?else:?>
        У вас недостаточно прав для добавления новостей
<?endif;?>