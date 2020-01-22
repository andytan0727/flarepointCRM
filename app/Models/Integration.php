<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Integration
 *
 * @property int $id
 * @property string $name
 * @property int|null $client_id
 * @property int|null $user_id
 * @property int|null $client_secret
 * @property string|null $api_key
 * @property string|null $api_type
 * @property string|null $org_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereApiType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Integration whereUserId($value)
 */
class Integration extends Model
{
    protected $fillable = ['name', 'client_id', 'client_secret', 'api_key', 'org_id', 'api_type'];

    /**
     * @param $type
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public static function getApi($type)
    {
        $integration = Integration::where([
            //'user_id' => $userId,
            'api_type' => $type,
        ])->get();

        if ($integration) {
            $apiConfig = $integration[0];

            $className = $apiConfig->name;

            call_user_func_array(['App\\'.$className, 'initialize'], [$apiConfig]);
            $apiInstance = call_user_func_array(['App\\'.$className, 'getInstance'], []);

            return $apiInstance;
        }
        throw new \Exception('The user has no integrated APIs');
    }
}
