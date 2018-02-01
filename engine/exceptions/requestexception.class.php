<?php
class RequestException extends BaseException
{
    const GET_PARAM_NOT_EXISTS = 301;
    const PAGE_NOT_FOUND = 302;
    
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
