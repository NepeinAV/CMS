<?php
class PostingFormException extends BaseException
{
    const EMPTY_FIELD = 501;
    const PERMISSION_DENIED = 502;
    const INVALID_IMAGE_TYPE = 602;

    
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
