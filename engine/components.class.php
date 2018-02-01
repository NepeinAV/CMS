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

    protected function readSettings($component)
    {
        return json_decode(file_get_contents('./components/' . $component . '/settings.json'), true);
    }
}
