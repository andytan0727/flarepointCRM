<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Lead
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $user_assigned_id
 * @property int $client_id
 * @property int $user_created_id
 * @property \Illuminate\Support\Carbon $contact_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activity
 * @property-read int|null $activity_count
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $creator
 * @property-read mixed $days_until_contact
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereContactDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUserAssignedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUserCreatedId($value)
 */
class Lead extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_assigned_id',
        'user_created_id',
        'client_id',
        'contact_date',
    ];
    protected $dates = ['contact_date'];

    protected $hidden = ['remember_token'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_assigned_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'source');
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'source');
    }

    public function getDaysUntilContactAttribute()
    {
        return Carbon\Carbon::now()->startOfDay()->diffInDays($this->contact_date, false);
    }

    /**
     * Add a reply to the thread.
     *
     * @param array $reply
     *
     * @return Model
     */
    public function addComment($reply)
    {
        $reply = $this->comments()->create($reply);

        return $reply;
    }

    public function scopeMy($query)
    {
        return $query->where('user_assigned_id', '=', Auth::id());
    }
}
