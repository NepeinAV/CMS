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

        public static function getClassInstance($class_path, $class_name)
        {
            try {
                if (!file_exists($class_path)) {
                    throw new FileException("Класс не существует", FileException::NOT_EXISTS);
                }
                require_once($class_path);
                $Class = new $class_name;
                return $Class;
            } catch (FileException $e) {
                echo $e->getMessage();
            }
        }

        public static function includeClass($type, $name)
        {
            try {
                $class = "./$type/$name/$name.class.php";

                if (!file_exists($class)) {
                    throw new FileException("Класс $name не существует", FileException::NOT_EXISTS);
                }
                return require_once($class);
            } catch (FileException $e) {
                echo $e->getMessage();
            }
        }

        public static function readSettings()
        {
            global $SETTINGS;
            for ($i = 0; $i < count($SETTINGS['modules']); $i++) {
                $module = array_shift($SETTINGS['modules']);
                $SETTINGS['modules'][$module] = Modules::readSettings($module);
            }

            for ($i = 0; $i < count($SETTINGS['components']); $i++) {
                $component = array_shift($SETTINGS['components']);
                $SETTINGS['components'][$component] = Components::readSettings($component);
            }
        }
    }
