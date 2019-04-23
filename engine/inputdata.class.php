<?php
class InputData
{
    public static function check()
    {
        global $USER;
        
        if (self::issetVal($_POST, 'addcomment')) {
            Main::includeClass('components', 'postingform');
            $text = trim(filter_input(INPUT_POST, 'text', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE));
            try {
                if ($text) {
                    PostingForm::addComment($text, Components::readSettings('postingform'), ['p_module' => self::getVal($_POST, 'p_module')]);
                } else {
                    throw new PostingFormException("Напишите что-нибудь", PostingFormException::EMPTY_FIELD);
                }
            } catch (PostingFormException $e) {
                PostingForm::$error = $e->getMessage();
            }
        } elseif (self::issetVal($_POST, 'addarticle')) {
            Main::includeClass('modules', 'news');
            Main::includeClass('components', 'postingform');
            try {
                $title = trim(filter_input(INPUT_POST, 'title', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE));
                $text = trim(filter_input(INPUT_POST, 'text', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE));
                $image = "";
                if (isset($_FILES['image'])) {
                    $image = $_FILES['image'];
                } else {
                    throw new PostingFormException("Загрузите изображение", PostingFormException::INVALID_IMAGE_TYPE);
                }
                News::addArticle($text, $title, $image);
            } catch (PostingFormException $e) {
                PostingForm::$error = $e->getMessage();
            }
        } elseif (self::issetVal($_POST, 'signin')) {
            Main::includeEngineClass('user');
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
            User::signIn($name, $password);
        } elseif (self::issetVal($_POST, 'reg_user')) {
            Main::includeEngineClass('user');
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $passwordr = filter_input(INPUT_POST, 'passwordr', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            User::regUser($name, $password, $passwordr);
        } elseif (self::getVal($_GET, 'logout')) {
            Main::includeEngineClass('user');
            $USER->logOutUser();
        }
    }

    public static function getVal($input_type, $value)
    {
        str_replace('/\./', '_', $value);
        if (self::issetVal($input_type, $value)) {
            return $input_type[$value];
        } else {
            return false;
        }
    }

    public static function issetVal($input_type, $value)
    {
        if (isset($input_type[$value])) {
            return true;
        }
        return false;
    }
}
