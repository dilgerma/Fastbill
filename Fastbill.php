<?php
namespace Fastbill;

use Fastbill\lib\CurlHttpClient;
use Fastbill\lib\HttpClient;
use Fastbill\Service\CustomerService;

require_once __DIR__ . '/lib/HttpClient.php';
require_once __DIR__ . '/lib/Service/CustomerService.php';

class Fastbill 
{
    const URL = 'https://my.fastbill.com/api/1.0/api.php';

    /** @var HttpClient */
    private $httpClient;

    private $services = array();

    /**
     * Creates a Fastbill Instance with Curl as the HttpClient
     * @return Fastbill
     */
    public static function createWithCurl()
    {
        require_once __DIR__ . '/lib/CurlHttpClient.php';
        return new Fastbill(new CurlHttpClient());
    }

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->httpClient->setUrl(self::URL);
    }

    /**
     * @param $email string
     * @param $apikey string
     * @return Fastbill
     */
    public function setApiCredentials($email, $apikey)
    {
        $this->httpClient->addHeader('Authorization', base64_encode($email.':'.$apikey));
        return $this;
    }

    /**
     * @param $email string
     * @param $password string
     * @return Fastbill
     */
    public function setUserCredentials($email, $password)
    {
        $this->httpClient->addHeader('X-Username', $email);
        $this->httpClient->addHeader('X-Password', $password);
        return $this;

    }

    /**
     * @return CustomerService
     */
    public function getCustomerService()
    {
        if (!isset($this->services['customer'])) {
            $this->services['customer'] = new CustomerService($this->httpClient);
        }
        return $this->services['customer'];
    }

}
