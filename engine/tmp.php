<?php
class tmp {

    public function __construct() {
        
    }

    public function addTitle() {
        global $MODULE_TITLE;
        if (file_exists('modules/' . __MODULE . '/lang.php')):
            global $LANG;
            if (isset($LANG[__LANG]['MODULE_TITLE'])):
                return $LANG[__LANG]['MODULE_TITLE'];
            else:
                return $MODULE_TITLE;
            endif;
        else:
            return $MODULE_TITLE;
        endif;
    }

    public function addTmp($src) {
        global $LOC;
        if (file_exists('modules/' . __MODULE . '/' . $src . '.tmp.php')):
            ob_start();
            include('modules/' . __MODULE . '/' . $src . '.tmp.php');
            return trim(ob_get_clean());
        else:
            return 'Шаблон не найден';
        endif;
    }

}

$TMP = new tmp();
?>
