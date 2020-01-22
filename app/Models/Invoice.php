<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property string $status
 * @property string|null $invoice_no
 * @property string|null $sent_at
 * @property string|null $payment_received_at
 * @property string|null $due_at
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InvoiceLine[] $invoiceLines
 * @property-read int|null $invoice_lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereDueAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice wherePaymentReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUpdatedAt($value)
 */
class Invoice extends Model
{
    protected $fillable = [
        'sent_at',
        'payment_received_at',
        'status',
        'sent_at',
        'due_at',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoiceLines()
    {
        return $this->hasMany(InvoiceLine::class);
    }

    public function canUpdateInvoice()
    {
        if (null != $this->sent_at) {
            return false;
        }

        return true;
    }
}
