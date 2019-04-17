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
                throw new SQLException('Ошибка подключения к базе данных.', SQLException::CONNECT_ERROR);
            }
        }
        public function query($query)
        {
            $result = $this->connection->query($query);
            if ($result === false) {
                throw new SQLException("Ошибка в запросе", SQLException::WRONG_QUERY);
            }
            return $result;
        }
    }
    $DB = new DBconnect;
