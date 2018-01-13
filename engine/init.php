<?php
    !empty(filter_input(INPUT_GET, 'lang')) ? define('__LANG', filter_input(INPUT_GET, 'lang')) : define('__LANG', 'ru');
    define('__ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/');
    define('__TEMPLATE', 'default');
    !empty(filter_input(INPUT_GET, 'module')) ? define('__MODULE', filter_input(INPUT_GET, 'module')) : define('__MODULE', 'news');
    require_once('./engine/main.class.php');
    require_once('./engine/dbcon.class.php');
    require_once('./engine/rdset.class.php');
    require_once('./engine/localization.class.php');
    require_once('./engine/tmp.class.php');
