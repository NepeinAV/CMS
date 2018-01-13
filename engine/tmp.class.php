<?php
class Template
{
    public function __construct()
    {
    }

    public static function addTmp($src)
    {
        if (file_exists('templates/' . __TEMPLATE . '/' . __MODULE . '/' . $src . '.tmp.php')):
            ob_start();
        include('templates/' . __TEMPLATE . '/' . __MODULE . '/' . $src . '.tmp.php');
        return trim(ob_get_clean()); else:
            return 'Шаблон не найден';
        endif;
    }

    public static function getStylesheet()
    {
        if (file_exists('/templates/' . __TEMPLATE . '/' .  __MODULE . '/css/style.css')):
            ob_start();
        echo '<style>';
        include('/templates/' . __TEMPLATE . '/' .  __MODULE . '/css/style.css');
        echo '</style>';
        return trim(ob_get_clean());
        endif;
    }
}
