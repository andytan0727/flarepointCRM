<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $name
 * @property string|null $job_title
 * @property string $email
 * @property string|null $primary_number
 * @property string|null $secondary_number
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $state
 * @property string|null $country
 * @property string|null $zipcode
 * @property string|null $city
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read mixed $formatted_address
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact wherePrimaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereSecondaryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereZipcode($value)
 */
class Contact extends Model
{
    protected $fillable = [
        'name',
        'job_title',
        'email',
        'address1',
        'address2',
        'city',
        'state',
        'zipcode',
        'country',
        'primary_number',
        'secondary_number',
        'client_id',
    ];

    public function getFormattedAddressAttribute()
    {
        $address = '';

        if ($this->address1 || $this->city || $this->zipcode) {
            if ($this->address1) {
                $address .= htmlspecialchars($this->address1).'<br/>';
            }
            if ($this->address2) {
                $address .= htmlspecialchars($this->address2).'<br/>';
            }
            if ($this->city || $this->state || $this->zipcode) {
                if ($this->city) {
                    $address .= $this->city.'&nbsp;';
                }
                if ($this->state) {
                    $address .= $this->state.'&nbsp;';
                }
                if ($this->zipcode) {
                    $address .= $this->zipcode;
                }
            }
            if ($this->country) {
                $address .= '<br/>'.$this->country;
            }

            return $address;
        } else {
            return null;
        }
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function scopeMy($query)
    {
        return $query->whereHas('client', function ($q) {
            $q->where('user_id', '=', Auth::id());
        });
    }
}
