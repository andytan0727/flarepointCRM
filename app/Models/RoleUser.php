<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoleUser
 *
 * @property int $user_id
 * @property int $role_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleUser whereUserId($value)
 */
class RoleUser extends Model
{
    protected $table = 'role_user';
}
