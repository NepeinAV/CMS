<?php
class rdset{
    public $settings;
    public function __construct() {
        global $DB, $MAIN;
        $result = $DB->query('SELECT * FROM settings');
        if (!$result->connect_error){
            $row = $result->fetch_assoc();
            do{
                $this->settings[$row['name']] = $row['value'];
            }while($row = $result->fetch_assoc());
        }else{
            echo "Ошибка при запросе";
        }
    }
}
$SETTINGS = new rdset; 
?>