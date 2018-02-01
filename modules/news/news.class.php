<?php

class News extends Modules
{
    public $settings;
    public $current_article = undefined;

    public function __construct()
    {
        $this->settings = $this->readSettings('news');
    }

    // $direction:
    //     true - в порядке как в базе данных
    //     false - в обратном порядке
    // $range - [От n строчки, Количество строк]
    public static function showArticles($direction = false, ...$range)
    {
        global $MODULES;

        $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        
        $from = (!isset($range[0]) && $cur_page) ? ($cur_page - 1) * $MODULES['news']->settings['LIMIT'] : 0;
        $limit = (!isset($range[1])) ? $MODULES['news']->settings['LIMIT'] : $range[1];
        
        $articles = self::getArticles($direction, $from, $limit);
        if (!$articles) {
            return 'Нет новостей';
        }

        ob_start();
        for ($i = 0; $i < count($articles); ++$i) {
            $MODULES['news']->current_article = $articles[$i];
            echo Template::addTmp('article', 'news');
        }
    
        return trim(ob_get_clean());
    }

    private static function getArticles($direction, $from, $limit)
    {
        global $DB;

        $by = ($direction) ? 'ASC' : 'DESC';

        $result = $DB->query('SELECT * FROM news ORDER BY id ' . $by . ' LIMIT ' . $from . ',' . $limit);

        if (!$result->num_rows) {
            return false;
        }

        while ($data = $result->fetch_assoc()) {
            $articles[] = $data;
        }

        return $articles;
    }

    public static function getArticleField($field)
    {
        global $MODULES, $DB;

        $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);

        if ($id) {
            $result = $DB->query('SELECT '.$field.' FROM news WHERE id=' . $id);
            return (result != false) ? $result = $result->fetch_assoc()[$field] : false;
        } else {
            return $MODULES['news']->current_article[$field];
        }
    }
}
