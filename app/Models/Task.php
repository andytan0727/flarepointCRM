<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $user_assigned_id
 * @property int $user_created_id
 * @property int $client_id
 * @property int|null $invoice_id
 * @property \Illuminate\Support\Carbon $deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activity
 * @property-read int|null $activity_count
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $creator
 * @property-read mixed $assigned_user
 * @property-read mixed $creator_user
 * @property-read mixed $days_until_deadline
 * @property-read \App\Models\Invoice|null $invoice
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUserAssignedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUserCreatedId($value)
 */
class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_assigned_id',
        'user_created_id',
        'client_id',
        'deadline',
    ];
    protected $dates = ['deadline'];

    protected $hidden = ['remember_token'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_assigned_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'source');
    }

    public function getDaysUntilDeadlineAttribute()
    {
        return Carbon\Carbon::now()
            ->startOfDay()
            ->diffInDays($this->deadline, false); // if you are past your deadline, the value returned will be negative.
    }

    public function getAssignedUserAttribute()
    {
        return User::findOrFail($this->user_assigned_id);
    }

    public function getCreatorUserAttribute()
    {
        return User::findOrFail($this->user_assigned_id);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'source');
    }

    public function canUpdateInvoice()
    {
        //If there is no invoice, it should be possible, because it also creates
        if (!$this->invoice) {
            return true;
        }

        return $this->invoice->canUpdateInvoice();
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
