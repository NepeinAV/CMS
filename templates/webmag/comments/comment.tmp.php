<div class="media">
    <div class="media-left">
        <img class="media-object" src="<?echo User::getUserDataByID(Comments::getCommentField('user_id'), 'avatar_url');?>" alt="">
    </div>
    <div class="media-body">
        <div class="media-heading">
            <h4><?echo User::getUserDataByID(Comments::getCommentField('user_id'), 'name');?></h4>
            <span class="time"><?echo Main::getFormattedDateTime('DD.MM.YY', Comments::getCommentField('date'));?></span>
        </div>
        <?echo Comments::getCommentField('text');?>
    </div>
</div>