<header id="header">
    <!-- Nav -->
    <div id="nav">
        <!-- Main Nav -->
        <div id="nav-fixed">
            <div class="container">
                <!-- logo -->
                <div class="nav-logo">
                    <a href="/" class="logo"><img src="/templates/<?echo __TEMPLATE;?>/news/img/logo.png" alt=""></a>
                </div>
                <!-- /logo -->

                <!-- nav -->
                <ul class="nav-menu nav navbar-nav">
                    <li><a href="/news/">Новости</a></li>
                    <li><a href="/forum/">Форум</a></li>
                </ul>

                <?global $USER;
                if (!$USER->isUserSignedIn()):?>
                    <div class="nav-btns">
                        <button class="aside-btn"><a href="/login/">Войти</a></button>
                    </div>
                <?else:?>
                    <div class="nav-btns">
                        <button class="aside-btn"><a href="/logout/">Выйти</a></button>
                    </div>
                <?endif;?>

                <!-- /nav -->
            </div>
        </div>
        <!-- /Main Nav -->
    </div>
    <!-- /Nav -->
</header>