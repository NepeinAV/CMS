<?php
class SQLException extends BaseException
{
    const WRONG_QUERY = 201;
    const CONNECT_ERROR = 202;
    const EMPTY_RESPONSE = 203;

    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
