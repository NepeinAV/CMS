<?php
class Modules
{
    public static function getModule($action = 'index', $module = __MODULE, $params)
    {
        try {
            global $MODULES;

            $action = strtolower($action);
            $module = strtolower($module);
            $tmp = './templates/' . __TEMPLATE  . '/' . $module . '/' . $action . '.tmp.php';
            $class = './modules/' . $module . '/' . $module . '.class.php';

            if (file_exists($tmp) && file_exists($class)) {
                require_once($class);
                $MODULES[$module][] = new $module($params); // Кладём экземпляр модуля в стек
                ob_start();
                echo Template::addTmp($action, $module);
                array_pop($MODULES[$module]);
                return trim(ob_get_clean());
            } else {
                throw new FileException("Файлы модуля не найдены", FileException::NOT_EXISTS);
            }
        } catch (FileException $e) {
            echo $e->getMessage();
        }
    }

    protected function readSettings($module)
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
            return end($MODULES[__MODULE])->settings['MODULE_TITLE'];
        }
    }
}
