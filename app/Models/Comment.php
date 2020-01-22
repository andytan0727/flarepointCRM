<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $description
 * @property int $source_id
 * @property string $source_type
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereSourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUserId($value)
 */
class Comment extends Model
{
    protected $fillable = [
        'description',
        'task_id',
        'user_id',
    ];
    protected $hidden = ['remember_token'];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo('source');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->description, $matches);

        return $matches[1];
    }

    /* //TODO figure out how to escape the comment, but not the link to the profile, as it just return the full HTML
    public function setDescriptionAttribute($description)
     {
         $this->attributes['description'] = preg_replace(
           '/@([\w\-]+)/',
           'e(<a href="/profiles/$1">$0</a>',
           $description
       );

     }*/
}
