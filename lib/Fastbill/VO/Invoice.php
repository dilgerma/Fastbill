<?php


namespace Fastbill\VO;

use Fastbill\ValidationException;

class Invoice 
{
    const STATE_UNPAID = 'unpaid';
    const STATE_PAID = 'paid';
    const STATE_OVERDUE = 'overdue';

    const TYPE_OUTGOING = 'outgoing';
    const TYPE_DRAFT = 'draft';
    const TYPE_CREDIT = 'credit';

    /** @var int */
    private $id;

    /** @var string */
    private $number;

    /** @var string */
    private $type;

    /** @var Customer */
    private $customer;

    /** @var int */
    private $customerCostcenterId;

    /** @var int */
    private $templateId;

    /** @var string */
    private $introtext;

    /** @var \DateTime */
    private $invoiceDate;

    /** @var \DateTime */
    private $dueDate;

    /** @var \DateTime */
    private $paidDate;

    /** @var \DateTime */
    private $deliveryDate;

    /** @var bool */
    private $isCanceled;

    /** @var float */
    private $cashDiscountPercent;

    /** @var int */
    private $cashDiscountDays;

    /** @var float */
    private $subTotal;

    /** @var float */
    private $vatTotal;

    /** @var float */
    private $total;

    /** @var VatItem[] */
    private $vatItems;

    /** @var Item[] */
    private $items;

    /** @var string */
    private $documentUrl;

    /** @var bool */
    private $euDelivery;

    public function validate()
    {
        if (!$this->customer || !$this->customer->getId()) {
            throw new ValidationException('no customer or no customerId');
        }

        foreach ($this->items as $item) {
            $item->validate();
        }
    }

    public function toArray()
    {
        return array();
    }
}
