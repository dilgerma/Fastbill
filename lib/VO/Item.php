<?php


namespace Fastbill\VO;


use Fastbill\ValidationException;

class Item
{
    /** @var string */
    private $number;

    /** @var string */
    private $description;

    /** @var int */
    private $quantity;

    /** @var float */
    private $unitPrice;

    /** @var float */
    private $vatPercent;

    /** @var int */
    private $sortOrder;

    public function validate()
    {
        if (!$this->description) {
            throw new ValidationException('the item with has no description');
        }

        if (!$this->unitPrice && $this->unitPrice !== 0) {
            throw new ValidationException('the item with has no unitPrice');
        }

        if (!$this->vatPercent) {
            throw new ValidationException('the item with has no varPercent');
        }
    }

    public function toArray()
    {
        return array(
            'ARTICLE_NUMBER' => $this->number,
            'DESCRIPTION' => $this->description,
            'QUANTITY' => $this->quantity,
            'UNIT_PRICE' => $this->unitPrice,
            'VAT_PERCENT' => $this->vatPercent,
            'SORT_ORDER' => $this->sortOrder
        );
    }
}
