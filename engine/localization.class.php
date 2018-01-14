<?php
    class Localization
    {
        public static function getPhrase($phrase, $module = __MODULE)
        {
            if (file_exists('./modules/' . $module . '/lang.json')):
                $data = json_decode(file_get_contents('./modules/' . $module . '/lang.json'), true);
            if (isset($data[__LANG][$phrase])) {
                return $data[__LANG][$phrase];
            } else {
                return false; //phrase not exists
            } else:
                return false; //localization file not exists
            endif;
        }
  
        public static function addTitle()
        {
            $MODULE_SETTINGS = json_decode(file_get_contents('./modules/' . __MODULE . '/settings.json'), true);
            if (Localization::getPhrase('MODULE_TITLE') != false) {
                return Localization::getPhrase('MODULE_TITLE');
            } else {
                return $MODULE_SETTINGS['MODULE_TITLE'];
            }
        }
    }
