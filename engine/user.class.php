<?php
class User
{
    public function __construct()
    {
        if (filter_input(INPUT_POST, 'signin', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            return User::signIn($name, $password);
        }
        
        if (filter_input(INPUT_POST, 'reg', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
            return User::regUser($name, $password);
        }

        if (filter_input(INPUT_GET, 'logout', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE)) {
            User::signOut();
        }
    }

    public static function regUser($name, $password)
    {
        global $DB;
        if ($name && $password) {
            $password = md5(md5($password));
            $result = $DB->query('INSERT INTO users (name, password) VALUES (' . $name . ',' . $password . ')');
        }
    }

    public static function signIn($name, $password)
    {
        global $DB;
        if ($name && $password) {
            $password = md5(md5($password));
            $result = $DB->query('SELECT id, name, type FROM users WHERE name="' . $name . '" AND password="' . $password . '"');
            if ($result->num_rows) {
                $_SESSION['user_data'] = $result->fetch_assoc();
            }
        } else {
            return 'Введите все данные';
        }
    }

    public function signOut()
    {
        if (isset($_SESSION['user_data'])) {
            unset($_SESSION['user_data']);
            header('Location: /');
        }
    }

    public static function getCurrUserField($field)
    {
        if (isset($_SESSION['user_data'][$field])) {
            return $_SESSION['user_data'][$field];
        }
    }

    public static function isUserSignedIn()
    {
        if (isset($_SESSION['user_data'])) {
            return true;
        }
        return false;
    }
}

$USER = new User();
