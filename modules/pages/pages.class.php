<?php

class Pages extends Modules
{
    public $settings;

    public function __construct()
    {
        $this->settings = $this->readSettings('pages');
    }
}
