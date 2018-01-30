<?php
class Components
{
    public static function getComponent($component, $p_module, $p_component)
    {
        global $COMPONENTS;

        $component = strtolower($component);
        
        if (file_exists('./components/' . $component . '/' . $component . '.class.php')) {
            require_once('./components/' . $component . '/' . $component . '.class.php');
            if (!isset($COMPONENTS[$component])) {
                $COMPONENTS[$component] = new $component($p_module, $p_component);
            }
            ob_start();
            echo Template::addTmp('index', $component);
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
