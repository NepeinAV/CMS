<?php
class User extends Permission
{
    public static $error;
    public $user;

    public function __construct()
    {
        $this->user = (isset($_SESSION['user_data'])) ? $_SESSION['user_data']['id'] : 0;
    }

    public static function regUser($name, $password, $passwordr)
    {
        global $DB;

        if (count(preg_grep('/^[a-zA-Z0-9_]*$/', [$name, $password, $passwordr])) == 3) {
            if (strlen($name) >= 4 && strlen($password) >= 4) {
                if ($password === $passwordr) {
                    $password = md5(md5($password));
                    $result = $DB->query('INSERT INTO users (name, password) VALUES ("' . $name . '","' . $password . '")');
                    if (!$result) {
                        User::$error = "Ошибка базы данных";
                    } else {
                        User::signIn($name, $passwordr);
                        header('Location: /');
                    }
                } else {
                    User::$error = "Пароли не совпадают";
                }
            } else {
                User::$error = "Слишком короткий логин или пароль(<4)";
            }
        } else {
            User::$error = "Используются запрещённые символы(разрешёны A-Z, a-z, 0-9, _)";
        }
    }

    public static function signIn($name, $password)
    {
        global $DB;
        if ($name && $password) {
            $password = md5(md5($password));
            $result = $DB->query('SELECT id, name, type, avatar_url FROM users WHERE name="' . $name . '" AND password="' . $password . '"');
            if ($result->num_rows) {
                $_SESSION['user_data'] = $result->fetch_assoc();
                $redirect = filter_input(INPUT_POST, 'redirect_url', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
                header("Location: $redirect");
            } else {
                User::$error = 'Логин/пароль не совпадают';
            }
        } else {
            User::$error = 'Введите все данные';
        }
    }

    public function logOutUser()
    {
        if ($this->isUserSignedIn()) {
            unset($_SESSION['user_data']);
            $this->user = 0;
            header('Location: /');
        }
    }

    public function getCurrUserData($field)
    {
        if ($this->isUserSignedIn()) {
            return User::getUserDataByID($this->user, $field);
        }
        return false;
    }

    public function isUserSignedIn()
    {
        return boolval($this->user);
    }

    public static function getUserDataByID($user_id, $field)
    {
        global $DB;
        
        $result = $DB->query('SELECT ' . $field . ' FROM users WHERE id=' . $user_id);
        if ($result->num_rows) {
            return $result->fetch_assoc()[$field];
        }
        return false;
    }
}

$USER = new User();
