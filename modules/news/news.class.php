<?php

class News extends Modules
{
    public $params;
    public $current_article = undefined;
    public static $error = '';

    public function __construct($params)
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    // $direction:
    //     true - в порядке как в базе данных
    //     false - в обратном порядке
    // $range - [От n строчки, Количество строк]
    public static function showArticles($direction = false)
    {
        global $MODULES;

        $cur_page = filter_input(INPUT_GET, 'page_id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
        $from = (!self::getParam('news', 'from') && $cur_page) ? ($cur_page - 1) * self::getSetting('news', 'LIMIT') : ((self::getParam('news', 'from')) ? self::getParam('news', 'from') : 0);
        $limit = (!self::getParam('news', 'limit')) ? self::getSetting('news', 'LIMIT') : self::getParam('news', 'from');

        $articles = self::getArticles($direction, $from, $limit);
        if (!$articles) {
            if ($cur_page) {
                header("Location: /news/");
            } else {
                return 'Нет новостей';
            }
        }

        ob_start();
        for ($i = 0; $i < count($articles); ++$i) {
            end($MODULES['news'])->current_article = $articles[$i];
            echo Template::addTmp('article', 'news');
        }

        return trim(ob_get_clean());
    }

    public static function addArticle($text, $title)
    {
        try {
            global $DB, $USER;

            $user_id = $USER->getCurrUserData('id');

            if (!$title || !$text) {
                throw new RequestException("Невозможно добавить новость", RequestException::GET_PARAM_NOT_EXISTS);
            }

            if (!$user_id) {
                throw new UserException("Для добавления новостей необходимо войти в аккаунт", UserException::NOT_SIGNED_IN);
            }
            
            if (strlen($title) < 10 || strlen($text) < 10) {
                throw new InputDataException("Заголовок и текст новости должны быть длиннее 10 символов", InputDataException::SHORT_FIELD);
            }

            echo "INSERT INTO news (title, text, user_id) VALUES (\"$title\", \"$text\", \"$user_id\")";
            $result = $DB->query("INSERT INTO news (title, text, user_id) VALUES (\"$title\", \"$text\", \"$user_id\")");

            header("Location: /news/");
        } catch (RequestException $e) {
            News::$error = $e->getMessage();
        } catch (UserException $e) {
            News::$error = $e->getMessage();
        } catch (InputDataException $e) {
            @News::$error = $e->getMessage();
        }
    }

    private static function getArticles($direction, $from, $limit)
    {
        global $DB;

        $by = ($direction) ? 'ASC' : 'DESC';

        $result = $DB->query('SELECT * FROM news ORDER BY id ' . $by . ' LIMIT ' . $from . ',' . $limit);

        if (!$result->num_rows) {
            return false;
        }

        while ($data = $result->fetch_assoc()) {
            $articles[] = $data;
        }

        return $articles;
    }

    public static function getArticleField($field)
    {
        global $MODULES, $DB;

        $cur_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);

        if ($cur_id && !self::getParam('news', 'from') && !self::getParam('news', 'limit')) {
            $result = $DB->query('SELECT ' . $field . ' FROM news WHERE id=' . $cur_id);
            $field = filter_var($result = $result->fetch_assoc()[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
            return ($result != false) ? $field : false;
        } else {
            $field = filter_var(end($MODULES['news'])->current_article[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
            return $field;
        }
    }
}
