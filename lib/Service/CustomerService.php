<?php
namespace Fastbill\Service;

use Fastbill\lib\HttpClientException;
use Fastbill\VO\Customer;
use Fastbill\VO\CustomerFilter;

require_once __DIR__ . '/../VO/CustomerFilter.php';
require_once __DIR__ . '/AbstractService.php';

class CustomerService extends AbstractService
{
    protected function getServiceName()
    {
        return 'customer';
    }


    public function get(CustomerFilter $filter)
    {

    }

    /**
     * @param Customer $customer
     * @return int new Customer ID
     */
    public function create(Customer $customer)
    {
        $customer->validate();
        $response = $this->call($customer->toArray());
        return (int)$response['CUSTOMER_ID'];
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
