<?php
class UserException extends BaseException
{
    const NOT_SIGNED_IN = 401;
    const PERMISSION_DENIED = 402;
    
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
