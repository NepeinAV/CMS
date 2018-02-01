<aside>
    <?echo Modules::getModule('index', 'logform');?>
        <?print(Modules::getModule('newslist', 'news', ['from' => 0, 'limit' => 2]));?>
</aside>