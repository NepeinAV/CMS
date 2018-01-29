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
        $articles = News::getArticles();
        ob_start();
        for ($i = 0; $i < count($articles); $i++) {
            $MODULES['news']->current_article = $articles[($direction) ? $i : count($articles) - 1 - $i];
            echo Template::addTmp('article', 'news');
        }
        return trim(ob_get_clean());
    }

    private static function issetArticles($page)
    {
        global $DB, $MODULES;
        $from = ($page - 1) * $MODULES['news']->settings['ARTICLE_LIMIT'];
        $to = $MODULES['news']->settings['ARTICLE_LIMIT'];
        $result = $DB->query('SELECT `id` FROM news LIMIT ' . $from . ',' . $to);
        if ($result->num_rows) {
            return [$from, $to];
        }
        return false;
    }

    private static function getArticles($from, $to)
    {
        global $DB, $MODULES;
        $from = 0;
        $to = $MODULES['news']->settings['ARTICLE_LIMIT'];
        $page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if ($page) {
            $interval = News::issetArticles($page);
            if ($interval) {
                $from = $interval[0];
            } else {
                Main::pageNotFound();
            }
        }
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

    public static function getArticleFormattedDateTime($format = 'DD.MM.YY')
    {
        {
            $datetime = News::getArticleField('date');
            $date = explode('-', explode(' ', $datetime)[0]);
            $time = explode(':', explode(' ', $datetime)[1]);
        }
        if (preg_match('/Y{2,4}/', $format, $matches)) {
            $year = mb_strcut($date[0], -strlen($matches[0]));
        }
        return preg_replace(
            ['/H{2}/', '/(MIN){2}/', '/S{2}/', '/D{2}/', '/M{2}/', '/Y{2,4}/'],
            [$time[0], $time[1], $time[2], $date[2], $date[1], $year],
            $format
        );
    }

    public static function getPages()
    {
        global $DB, $MODULES;
        $pages_num = $DB->query('SELECT `id` FROM `news`')->num_rows;
        $pages_num = ceil($pages_num / $MODULES['news']->settings['ARTICLE_LIMIT']);
        $page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if ($page == 0) {
            $page = 1;
        }
        switch ($page) {
            case 1:
                $left = false;
                $right = true;
                break;
            case $pages_num:
                $left = true;
                $right = false;
                break;
            default:
                $left = true;
                $right = true;
        }
        if ($left) {
            $page_nav .= '<a href="/news/page-' . ($page - 1) . '">Назад</a>';
        }
        if ($right) {
            $page_nav .= '<a href="/news/page-' . ($page + 1) . '">Вперёд</a>';
        }
        return $page_nav;
    }
    
    public static function getCurrentPageNumber()
    {
        $page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if ($page) {
            return $page;
        } else {
            return 1;
        }
    }
}
