<?php
    class Main
    {
        public function __construct()
        {
        }

        public static function pageNotFound()
        {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/404/');
        }
    }

    $MAIN = new Main;
