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


    public function toArray()
    {
        return array();
    }

    public function validate()
    {
        if (!in_array($this->type, array(self::TYPE_BUSINESS, self::TYPE_CONSUMER))) {
            throw new ValidationException('Customertype is wether ' . self::TYPE_BUSINESS . ' nor' . self::TYPE_CONSUMER);
        }

        if ($this->type == self::TYPE_BUSINESS && !$this->organization) {
            throw new ValidationException('Organization is required, when type is business');
        } elseif ($this->type == self::TYPE_CONSUMER && !$this->lastName) {
            throw new ValidationException('Lastname is required, when type is consumer');
        }

        if (!in_array($this->countryCode, array(self::COUNTRY_AT, self::COUNTRY_CH, self::COUNTRY_DE))) {
            throw new ValidationException('CountryCode ist not set or not allowed');
        }

        if ($this->currencyCode && !in_array($this->currencyCode, array(self::CURR_CHF, self::CURR_EUR, self::CURR_GBP, self::CURR_USD))) {
            throw new ValidationException('CurrencyCode ist not allowed');
        }

        $allowedPayments = array(
            self::PAYMENT_ADVANCEPAYMENT,
            self::PAYMENT_BANKTRANSFER,
            self::PAYMENT_CASH,
            self::PAYMENT_CASH,
            self::PAYMENT_CREDITCARD,
            self::PAYMENT_DIRECTDEBIT
        );

        if (!in_array($this->paymentType, $allowedPayments)) {
            throw new ValidationException('Paymenttype is not allowed or not set');
        }

        if ($this->paymentType === self::PAYMENT_DIRECTDEBIT) {
            if (!$this->bankName) {
                throw new ValidationException('Bankname is required, if paymenty type is directdebit');
            }
            if (!$this->bankCode) {
                throw new ValidationException('Bankcode is required, if paymenty type is directdebit');
            }
            if (!$this->bankAccountNumber) {
                throw new ValidationException('BankAccountNumber is required, if paymenty type is directdebit');
            }
            if (!$this->bankAccountOwner) {
                throw new ValidationException('BankAccountOwner is required, if paymenty type is directdebit');
            }
        }
    }


}
