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

    /** @var int */
    private $id;

    /** @var int */
    private $number;

    /** @var \DateTime */
    private $created;

    /** @var string */
    private $type;

    /** @var int */
    private $top;

    /** @var string */
    private $organization;

    /** @var string */
    private $position;

    /** @var string */
    private $salutation;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var string */
    private $address;

    /** @var string */
    private $address2;

    /** @var string */
    private $zipcode;

    /** @var string */
    private $city;

    /** @var string */
    private $countryCode;

    /** @var string */
    private $phone;

    /** @var string */
    private $phone2;

    /** @var string */
    private $fax;

    /** @var string */
    private $mobile;

    /** @var string */
    private $email;

    /** @var string */
    private $accountReceivable;

    /** @var string */
    private $currencyCode;

    /** @var string */
    private $vatId;

    /** @var int */
    private $daysForPayment;

    /** @var int */
    private $paymentType;

    /** @var bool */
    private $showPaymentNotice;

    /** @var string */
    private $bankName;

    /** @var int */
    private $bankCode;

    /** @var int */
    private $bankAccountNumber;

    /** @var string */
    private $bankAccountOwner;


    public function toCreateArray()
    {
        return array(
            'CUSTOMER_NUMBER' => $this->number,
            'CUSTOMER_TYPE' => $this->type,
            'ORGANIZATION' => $this->organization,
            'POSITION' => $this->position,
            'SALUTATION' => $this->salutation,
            'FIRST_NAME' => $this->firstName,
            'LAST_NAME' => $this->lastName,
            'ADDRESS' => $this->address,
            'ADDRESS_2' => $this->address2,
            'ZIPCODE' => $this->zipcode,
            'CITY' => $this->city,
            'COUNTRY_CODE' => $this->countryCode,
            'PHONE' => $this->phone,
            'PHONE_2' => $this->phone2,
            'FAX' => $this->fax,
            'MOBILE' => $this->mobile,
            'EMAIL' => $this->email,
            'ACCOUNT_RECEIVABLE' => $this->accountReceivable,
            'CURRENCY_CODE' => $this->currencyCode,
            'VAT_ID' => $this->vatId,
            'DAYS_FOR_PAYMENT' => $this->daysForPayment,
            'PAYMENT_TYPE' => $this->paymentType,
            'SHOW_PAYMENT_NOTICE' => $this->showPaymentNotice ? 1 : 0,
            'BANK_NAME' => $this->bankName,
            'BANK_CODE' => $this->bankCode,
            'BANK_ACCOUNT_NUMBER' => $this->bankAccountNumber,
            'BANK_ACCOUNT_OWNER' => $this->bankAccountOwner
        );
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

    /**
     * @param string $accountReceivable
     */
    public function setAccountReceivable($accountReceivable)
    {
        $this->accountReceivable = $accountReceivable;
    }

    /**
     * @return string
     */
    public function getAccountReceivable()
    {
        return $this->accountReceivable;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param int $bankAccountNumber
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->bankAccountNumber = $bankAccountNumber;
    }

    /**
     * @return int
     */
    public function getBankAccountNumber()
    {
        return $this->bankAccountNumber;
    }

    /**
     * @param string $bankAccountOwner
     */
    public function setBankAccountOwner($bankAccountOwner)
    {
        $this->bankAccountOwner = $bankAccountOwner;
    }

    /**
     * @return string
     */
    public function getBankAccountOwner()
    {
        return $this->bankAccountOwner;
    }

    /**
     * @param int $bankCode
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
    }

    /**
     * @return int
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @param string $bankName
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param int $daysForPayment
     */
    public function setDaysForPayment($daysForPayment)
    {
        $this->daysForPayment = $daysForPayment;
    }

    /**
     * @return int
     */
    public function getDaysForPayment()
    {
        return $this->daysForPayment;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param int $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return int
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone2
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    /**
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param boolean $showPaymentNotice
     */
    public function setShowPaymentNotice($showPaymentNotice)
    {
        $this->showPaymentNotice = $showPaymentNotice;
    }

    /**
     * @return boolean
     */
    public function getShowPaymentNotice()
    {
        return $this->showPaymentNotice;
    }

    /**
     * @param int $top
     */
    public function setTop($top)
    {
        $this->top = $top;
    }

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $vatId
     */
    public function setVatId($vatId)
    {
        $this->vatId = $vatId;
    }

    /**
     * @return string
     */
    public function getVatId()
    {
        return $this->vatId;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }


}
