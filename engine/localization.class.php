<?php
    class Localization
    {
        public static function getPhrase($phrase, $module = __MODULE)
        {
            if (file_exists(__ROOT . 'modules/' . $module . '/lang.json')):
                $data = json_decode(file_get_contents(__ROOT . 'modules/' . $module . '/lang.json'), true);
            if (isset($data[__LANG][$phrase])) {
                return $data[__LANG][$phrase];
            } else {
                return false;
            } //phrase not exists
            else:
                return false; //localization file not exists
            endif;
        }
  
        public static function addTitle()
        {
            global $MODULE_TITLE;
            if (Localization::getPhrase('MODULE_TITLE') != false) {
                return Localization::getPhrase('MODULE_TITLE');
            } else {
                return $MODULE_TITLE;
            }
        }
    }
