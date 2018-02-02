<?php

class PageNavigator extends Components
{
    public $params;

    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    public static function getPageNavPanel()
    {
        global $DB;

        {// Получаем зависимости и формируем название таблицы для получения данных
            $p_module = self::getParam('pagenavigator', 'p_module');
            $table = $p_module;

            if (self::getParam('pagenavigator', 'p_component')) {
                $p_component = self::getParam('pagenavigator', 'p_component');
                $table .= '_' . $p_component;
            }
        }

        {
            $table = self::getSetting('pagenavigator', 'SQLTABLES')[$table];
            $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            if (!$cur_page) {
                $cur_page = 1;
            }
        }

        $query = self::getPageNavPanelQuery($p_component, $table, $cur_id);
        $records = $DB->query($query)->num_rows;

        $limit = Modules::getSetting($p_module, 'LIMIT');
        
        if (self::getSetting($p_component, 'LIMIT') && $cur_id) {
            $limit = self::getSetting($p_component, 'LIMIT') ;
        }

        if ($records <= $limit) { // Не возвращаем панель навигации если кол-во всех записей меньше максимального
            return false;
        }

        $pages_num = ceil($records / $limit); // Получаем кол-во страниц

        { // Проверяем необходимость вывода элементов и возвращаем их
            switch ($cur_page) {
                case 1:
                    $left = false;
                    $right = true;
                    break;
                case $pages_num:
                    $left = true;
                    $right = false;
                    break;
                case $cur_page > 1 && $cur_page < $pages_num:
                    $left = true;
                    $right = true;
            }

            if ($left) {
                $page_nav .= '<a href="/'.$p_module;
                if ($cur_id) {
                    $page_nav .= '/'.$cur_id;
                }
                $page_nav .= '/page-'.($cur_page - 1).'/">Назад</a>';
            }
            if ($right) {
                $page_nav .= '<a href="/'.$p_module;
                if ($cur_id) {
                    $page_nav .= '/'.$cur_id;
                }
                $page_nav .= '/page-'.($cur_page + 1).'/">Вперёд</a>';
            }
        }

        return $page_nav;
    }

    private static function getPageNavPanelQuery($p_component, $table, $cur_id)
    {
        $query = 'SELECT id FROM ' . $table;
        if ($cur_id) {
            $query .= ' WHERE article_id=' . $cur_id;
        }

        return $query;
    }
}
