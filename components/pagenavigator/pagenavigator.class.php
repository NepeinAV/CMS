<?php

class PageNavigator extends Components
{
    public $settings;

    public function __construct($p_module, $p_component = false)
    {
        $this->settings = $this->readSettings('pagenavigator');
        if ($p_module) {
            $this->settings['p_module'] = $p_module;
        }
        if ($p_component) {
            $this->settings['p_component'] = $p_component;
        }
    }

    public static function getPageNavPanel()
    {
        global $DB, $MODULES, $COMPONENTS;

        {// Получаем зависимости и формируем название таблицы для получения данных
            $p_module = $COMPONENTS['pagenavigator']->settings['p_module'];
            $table = $p_module;

            if (isset($COMPONENTS['pagenavigator']->settings['p_component'])) {
                $p_component = $COMPONENTS['pagenavigator']->settings['p_component'];
                $table .= '_'.$p_component;
            }
        }

        {
            $table = $COMPONENTS['pagenavigator']->settings['SQLTABLES'][$table];
            $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            if (!$cur_page) {
                $cur_page = 1;
            }
        }

        $query = self::getPageNavPanelQuery($p_component, $table, $cur_id);
        $records = $DB->query($query)->num_rows;

        $limit = $MODULES[$p_module]->settings['LIMIT'];
        if (isset($COMPONENTS[$p_component]) && $cur_id) {
            $limit = $COMPONENTS[$p_component]->settings['LIMIT'];
        }

        if ($records < $limit) { // Не возвращаем панель навигации если кол-во всех записей меньше максимального
            return false;
        }

        $pages_num = ceil($records / $limit); // Получаем кол-во страниц

        { // Проверяем необходимость вывода элементов и возвращаем их
            switch ($cur_page) {
                case 1:
                    $right = true;
                    $left = false;
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
        $query = 'SELECT id FROM '.$table;
        if ($p_component) {
            $query .= ' WHERE article_id='.$cur_id;
        }

        return $query;
    }
}
