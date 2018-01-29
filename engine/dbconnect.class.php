<?php
    class DBconnect
    {
        private $connection;
        public function __construct()
        {
            $data = json_decode(file_get_contents('./engine/dbaccess.json'), true);
            $this->connectdb($data);
            $this->query("SET NAMES 'utf8'");
        }
        private function connectdb($data)
        {
            $mysqli = new mysqli($data['host'], $data['login'], $data['pass'], $data['table']);
            if (!$mysqli->connect_error) {
                $this->connection = $mysqli;
            } else {
                die('Ошибка подключения к базе данных');
            }
        }
        public function query($query)
        {
            $result = $this->connection->query($query);
            return $result;
        }
    }
    $DB = new DBconnect;
