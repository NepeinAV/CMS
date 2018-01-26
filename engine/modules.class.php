<?php
class Modules
{
    public static function getModule($type = 'index', $module = __MODULE)
    {
        global $MODULES;
        if (file_exists('./templates/' . __TEMPLATE  . '/' . $module . '/' . $type . '.tmp.php')) {
            require_once('./modules/' . $module . '/' . $module . '.class.php');
            if (!isset($modules[$module])) {
                $MODULES[$module] = new $module();
            }
            ob_start();
            include('./templates/' . __TEMPLATE  . '/' . $module . '/' . $type . '.tmp.php');
            return trim(ob_get_clean());
        } else {
            exit("404");
        }
    }

    protected function readSettings($module)
    {
        return json_decode(file_get_contents('./modules/' . $module . '/settings.json'), true);
    }

    public static function getTitle()
    {
        global $MODULES;
        if (Localization::getPhrase('MODULE_TITLE')) {
            return Localization::getPhrase('MODULE_TITLE');
        } else {
            return $MODULES[__MODULE]->settings['MODULE_TITLE'];
        }
    }
}
