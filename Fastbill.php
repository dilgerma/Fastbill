<?php

require_once __DIR__ . '/lib/HttpClient.php';
require_once __DIR__ . '/lib/FastbillCustomer.php';

class Fastbill 
{
    const URL = 'https://my.fastbill.com/api/1.0/api.php';

    /** @var string */
    private $email;

    /** @var string */
    private $apikey;

    /** @var string */
    private $customerEmail;

    /** @var string */
    private $customerPassword;

    /** @var HttpClient */
    private $httpClient;

    private $services = array();

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param $email string
     * @param $apikey string
     * @return Fastbill
     */
    public function setCredentials($email, $apikey)
    {
        $this->email = $email;
        $this->apikey = $apikey;
        return $this;
    }

    /**
     * @return FastbillCustomer
     */
    public function getCustomerService()
    {
        if (!isset($this->services['customer'])) {
            $this->services['customer'] = new FastbillCustomer($this);
        }
        return $this->services['customer'];
    }

    /**
     * @param $email string
     * @param $password string
     * @return Fastbill
     */
    public function setCustomer($email, $password)
    {
        $this->customerEmail = $email;
        $this->customerPassword = $password;
        return $this;

    }

    protected function call($request)
    {
        //–u {E-Mail-Adresse}:{API-Key} \
        //-H 'Content-Type: application/xml'
        /*
         * -H 'X-Username: {E-Mail Adresse des Benutzers}'\
            -H 'X-Password: {Passwort des Benutzers}' \
         */
    }
}
