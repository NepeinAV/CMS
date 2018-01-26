<?php
    class DBconnect
    {
        private $connection;
        public function __construct()
        {
            $data = json_decode(file_get_contents('./engine/dbaccess.json'), true);
            return $this->connectdb($data);
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
            if ($result) {
                return $this->connection->query($query);
            } else {
                exit("Ошибка в запросе/Нет соединения с базой данных");
            }
        }
    }
    $DB = new DBconnect;
