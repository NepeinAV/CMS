<aside>
    <?global $USER;
    if (!$USER->isUserSignedIn()):
        echo Modules::getModule('index', 'logform');
    else:
        echo Template::addTmp('profile', 'logform');
    endif;?>
</aside>