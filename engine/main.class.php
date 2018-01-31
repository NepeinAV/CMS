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

        // $datetime - дата и время в формате: 20-08-2018 15:20:21
        public static function getFormattedDateTime($format = 'DD.MM.YY', $datetime)
        {
            $date = explode('-', explode(' ', $datetime)[0]);
            $time = explode(':', explode(' ', $datetime)[1]);
    
            if (preg_match('/Y{2,4}/', $format, $matches)) {
                $year = mb_strcut($date[0], -strlen($matches[0]));
            }
    
            return preg_replace(
                ['/H{2}/', '/(MIN){2}/', '/S{2}/', '/D{2}/', '/M{2}/', '/Y{2,4}/'],
                [$time[0], $time[1], $time[2], $date[2], $date[1], $year],
                $format
            );
        }
    }

    $MAIN = new Main;
