<?php
class Modules
{
    public static function getModule($type = 'index', $module = __MODULE)
    {
        global $modules;
        if (file_exists('./templates/' . __TEMPLATE  . '/' . $module . '/' . $type . '.tmp.php')) {
            require_once('./modules/' . $module . '/' . $module . '.class.php');
            $modules[$module] = new News();
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
}
