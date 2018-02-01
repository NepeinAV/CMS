<?php
class Modules
{
    public static function getModule($action = 'index', $module = __MODULE, $params)
    {
        global $MODULES;
        $action = strtolower($action);
        $module = strtolower($module);
        if (file_exists('./templates/' . __TEMPLATE  . '/' . $module . '/' . $action . '.tmp.php')) {
            require_once('./modules/' . $module . '/' . $module . '.class.php');
            $MODULES[$module][] = new $module($params);
            ob_start();
            include('./templates/' . __TEMPLATE  . '/' . $module . '/' . $action . '.tmp.php');
            // print_r(end($MODULES[$module]));
            array_pop($MODULES[$module]);
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
            return end($MODULES[__MODULE])->settings['MODULE_TITLE'];
        }
    }
}
