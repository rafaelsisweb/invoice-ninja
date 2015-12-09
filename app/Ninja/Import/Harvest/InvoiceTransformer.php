<?php namespace App\Ninja\Import\Harvest;

use App\Ninja\Import\BaseTransformer;
use League\Fractal\Resource\Item;

class InvoiceTransformer extends BaseTransformer
{
    public function transform($data)
    {
        if ( ! $this->getClientId($data->client)) {
            return false;
        }

        if ($this->hasInvoice($data->id)) {
            return false;
        }

        return new Item($data, function ($data) {
            return [
                'invoice_number' => $data->id,
                'paid' => (float) $data->paid_amount,
                'client_id' => $this->getClientId($data->client),
                'po_number' => $data->po_number,
                'invoice_date_sql' => $this->getDate($data->issue_date, 'm/d/Y'),
                'invoice_items' => [
                    [
                        'notes' => $data->subject,
                        'cost' => (float) $data->invoice_amount,
                        'qty' => 1,
                    ]
                ],
            ];
        });
    }
}