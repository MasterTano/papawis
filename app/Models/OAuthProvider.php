<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthProvider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oauth_providers';

    /**
     * Table primary key name
     *
     * @var string
     */
    protected $primaryKey = 'oauth_provider_id';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['oauth_provider_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token', 'refresh_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
