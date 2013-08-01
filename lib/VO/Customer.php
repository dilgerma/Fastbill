<?php

namespace Fastbill\VO;

require_once __DIR__ . '/../ValidationException.php';

use Fastbill\ValidationException;

class Customer
{
    const TYPE_BUSINESS = 'business';
    const TYPE_CONSUMER = 'consumer';

    const SAL_MR = 'mr';
    const SAL_MRS = 'mrs';
    const SAL_FAMILY = 'family';

    const COUNTRY_DE = 'DE';
    const COUNTRY_AT = 'AT';
    const COUNTRY_CH = 'CH';

    const CURR_EUR = 'EUR';
    const CURR_CHF = 'CHF';
    const CURR_GBP = 'GBP';
    const CURR_USD = 'USD';

    const PAYMENT_BANKTRANSFER = 1; //Überweisung
    const PAYMENT_DIRECTDEBIT = 2;  //Lastschrift
    const PAYMENT_CASH = 3;         //Bar
    const PAYMENT_PAYPAL = 4;       //Paypal
    const PAYMENT_ADVANCEPAYMENT = 5; //Vorkasse
    const PAYMENT_CREDITCARD = 6;   //Kreditkarte

    private $id;
    private $number;
    private $created;
    private $type;
    private $top;
    private $organization;
    private $position;
    private $salutation;
    private $firstName;
    private $lastName;
    private $address;
    private $address2;
    private $zipcode;
    private $city;
    private $countryCode;
    private $phone;
    private $phone2;
    private $fax;
    private $mobile;
    private $email;
    private $accountReceivable;
    private $currencyCode;
    private $vatId;
    private $daysForPayment;
    private $paymentType;
    private $showPaymentNotice;
    private $bankName;
    private $bankCode;
    private $bankAccountNumber;
    private $bankAccountOwner;

    public function validate()
    {
        if (!in_array($this->type, array(self::TYPE_BUSINESS, self::TYPE_CONSUMER))) {
            throw new ValidationException('Customertype is wether ' . self::TYPE_BUSINESS . ' nor' . self::TYPE_CONSUMER);
        }


    }

    public function toArray()
    {
        return array();
    }
}
