<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InvoiceLine
 *
 * @property int $id
 * @property string $title
 * @property string $comment
 * @property int $price
 * @property int $invoice_id
 * @property string|null $type
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invoice $invoice
 * @property-read \App\Models\Task $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InvoiceLine whereUpdatedAt($value)
 */
class InvoiceLine extends Model
{
    protected $fillable = [
        'type',
        'quantity',
        'task_id',
        'title',
        'comment',
        'price',
        'invoice_id',
    ];

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function task()
    {
        return $this->invoice->task;
    }
}
