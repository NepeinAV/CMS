<?php
class PostingForm extends Components
{
    public $params;
    public static $error;

    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    public static function addComment($text, $component_settings, $component_params)
    {
        try {
            global $DB, $USER;

            $table = self::getSetting('postingform', 'SQLTABLES')[$component_params['p_module']];
            $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $cur_user_name = $USER->getCurrUserData('id');
            
            if (!$cur_id || $text === '') {
                throw new RequestException("Невозможно добавить коментарий", RequestException::GET_PARAM_NOT_EXISTS);
            }
            
            if (!$USER->hasPermission('ADD_COMMENTS')) {
                throw new UserException("Не хватает прав доступа для добавления комментария", UserException::PERMISSION_DENIED);
            }

            $result = $DB->query('INSERT INTO ' . $table . ' (article_id, user_id, text) VALUES ("' . $cur_id . '", "' . $cur_user_name . '", "' . $text . '")');
            header("Refresh: 0");
        } catch (RequestException $e) {
            PostingForm::$error = $e->getMessage();
        } catch (UserException $e) {
            PostingForm::$error = $e->getMessage();
        }
    }
}
