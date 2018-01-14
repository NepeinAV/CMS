<?php
class Template
{
    public static function addTmp($type, $module = __MODULE)
    {
        if (file_exists('./templates/' . __TEMPLATE . '/' . $module . '/' . $type . '.tmp.php')) {
            ob_start();
            include('./templates/' . __TEMPLATE . '/' . $module . '/' . $type . '.tmp.php');
            return trim(ob_get_clean());
        } else {
            return 'Шаблон не найден';
        }
    }

    public static function getStylesheet()
    {
        if (file_exists('./templates/' . __TEMPLATE . '/' .  __MODULE . '/css/style.css')) {
            ob_start();
            echo '<style>';
            include('./templates/' . __TEMPLATE . '/' .  __MODULE . '/css/style.css');
            echo '</style>';
            return trim(ob_get_clean());
        }
    }
}
