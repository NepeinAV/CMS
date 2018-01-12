<?php
    class Localization{
        public function __construct(){
            !empty(filter_input(INPUT_GET, 'lang')) ? define('__LANG', filter_input(INPUT_GET, 'lang')) : define('__LANG', 'ru');
        }

        static function getPhrase($phrase, $module = __MODULE){
            if(file_exists(__ROOT . 'modules/' . $module . '/lang.json')):
                $data = json_decode(file_get_contents(__ROOT . 'modules/' . $module . '/lang.json'), true);
                if(isset($data[__LANG][$phrase]))
                    return $data[__LANG][$phrase];
                else
                    return false; //phrase not exists
            else:
                return false; //localization file not exists
            endif;
        }
  
        static function addTitle() {
            global $MODULE_TITLE;
            if (Localization::getPhrase('MODULE_TITLE') != false)
                return Localization::getPhrase('MODULE_TITLE');
            else
                return $MODULE_TITLE;
        }
    }

    $LOCALIZATION = new Localization();
?>