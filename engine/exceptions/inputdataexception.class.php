<?php
class InputDataException extends BaseException
{
    const SHORT_FIELD = 601;
    
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
