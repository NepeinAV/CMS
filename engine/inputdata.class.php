<?php
class InputData
{
    public static function check()
    {
        try {
            if (self::issetVal($_POST, 'addcomment')) {
                Main::includeClass('components', 'comments');
                $text = trim(filter_input(INPUT_POST, 'text', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE));
                if ($text) {
                    Comments::addComment($text, Components::readSettings('comments'), ['p_module' => self::getVal($_POST, 'p_module')]);
                } else {
                    throw new PostingFormException("Напишите что-нибудь", PostingFormException::EMPTY_FIELD);
                }
            }

            if (self::issetVal($_POST, 'signin')) {
                Main::includeEngineClass('user');
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
                User::signIn($name, $password);
            }
            
            if (self::issetVal($_POST, 'reg_user')) {
                Main::includeEngineClass('user');
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
                $passwordr = filter_input(INPUT_POST, 'passwordr', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
                User::regUser($name, $password, $passwordr);
            }
    
            if (self::getVal($_GET, 'logout')) {
                Main::includeEngineClass('user');
                User::logOutUser();
            }
        } catch (PostingFormException $e) {
            echo $e->getMessage();
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
