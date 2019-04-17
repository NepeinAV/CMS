<?php
class FileException extends BaseException
{
    const NOT_EXISTS = 101;
    const PERMISSION_DENIED = 102;
    
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
