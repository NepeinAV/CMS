<?php
class Comments extends Components
{
    public $settings;
    public $params;
    public $current_comment;

    public function __construct($params)
    {
        $this->settings = $this->readSettings('comments');

        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }

        if (isset($_POST['addcomment'])) {
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
            if ($text) {
                return Comments::addComment($text, $this->settings, $this->params);
            }
        }
    }

    public static function showComments($direction = false)
    {
        try {
            global $COMPONENTS;
        
            $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $from = (!isset(end($COMPONENTS['comments'])->params['from']) && $cur_page) ? ($cur_page - 1) * end($COMPONENTS['comments'])->settings['LIMIT'] : ((isset(end($COMPONENTS['comments'])->params['from'])) ? end($COMPONENTS['comments'])->params['from'] : 0);
            $limit = (!isset(end($COMPONENTS['comments'])->params['limit'])) ? end($COMPONENTS['comments'])->settings['LIMIT'] : end($COMPONENTS['comments'])->params['limit'];
            $table = end($COMPONENTS['comments'])->settings['SQLTABLES'][end($COMPONENTS['comments'])->params['p_module']];

            $comments = self::getComments($direction, $from, $limit, $table, $cur_id);
            if (!$comments) {
                return "Нет комментариев";
            }

            ob_start();
            for ($i = 0; $i < count($comments); $i++) {
                end($COMPONENTS['comments'])->current_comment = $comments[$i];
                echo Template::addTmp('comment', 'comments');
            }

            return trim(ob_get_clean());
        } catch (SQLException $e) {
            return $e->getMessage();
        }
    }

    private static function getComments($direction, $from, $limit, $table, $id)
    {
        global $DB, $COMPONENTS;

        $by = ($direction) ? 'ASC' : 'DESC';

        $query = 'SELECT * FROM ' . $table;
        if ($id && end($COMPONENTS['comments'])->params['for_id']) {
            $query .= ' WHERE article_id=' . $id;
        }
        $query .= ' ORDER BY id ' . $by . ' LIMIT ' . $from . ',' . $limit;
        
        $result = $DB->query($query);

        if (!$result->num_rows) {
            throw new SQLException('Пустой ответ', SQLException::EMPTY_RESPONSE);
        }
        
        while ($data = $result->fetch_assoc()) {
            $comments[] = $data;
        }
        
        return $comments;
    }

    private static function addComment($text, $component_settings, $component_params)
    {
        try {
            global $DB;

            $table = $component_settings['SQLTABLES'][$component_params['p_module']];
            $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $cur_user_name = $_SESSION['user_data']['id'];
            
            if (!$cur_id) {
                throw new RequestException("Невозможно добавить коментарий", RequestException::GET_PARAM_NOT_EXISTS);
            }

            if (!$cur_user_name) {
                throw new UserException("Для добавления комментария необходимо войти в аккаунт", UserException::NOT_SIGNED_IN);
            }

            $result = $DB->query('INSERT INTO ' . $table . ' (article_id, user_id, text) VALUES ("' . $cur_id . '", "' . $cur_user_name . '", "' . $text . '")');
        } catch (RequestException $e) {
            echo $e->getMessage();
        } catch (UserException $e) {
            echo $e->getMessage();
        }
    }
    
    public static function getCommentField($field)
    {
        global $COMPONENTS;
        return end($COMPONENTS['comments'])->current_comment[$field];
    }
}
