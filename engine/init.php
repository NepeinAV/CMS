<?
    define('__ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/');
    define('__TEMPLATE', 'default');
    !empty(filter_input(INPUT_GET, 'module')) ? define('__MODULE', filter_input(INPUT_GET, 'module')) : define('__MODULE', 'news');
    require_once('/main.class.php');
    require_once('/dbcon.class.php');
    require_once('/rdset.class.php');
    require_once('/localization.class.php');
    require_once('/tmp.class.php');
?>