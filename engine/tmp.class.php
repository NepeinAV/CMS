<?php
class tmp {

    public function __construct() {
        
    }

    public function addTmp($src) {
        global $LOC;
        if (file_exists('templates/' . __TEMPLATE . '/' . __MODULE . '/' . $src . '.tmp.php')):
            ob_start();
            include('templates/' . __TEMPLATE . '/' . __MODULE . '/' . $src . '.tmp.php');
            return trim(ob_get_clean());
        else:
            return 'Шаблон не найден';
        endif;
    }

}

$TMP = new tmp();
?>
