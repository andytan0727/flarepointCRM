<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $primary_email
 * @property string|null $primary_number
 * @property string|null $secondary_number
 * @property string|null $billing_address1
 * @property string|null $billing_address2
 * @property string|null $billing_zipcode
 * @property string|null $billing_country
 * @property string|null $shipping_address1
 * @property string|null $shipping_address2
 * @property string|null $shipping_city
 * @property string|null $shipping_state
 * @property string|null $shipping_zipcode
 * @property string|null $shipping_country
 * @property string|null $billing_city
 * @property string|null $billing_state
 * @property string $name
 * @property string|null $vat
 * @property \App\Models\Industry $industry
 * @property string|null $company_type
 * @property int $user_id
 * @property int $industry_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $documents
 * @property-read int|null $documents_count
 * @property-read mixed $assigned_user
 * @property-read mixed $formatted_billing_address
 * @property-read mixed $formatted_shipping_address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lead[] $leads
 * @property-read int|null $leads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBillingZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePrimaryEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePrimaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereSecondaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereShippingZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereVat($value)
 */
class Client extends Model
{
    protected $fillable = [
        'name',
        'vat',
        'primary_email',
        'billing_address1',
        'billing_address2',
        'billing_city',
        'billing_state',
        'billing_zipcode',
        'billing_country',
        'shipping_address1',
        'shipping_address2',
        'shipping_city',
        'shipping_state',
        'shipping_zipcode',
        'shipping_country',
        'primary_number',
        'secondary_number',
        'industry_id',
        'company_type',
        'user_id',
    ];

    public function getFormattedBillingAddressAttribute()
    {
        $address = '';

        if ($this->billing_address1 || $this->billing_city || $this->billing_zipcode) {
            if ($this->billing_address1) {
                $address .= htmlspecialchars($this->billing_address1).'<br/>';
            }
            if ($this->billing_address2) {
                $address .= htmlspecialchars($this->billing_address2).'<br/>';
            }
            if ($this->billing_city || $this->billing_state || $this->billing_zipcode) {
                if ($this->billing_city) {
                    $address .= $this->billing_city.'&nbsp;';
                }
                if ($this->billing_state) {
                    $address .= $this->billing_state.'&nbsp;';
                }
                if ($this->billing_zipcode) {
                    $address .= $this->billing_zipcode;
                }
            }
            if ($this->billing_country) {
                $address .= '<br/>'.$this->billing_country;
            }

            return $address;
        } else {
            return null;
        }
    }

    public function getFormattedShippingAddressAttribute()
    {
        $address = '';

        if ($this->shipping_address1 || $this->shipping_city || $this->shipping_zipcode) {
            if ($this->shipping_address1) {
                $address .= htmlspecialchars($this->shipping_address1).'<br/>';
            }
            if ($this->shipping_address2) {
                $address .= htmlspecialchars($this->shipping_address2).'<br/>';
            }
            if ($this->shipping_city || $this->shipping_state || $this->shipping_zipcode) {
                if ($this->shipping_city) {
                    $address .= $this->shipping_city.'&nbsp;';
                }
                if ($this->shipping_state) {
                    $address .= $this->shipping_state.'&nbsp;';
                }
                if ($this->shipping_zipcode) {
                    $address .= $this->shipping_zipcode;
                }
            }
            if ($this->shipping_country) {
                $address .= '<br/>'.$this->shipping_country;
            }

            return $address;
        } else {
            return null;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'client_id', 'id')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'client_id', 'id')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'client_id', 'id')
            ->orderBy('name', 'asc')
            ->orderBy('created_at', 'desc');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'client_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function getAssignedUserAttribute()
    {
        return User::findOrFail($this->user_id);
    }

    public function scopeMy($query)
    {
        return $query->where('user_id', Auth::id());
    }
}
