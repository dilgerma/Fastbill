<?php


namespace Fastbill\Service;

use Fastbill\ValidationException;
use Fastbill\VO\Invoice;
use Fastbill\VO\InvoiceFilter;

require_once __DIR__ . '/AbstractService.php';
require_once __DIR__ . '/../VO/Invoice.php';
require_once __DIR__ . '/../VO/InvoiceFilter.php';

class InvoiceService extends AbstractService
{

    protected function getServiceName()
    {
        return 'invoice';
    }

    /**
     * @param InvoiceFilter $filter
     * @return Invoice[]
     */
    public function get(InvoiceFilter $filter)
    {
        $response = $this->call($filter->toArray(), 'get');
        $invoices = array();
        foreach ($response['INVOICES'] as $inv) {
            $invoice = new Invoice();

            $invoices[$invoice->getId()] = $invoice;
        }
        return $invoices;
    }

    /**
     * @param Invoice $invoice
     * @return int new invoice id
     */
    public function create(Invoice $invoice)
    {
        $invoice->validate();
        $response = $this->call($invoice->toArray(), 'create');
        return (int)$response['INVOICE_ID'];
    }

    public function update(Invoice $invoice)
    {
        if (!$invoice->getId()) {
            throw new ValidationException('id is required');
        }
        $invoice->validate();
        $this->call($invoice->toArray(), 'update');
    }

    public function delete($invoiceId)
    {
        $this->call(array('INVOICE_ID' => $invoiceId), 'delete');
    }

    /**
     * @param int $invoiceId
     * @return string invoice number
     */
    public function complete($invoiceId)
    {
        $response = $this->call(array('INVOICE_ID' => $invoiceId), 'complete');
        return $response['INVOICE_NUMBER'];
    }

    public function cancel($invoiceId)
    {
        $this->call(array('INVOICE_ID' => $invoiceId), 'cancel');
    }

    /**
     * @param int $invoiceId
     * @return int remaining credits
     */
    public function sign($invoiceId)
    {
        $response = $this->call(array('INVOICE_ID' => $invoiceId), 'sign');
        return (int)$response['REMAINING_CREDITS'];
    }

    /**
     * @param int $invoiceId
     * @param string $to
     * @param null|string $cc
     * @param string $subject
     * @param string $message
     * @param bool $receiptConfirmation
     */
    public function sendByEmail($invoiceId, $to, $cc = null, $subject = '', $message = '', $receiptConfirmation = false)
    {
        $data = array(
            'INVOICE_ID' => $invoiceId,
            'RECIPIENT' => array(
                'TO' => $to
            ),
            'SUBJECT' => $subject,
            'MESSAGE' => $message,
            'RECEIPT_CONFIRMATION' => $receiptConfirmation ? 1 : 0
        );
        if ($cc) {
            $data['RECIPIENT']['CC'] = $cc;
        }
        $this->call($data, 'sendbyemail');
    }

    public function sendByPost($invoiceId)
    {
        $response = $this->call(array('INVOICE_ID' => $invoiceId), 'sendbypost');
        return (int)$response['REMAINING_CREDITS'];
    }

    /**
     * @param int $invoiceId
     * @param \DateTime|null $paidDate
     * @return string invoice number
     */
    public function setPaid($invoiceId, \DateTime $paidDate = null)
    {
        $data = array(
            'INVOICE_ID' => $invoiceId
        );
        if ($paidDate) {
            $data['PAID_DATE'] = $paidDate->format('Y-m-d');
        }
        $response = $this->call($data, 'setpaid');
        return $response['INVOICE_NUMBER'];
    }
}
