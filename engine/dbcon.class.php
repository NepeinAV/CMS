<?php
    class dbcon
    {
        private $connection;
        public function __construct()
        {
            $data = json_decode(file_get_contents(__ROOT . '/engine/dbaccess.json'), true);
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
            return $this->connection->query($query);
        }
    }
    $DB = new dbcon;
