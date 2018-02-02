<?php
class Components
{
    public static function getComponent($action = 'index', $component, $params)
    {
        global $COMPONENTS;

        $component = strtolower($component);
        
        if (file_exists('./components/' . $component . '/' . $component . '.class.php')) {
            require_once('./components/' . $component . '/' . $component . '.class.php');
            $COMPONENTS[$component][] = new $component($params);
            ob_start();
            echo Template::addTmp($action, $component);
            array_pop($COMPONENTS[$component]);
            return trim(ob_get_clean());
        } else {
            return "Компонент не найден";
        }
    }

    public static function readSettings($component)
    {
        try {
            if (!file_exists('./components/' . $component . '/settings.json')) {
                throw new FileException("Настройки компонента $component не найдены", FileException::NOT_EXISTS);
            }
            return json_decode(file_get_contents('./components/' . $component . '/settings.json'), true);
        } catch (FileException $e) {
            echo $e->getMessage();
        }
    }

    public static function getParam($component, $param)
    {
        global $COMPONENTS;
        if (isset(end($COMPONENTS[$component])->params[$param])) {
            return end($COMPONENTS[$component])->params[$param];
        } else {
            return false;
        }
    }

    public static function getSetting($component, $value)
    {
        global $SETTINGS;
        if (isset($SETTINGS['components'][$component][$value])) {
            return $SETTINGS['components'][$component][$value];
        } else {
            return false;
        }
    }
}
