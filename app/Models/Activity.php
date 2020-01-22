<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Activity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $text
 * @property string $source_type
 * @property int|null $source_id
 * @property string $ip_address
 * @property string $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $source
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereSourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Activity whereUserId($value)
 */
class Activity extends model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table    = 'activity_log';
    protected $fillable = [
        'user_id',
        'text',
        'source_type',
        'source_id',
        'action',
    ];
    protected $guarded = ['id'];

    /**
     * Get the user that the activity belongs to.
     *
     * @return object
     */
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function source()
    {
        return $this->morphTo();
    }
}
