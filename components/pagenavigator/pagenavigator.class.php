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

        $p_component = null;

        // Получаем зависимости и формируем название таблицы для получения данных
        $p_module = self::getParam('pagenavigator', 'p_module');
        $table = $p_module;

        if (self::getParam('pagenavigator', 'p_component')) {
            $p_component = self::getParam('pagenavigator', 'p_component');
            $table .= '_' . $p_component;
        }

        $table = self::getSetting('pagenavigator', 'SQLTABLES')[$table];
        $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if (!$cur_page) {
            $cur_page = 1;
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
        $page_nav = '';

        for ($page = 1; $page <= $pages_num; $page++) {
            $page_nav .= sprintf(($cur_page == $page) ? "<span class='page-active'>$page</span>" : "<a href='/%s%s/page-%d/'>%d</a>", $p_module, ($cur_id) ? '/' . $cur_id : '', $page, $page);
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
