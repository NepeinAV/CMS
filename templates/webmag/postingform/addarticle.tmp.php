<?global $USER; if ($USER->hasPermission('ADD_ARTICLES')):?>
    <div class="section-row">
        <div class="section-title">
            <h2>Добавление новости</h2>
        </div>
        <?echo News::$error;?>
        <?echo PostingForm::$error;?>
        <form class="post-reply" name="addarticle_form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="title" class="input" placeholder="Заголовок" value="<?echo isset($_POST['title']) ? $_POST['title'] : "";?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div id="summernote"><?echo isset($_POST['text']) ? $_POST['text'] : "";?></div>
                        <input type="hidden" name="text" value=""> 
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="input" name="text" placeholder="Введите текст новости" noresize></textarea>
                    </div>
                </div>
            </div> -->
            <input type="hidden" name="addarticle" value=""> 
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                         Обложка новости: <input type="file" name="image" accept="image/*">
                    </div>
                </div>
            </div>
            <input type="submit" id="send-article" class="primary-button" placeholder="Добавить">
        </form>
    </div>
<?else:?>
        У вас недостаточно прав для добавления новостей
<?endif;?>