<?php
class Comments extends Components
{
    public $params;
    public $current_comment;
    public static $error;

    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    public static function showComments($direction = false)
    {
        try {
            global $COMPONENTS;
        
            $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $from = (!self::getParam('comments', 'from') && $cur_page) ? ($cur_page - 1) * self::getSetting('comments', 'LIMIT') : ((self::getParam('comments', 'from')) ? self::getParam('comments', 'from') : 0);
            $limit = (!self::getParam('comments', 'limit')) ? self::getSetting('comments', 'LIMIT') : self::getParam('comments', 'from');
            $table = self::getSetting('comments', 'SQLTABLES')[self::getParam('comments', 'p_module')];

            $comments = self::getComments($direction, $from, $limit, $table, $cur_id);
            if (!$comments) {
                if ($cur_page) {
                    header("Location: /news/$cur_id/");
                } else {
                    return "Нет комментариев";
                }
            }

            ob_start();
            for ($i = 0; $i < count($comments); $i++) {
                end($COMPONENTS['comments'])->current_comment = $comments[$i];
                echo Template::addTmp('comment', 'comments');
            }

            return trim(ob_get_clean());
        } catch (SQLException $e) {
            Comments::$error = $e->getMessage();
        }
    }

    private static function getComments($direction, $from, $limit, $table, $id)
    {
        global $DB, $COMPONENTS;

        $by = ($direction) ? 'ASC' : 'DESC';

        $query = 'SELECT * FROM ' . $table;
        if ($id && self::getParam('comments', 'for_id')) {
            $query .= ' WHERE article_id=' . $id;
        }
        $query .= ' ORDER BY id ' . $by . ' LIMIT ' . $from . ',' . $limit;
        
        $result = $DB->query($query);

        if (!$result->num_rows) {
            return [];
        }
        
        while ($data = $result->fetch_assoc()) {
            $comments[] = $data;
        }
        
        return $comments;
    }
    
    public static function getCommentField($field)
    {
        global $COMPONENTS;
        $field = filter_var(end($COMPONENTS['comments'])->current_comment[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
        return $field;
    }
}
