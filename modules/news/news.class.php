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
        $articles = self::getArticles();
        if (!$articles) {
            return 'Нет новостей';
        }
        ob_start();
        for ($i = 0; $i < count($articles); ++$i) {
            $MODULES['news']->current_article = $articles[($direction) ? $i : count($articles) - 1 - $i];
            echo Template::addTmp('article', 'news');
        }

        return trim(ob_get_clean());
    }

    private static function issetArticles($page)
    {
        global $DB, $MODULES;

        $from = ($page - 1) * $MODULES['news']->settings['LIMIT'];
        $limit = $MODULES['news']->settings['LIMIT'];

        $result = $DB->query('SELECT id FROM news LIMIT '.$from.','.$limit);
        if ($result->num_rows) {
            return $from;
        }

        return false;
    }

    private static function getArticles()
    {
        global $DB, $MODULES;

        $from = 0;
        $limit = $MODULES['news']->settings['LIMIT'];

        $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if ($cur_page) {
            $interval = self::issetArticles($cur_page);
            if ($interval) {
                $from = $interval;
            } else {
                Main::pageNotFound();
            }
        }

        $result = $DB->query('SELECT * FROM news LIMIT '.$from.','.$limit);
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

    public static function getArticleFormattedDateTime($format = 'DD.MM.YY')
    {
        $datetime = self::getArticleField('date');
        $date = explode('-', explode(' ', $datetime)[0]);
        $time = explode(':', explode(' ', $datetime)[1]);

        if (preg_match('/Y{2,4}/', $format, $matches)) {
            $year = mb_strcut($date[0], -strlen($matches[0]));
        }

        return preg_replace(
            ['/H{2}/', '/(MIN){2}/', '/S{2}/', '/D{2}/', '/M{2}/', '/Y{2,4}/'],
            [$time[0], $time[1], $time[2], $date[2], $date[1], $year],
            $format
        );
    }
}
