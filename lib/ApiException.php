<?php


namespace Fastbill\lib;


use Exception;

class ApiException extends \Exception
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code, null);
    }

}
