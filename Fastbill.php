<?php


class Fastbill 
{
    const URL = 'https://my.fastbill.com/api/1.0/api.php';

    /** @var  string */
    private $email;

    /** @var  string */
    private $key;

    public function __construct($email, $key)
    {
        $this->email = $email;
        $this->key = $key;
    }


}
