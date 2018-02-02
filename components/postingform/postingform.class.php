<?php
class PostingForm extends Components
{
    public $params;

    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    public static function addComment($text, $component_params)
    {
        try {
            global $DB;

            $table = self::getSetting('postingform', 'SQLTABLES')[$component_params['p_module']];
            $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $cur_user_name = User::getCurrUserData('id');
            
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
}
