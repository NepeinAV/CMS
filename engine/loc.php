<?php
class loc{
    public function __construct() {
        !empty(filter_input(INPUT_GET, 'lang')) ? define('__LANG', filter_input(INPUT_GET, 'lang')) : define('__LANG', 'ru');
    }
    public function getLocPhr($phrName){
        global $LANG;
        return $LANG[__LANG][$phrName];
    }
}
$LOC = new loc();
if (!empty(__MODULE)): require_once('modules/' . __MODULE. '/lang.php'); endif;
?>