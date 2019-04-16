<?php
class Template
{
    public static function addTmp($type = 'index', $module = __MODULE)
    {
        $template = './templates/' . __TEMPLATE . '/' . $module . '/' . $type . '.tmp.php';
        if (file_exists($template)) {
            ob_start();
            include($template);
            return trim(ob_get_clean());
        } else {
            return 'Шаблон не найден';
        }
    }
}
