<?php
define('__ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'));
!empty(filter_input(INPUT_GET, 'module')) ? define('__MODULE', filter_input(INPUT_GET, 'module')) : define('__MODULE', 'news');
class main{
    public function __construct() {
        
    }
}
$MAIN = new main;
?>