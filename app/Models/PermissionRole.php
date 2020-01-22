<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PermissionRole
 *
 * @property int $permission_id
 * @property int $role_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PermissionRole[] $employee
 * @property-read int|null $employee_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions[] $hasperm
 * @property-read int|null $hasperm_count
 * @property-read \App\Models\Setting $settings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole whereRoleId($value)
 */
class PermissionRole extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    public function settings()
    {
        return $this->belongsTo(Setting::class);
    }

    public function employee()
    {
        return $this->hasMany(PermissionRole::class, 'role_id', 3);
    }

    public function hasperm()
    {
        return $this->hasMany(Permissions::class, 'Permission_role');
    }
}
