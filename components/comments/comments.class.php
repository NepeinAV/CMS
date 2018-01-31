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

        if (isset($_POST['addcomment'])) {
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
            if ($text) {
                return Comments::addComment($text, $this->settings);
            }
        }
    }

    public static function showComments($direction = false)
    {
        global $COMPONENTS;

        $comments = Comments::getComments($COMPONENTS['comments']->settings['p_module'], $direction);
        if (!$comments) {
            return "Нет комментариев";
        }

        ob_start();
        for ($i = 0; $i < count($comments); $i++) {
            $COMPONENTS['comments']->current_comment = $comments[$i];
            echo Template::addTmp('comment', 'comments');
        }
        return trim(ob_get_clean());
    }

    private static function issetComments($page, $table, $id, $direction)
    {
        global $DB, $COMPONENTS;
        
        $from = ($page - 1) * $COMPONENTS['comments']->settings['LIMIT'];
        $limit = $COMPONENTS['comments']->settings['LIMIT'];

        if ($direction) {
            $by = 'ASC';
        } else {
            $by = 'DESC';
        }

        $result = $DB->query('SELECT id FROM ' . $table . ' WHERE article_id=' . $id .' ORDER BY id ' . $by . ' LIMIT ' . $from . ',' . $limit);
        
        if ($result->num_rows) {
            return $from;
        }

        return -1;
    }

    private static function getComments($table = 'news', $direction)
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

        $num_of_comments = $DB->query('SELECT id FROM newscomments WHERE article_id=' . $cur_id)->num_rows;
        if (!$num_of_comments) {
            return false;
        }
        
        if ($cur_page) {
            $interval = Comments::issetComments($cur_page, $table, $cur_id, $direction);
            ($interval != -1) ? $from = $interval : Main::pageNotFound();
        }

        $by = ($direction) ? 'ASC' : 'DESC';

        $result = $DB->query('SELECT * FROM ' . $table . ' WHERE article_id=' . $cur_id .' ORDER BY id ' . $by . ' LIMIT ' . $from . ',' . $limit);
        while ($data = $result->fetch_assoc()) {
            $comments[] = $data;
        }
        
        return $comments;
    }

    public static function addComment($text, $component_settings)
    {
        global $DB;

        $table = $component_settings['SQLTABLES'][$component_settings['p_module']];
        $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        if (!$cur_id) {
            return false;
        }

        $cur_user_name = $_SESSION['user_data']['id'];
        if (!$cur_user_name) {
            return false;
        }

        $result = $DB->query('INSERT INTO ' . $table . ' (article_id, user_id, text) VALUES ("' . $cur_id . '", "' . $cur_user_name . '", "' . $text . '")');
    }
    
    public static function getCommentField($field)
    {
        global $COMPONENTS;
        return $COMPONENTS['comments']->current_comment[$field];
    }
}