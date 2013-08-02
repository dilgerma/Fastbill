<?php


namespace Fastbill\VO;


class Invoice 
{
    const STATE_UNPAID = 'unpaid';
    const STATE_PAID = 'paid';
    const STATE_OVERDUE = 'overdue';

    const TYPE_OUTGOING = 'outgoing';
    const TYPE_DRAFT = 'draft';
    const TYPE_CREDIT = 'credit';
}
