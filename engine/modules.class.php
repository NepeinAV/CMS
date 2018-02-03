<?php
class Modules
{
    public static function getModule($action = 'index', $module = __MODULE, $params)
    {
        try {
            global $MODULES;

            $action = strtolower($action);
            $module = strtolower($module);
            $class = './modules/' . $module . '/' . $module . '.class.php';

            if (file_exists($class)) {
                require_once($class);
                $MODULES[$module][] = new $module($params); // Кладём экземпляр модуля в стек
                ob_start();
                echo Template::addTmp($action, $module);
                array_pop($MODULES[$module]);
                return trim(ob_get_clean());
            } else {
                throw new FileException("Module files not found!", FileException::NOT_EXISTS);
            }
        } catch (FileException $e) {
            echo $e->getMessage();
        }
    }

    public static function readSettings($module)
    {
        try {
            if (!file_exists('./modules/' . $module . '/settings.json')) {
                throw new FileException("Настройки модуля $module не найдены", FileException::NOT_EXISTS);
            }
            return json_decode(file_get_contents('./modules/' . $module . '/settings.json'), true);
        } catch (FileException $e) {
            echo $e->getMessage();
        }
    }

    public static function getModuleTitle()
    {
        global $MODULES;
        if (Localization::getPhrase('MODULE_TITLE')) {
            return Localization::getPhrase('MODULE_TITLE');
        } else {
            return self::getSetting('news', 'MODULE_TITLE');
        }
    }

    public static function getParam($component, $param)
    {
        global $MODULES;
        if (isset(end($MODULES[$component])->params[$param])) {
            return end($MODULES[$component])->params[$param];
        } else {
            return false;
        }
    }

    public static function getSetting($module, $value)
    {
        global $SETTINGS;
        if (isset($SETTINGS['modules'][$module][$value])) {
            return $SETTINGS['modules'][$module][$value];
        } else {
            return false;
        }
    }
}
