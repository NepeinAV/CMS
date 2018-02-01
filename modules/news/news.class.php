<?php

class News extends Modules
{
    public $settings;
    public $current_article = undefined;

    public function __construct($params)
    {
        $this->settings = $this->readSettings('news');
        foreach ($params as $key => $value) {
            $this->settings[$key] = $value;
        }
    }

    // $direction:
    //     true - в порядке как в базе данных
    //     false - в обратном порядке
    // $range - [От n строчки, Количество строк]
    public static function showArticles($direction = false, $from, $limit)
    {
        global $MODULES;

        $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        $from = (!isset(end($MODULES['news'])->settings['from']) && $cur_page && empty($from)) ? ($cur_page - 1) * end($MODULES['news'])->settings['LIMIT'] : 0;
        $limit = (!isset(end($MODULES['news'])->settings['limit']) && empty($limit)) ? end($MODULES['news'])->settings['LIMIT'] : end($MODULES['news'])->settings['limit'];
        
        $articles = self::getArticles($direction, $from, $limit);
        if (!$articles) {
            return 'Нет новостей';
        }

        ob_start();
        for ($i = 0; $i < count($articles); ++$i) {
            end($MODULES['news'])->current_article = $articles[$i];
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

        $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);

        if ($cur_id && empty(end($MODULES['news'])->settings['from']) && empty(end($MODULES['news'])->settings['limit'])) {
            $result = $DB->query('SELECT ' . $field . ' FROM news WHERE id=' . $cur_id);
            return (result != false) ? $result = $result->fetch_assoc()[$field] : false;
        } else {
            return end($MODULES['news'])->current_article[$field];
        }
    }
}
