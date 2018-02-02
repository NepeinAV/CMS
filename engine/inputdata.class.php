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
