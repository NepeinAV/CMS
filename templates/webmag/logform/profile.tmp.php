<?global $USER;?>
<div class="mini-profile">
    <img class="avatar" src="<?print($USER->getCurrUserData('avatar_url'));?>">
    <?print($USER->getCurrUserData('name'));?>,&nbsp;
    <a href="/logout/">выйти</a>
</div>