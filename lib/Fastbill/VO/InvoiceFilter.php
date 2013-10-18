<?php

namespace Fastbill\VO;

class InvoiceFilter extends AbstractFilter
{
    /** @var int */
    private $invoiceId;

    /** @var string */
    private $invoiceNumber;

    /** @var string */
    private $customerId;

    /** @var int */
    private $month;

    /** @var int */
    private $year;

    /** @var string */
    private $state;

    /** @var string */
    private $type;

    protected function getFilterArray()
    {
        $array = array();
        if ($this->invoiceId) {
            $array['INVOICE_ID'] = $this->invoiceId;
        }
        if ($this->invoiceNumber) {
            $array['INVOICE_NUMBER'] = $this->invoiceNumber;
        }
        if ($this->customerId) {
            $array['CUSTOMER_ID'] = $this->customerId;
        }
        if ($this->month) {
            $array['MONTH'] = $this->month;
        }
        if ($this->year) {
            $array['YEAR'] = $this->year;
        }
        if ($this->state) {
            $array['STATE'] = $this->state;
        }
        if ($this->type) {
            $array['TYPE'] = $this->type;
        }
        return $array;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @param int $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * @param string $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @param int $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }


}
