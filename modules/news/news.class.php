<?php
class News extends Modules
{
    public $settings;
    
    public function __construct()
    {
        $this->settings = $this->readSettings('news');
    }
}
