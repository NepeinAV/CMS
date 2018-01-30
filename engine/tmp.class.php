<?php
class Template
{
    public static function addTmp($type = 'index', $module = __MODULE)
    {
        if (file_exists('./templates/' . __TEMPLATE . '/' . $module . '/' . $type . '.tmp.php')) {
            ob_start();
            include('./templates/' . __TEMPLATE . '/' . $module . '/' . $type . '.tmp.php');
            return trim(ob_get_clean());
        } else {
            return 'Шаблон не найден';
        }
    }
}
