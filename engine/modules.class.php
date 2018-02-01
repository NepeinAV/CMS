<?php
class Modules
{
    public static function getModule($type = 'index', $module = __MODULE)
    {
        global $MODULES;
        $type = strtolower($type);
        $module = strtolower($module);
        if (file_exists('./templates/' . __TEMPLATE  . '/' . $module . '/' . $type . '.tmp.php')) {
            require_once('./modules/' . $module . '/' . $module . '.class.php');
            if (!isset($MODULES[$module])) {
                $MODULES[$module] = new $module();
            }
            ob_start();
            include('./templates/' . __TEMPLATE  . '/' . $module . '/' . $type . '.tmp.php');
            //unset($MODULES[$module][$MODULES[$module]]);
            return trim(ob_get_clean());
        } else {
            Main::pageNotFound();
        }
    }

    protected function readSettings($module)
    {
        return json_decode(file_get_contents('./modules/' . $module . '/settings.json'), true);
    }

    public static function getModuleTitle()
    {
        global $MODULES;
        if (Localization::getPhrase('MODULE_TITLE')) {
            return Localization::getPhrase('MODULE_TITLE');
        } else {
            return $MODULES[__MODULE]->settings['MODULE_TITLE'];
        }
    }
}
