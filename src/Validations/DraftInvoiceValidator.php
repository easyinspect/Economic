<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-12-2017
 * Time: 12:48.
 */

namespace Economic\Validations;

use Economic\Models\DraftInvoice;
use Economic\Exceptions\EconomicValidationException;

class DraftInvoiceValidator
{
    public function validate(DraftInvoice $invoice)
    {
        return ! is_null($invoice->getCurrency())
            && ! is_null($invoice->getCustomer())
            && ! is_null($invoice->getLayout())
            && ! is_null($invoice->getPaymentTerms())
            && ! is_null($invoice->getRecipientName())
            && ! is_null($invoice->getRecipientVatZone())
            && ! is_null($invoice->getReferencesSalesPerson())
            && ! is_null($invoice->getReferencesVendorReference())
            && ! is_null($invoice->getDate());
    }

    public function getException(DraftInvoice $invoice)
    {
        $exception = new EconomicValidationException();

        if (is_null($invoice->getCurrency())) {
            $exception->addProperty('currency');
        }

        if (is_null($invoice->getCustomer())) {
            $exception->addProperty('customer');
        }

        if (is_null($invoice->getLayout())) {
            $exception->addProperty('layout');
        }

        if (is_null($invoice->getPaymentTerms())) {
            $exception->addProperty('paymentTerms');
        }

        if (is_null($invoice->getRecipientName())) {
            $exception->addProperty('recipient.name');
        }

        if (is_null($invoice->getRecipientVatZone())) {
            $exception->addProperty('recipient.vatZone');
        }

        if (is_null($invoice->getReferencesSalesPerson())) {
            $exception->addProperty('references.salesPerson');
        }

        if (is_null($invoice->getReferencesVendorReference())) {
            $exception->addProperty('references.vendorReference');
        }

        if (is_null($invoice->getDate())) {
            $exception->addProperty('date');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
