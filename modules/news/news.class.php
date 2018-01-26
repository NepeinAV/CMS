<?php
class News extends Modules
{
    public $settings;
    public $current_article = undefined;
    
    public function __construct()
    {
        $this->settings = $this->readSettings('news');
    }

    public static function showArticles()
    {
        global $MODULES;
        $articles = News::getArticles();
        ob_start();
        for ($i = 0; $i < count($articles); $i++) {
            $MODULES['news']->current_article = $articles[$i];
            echo Template::addTmp('article', 'news');
        }
        return trim(ob_get_clean());
    }

    private static function getArticles($from = 0, $to = 9)
    {
        global $DB;
        $result = $DB->query('SELECT * FROM news LIMIT ' . $from . ',' . $to);
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
        if (!empty(filter_input(INPUT_GET, 'id'))) {
            $result = $DB->query('SELECT ' . $field . ' FROM news WHERE id=' . filter_input(INPUT_GET, 'id'));
            return (result != false) ? $result = $result->fetch_assoc()[$field] : false;
        } else {
            return $MODULES['news']->current_article[$field];
        }
    }
}
