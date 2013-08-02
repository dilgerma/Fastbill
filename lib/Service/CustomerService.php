<?php
namespace Fastbill\Service;

use Fastbill\lib\ApiException;
use Fastbill\ValidationException;
use Fastbill\VO\Customer;
use Fastbill\VO\CustomerFilter;

require_once __DIR__ . '/../VO/CustomerFilter.php';
require_once __DIR__ . '/../VO/Customer.php';
require_once __DIR__ . '/AbstractService.php';

class CustomerService extends AbstractService
{
    protected function getServiceName()
    {
        return 'customer';
    }

    /**
     * @param CustomerFilter $filter
     * @return Customer[]
     * @throws ApiException
     */
    public function get(CustomerFilter $filter)
    {
        $response = $this->call($filter->toArray(), 'get');
        $customers = array();
        foreach ($response['CUSTOMERS'] as $cust) {
            $customer = new Customer();
            $customer->setId($cust['CUSTOMER_ID']);
            $customer->setNumber($cust['CUSTOMER_NUMBER']);
            $customer->setCreated(new \DateTime($cust['CREATED']));
            $customer->setType($cust['CUSTOMER_TYPE']);
            $customer->setTop($cust['TOP']);
            $customer->setOrganization($cust['ORGANIZATION']);
            $customer->setPosition($cust['POSITION']);
            $customer->setSalutation($cust['SALUTATION']);
            $customer->setFirstName($cust['FIRST_NAME']);
            $customer->setLastName($cust['LAST_NAME']);
            $customer->setAddress($cust['ADDRESS']);
            $customer->setAddress2($cust['ADDRESS_2']);
            $customer->setZipcode($cust['ZIPCODE']);
            $customer->setCity($cust['CITY']);
            $customer->setCountryCode($cust['COUNTRY_CODE']);
            $customer->setPhone($cust['PHONE']);
            $customer->setPhone2($cust['PHONE_2']);
            $customer->setFax($cust['FAX']);
            $customer->setMobile($cust['MOBILE']);
            $customer->setEmail($cust['EMAIL']);
            $customer->setAccountReceivable($cust['ACCOUNT_RECEIVABLE']);
            $customer->setCurrencyCode($cust['CURRENCY_CODE']);
            $customer->setVatId($cust['VAT_ID']);
            $customer->setDaysForPayment($cust['DAYS_FOR_PAYMENT']);
            $customer->setPaymentType($cust['PAYMENT_TYPE']);
            $customer->setShowPaymentNotice($cust['SHOW_PAYMENT_NOTICE'] == 1);
            $customer->setBankName($cust['BANK_NAME']);
            $customer->setBankCode($cust['BANK_CODE']);
            $customer->setBankAccountNumber($cust['BANK_ACCOUNT_NUMBER']);
            $customer->setBankAccountOwner($cust['BANK_ACCOUNT_OWNER']);
            $customers[$customer->getId()] = $customer;
        }
        return $customers;
    }

    /**
     * @param Customer $customer
     * @return int new Customer ID
     */
    public function create(Customer $customer)
    {
        $customer->validate();
        $response = $this->call($customer->toArray(), 'create');
        return (int)$response['CUSTOMER_ID'];
    }

    /**
     * @param Customer $customer
     * @throws \Fastbill\ValidationException
     */
    public function update(Customer $customer)
    {
        if (!$customer->getId()) {
            throw new ValidationException('id is required');
        }
        $customer->validate();
        $this->call($customer->toArray(), 'update');
    }

    /**
     * @param $customerId
     * @throws ApiException
     */
    public function delete($customerId)
    {
        $this->call(array('CUSTOMER_ID' => $customerId), 'delete');
    }
}
