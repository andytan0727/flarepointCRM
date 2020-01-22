<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property int $task_complete_allowed
 * @property int $task_assign_allowed
 * @property int $lead_complete_allowed
 * @property int $lead_assign_allowed
 * @property int $time_change_allowed
 * @property int $comment_allowed
 * @property string|null $country
 * @property string|null $company
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Task $tasks
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCommentAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereLeadAssignAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereLeadCompleteAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTaskAssignAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTaskCompleteAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereTimeChangeAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 */
class Setting extends Model
{
    protected $fillable = [
        'task_complete_allowed',
        'task_assign_allowed',
        'lead_complete_allowed',
        'lead_assign_allowed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }
}
