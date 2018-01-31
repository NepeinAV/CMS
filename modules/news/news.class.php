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
    public static function showArticles($direction = false)
    {
        global $MODULES;

        $articles = self::getArticles($direction);
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

    private static function issetArticles($page, $direction)
    {
        global $DB, $MODULES;

        $from = ($page - 1) * $MODULES['news']->settings['LIMIT'];
        $limit = $MODULES['news']->settings['LIMIT'];
        
        if ($direction) {
            $by = 'ASC';
        } else {
            $by = 'DESC';
        }

        $result = $DB->query('SELECT id FROM news ORDER BY id ' . $by . ' LIMIT '.$from.','.$limit);
        if ($result->num_rows) {
            return $from;
        }

        return -1;
    }

    private static function getArticles($direction)
    {
        global $DB, $MODULES;

        $num_of_articles = $DB->query('SELECT id FROM news')->num_rows;
        if (!$num_of_articles) {
            return false;
        }
        
        $from = 0;
        $limit = $MODULES['news']->settings['LIMIT'];

        $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if ($cur_page) {
            $interval = self::issetArticles($cur_page, $direction);
            if ($interval != -1) {
                $from = $interval;
            } else {
                Main::pageNotFound();
            }
        }

        if ($direction) {
            $by = 'ASC';
        } else {
            $by = 'DESC';
        }

        $result = $DB->query('SELECT * FROM news ORDER BY id ' . $by . ' LIMIT '.$from.','.$limit);
        while ($data = $result->fetch_assoc()) {
            $articles[] = $data;
        }

        return $articles;
    }

    public static function getArticleID()
    {
        global $MODULES;

        return !empty(filter_input(INPUT_GET, 'id')) ? filter_input(INPUT_GET, 'id') : $MODULES['news']->current_article['id'];
    }

    public static function getArticleField($field)
    {
        global $MODULES, $DB;

        $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);

        if ($id) {
            $result = $DB->query('SELECT '.$field.' FROM news WHERE id='.$id);

            return (result != false) ? $result = $result->fetch_assoc()[$field] : false;
        } else {
            return $MODULES['news']->current_article[$field];
        }
    }
}
