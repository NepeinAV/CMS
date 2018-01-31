<?php

class LogForm extends Modules
{
    public $settings;

    public function __construct()
    {
        $this->settings = $this->readSettings('logform');
    }
}
