<?php
class Comments extends Components
{
    public $settings;
    public $current_comment;

    public function __construct($p_module, $p_component)
    {
        $this->settings = $this->readSettings('comments');
        if ($p_module) {
            $this->settings['p_module'] = $p_module;
        }
    }

    public static function showComments($direction = false)
    {
        global $COMPONENTS;

        $comments = Comments::getComments($COMPONENTS['comments']->settings['p_module']);
        if (!$comments) {
            return "Нет комментариев";
        }

        ob_start();
        for ($i = 0; $i < count($comments); $i++) {
            $COMPONENTS['comments']->current_comment = $comments[($direction) ? $i : count($comments) - 1 - $i];
            echo Template::addTmp('comment', 'comments');
        }

        return trim(ob_get_clean());
    }

    private static function issetComments($page, $table, $id)
    {
        global $DB, $COMPONENTS;
        
        $from = ($page - 1) * $COMPONENTS['comments']->settings['LIMIT'];
        $limit = $COMPONENTS['comments']->settings['LIMIT'];

        $result = $DB->query('SELECT id FROM ' . $table . ' WHERE article_id=' . $id .' LIMIT ' . $from . ',' . $limit);
        if ($result->num_rows) {
            return $from;
        }

        return -1;
    }

    private static function getComments($table = 'news')
    {
        global $DB, $COMPONENTS;

        $table = $COMPONENTS['comments']->settings['SQLTABLES'][$table];
        $from = 0;
        $limit = $COMPONENTS['comments']->settings['LIMIT'];

        $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if (!$cur_id) {
            return false;
        }
        
        if ($cur_page) {
            $interval = Comments::issetComments($cur_page, $table, $cur_id);
            if ($interval != -1) {
                $from = $interval;
            } else {
                Main::pageNotFound();
            }
        }
        
        $result = $DB->query('SELECT * FROM ' . $table . ' WHERE article_id=' . $cur_id . ' LIMIT ' . $from . ',' . $limit);
        while ($data = $result->fetch_assoc()) {
            $comments[] = $data;
        }
        
        return $comments;
    }

    public static function getCommentField($field)
    {
        global $COMPONENTS;
        return $COMPONENTS['comments']->current_comment[$field];
    }
}
