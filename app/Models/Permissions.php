<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permissions
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereUpdatedAt($value)
 */
class Permissions extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }
}
