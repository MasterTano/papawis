<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGame extends Model
{
    use SoftDeletes;
    const STATUS_G = 'G';
    const STATUS_CANCELLED = 'CANCELLED';

    /**
     * Table primary key name
     * @var string
     */
    protected $primaryKey = 'user_game_id';

    protected $fillable = [
        'user_id',
        'booking_id',
        'status',
    ];

    /**
     * Get the user who joined this game
     *
     * @return App\Model\User
     */
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    /**
     * Get
     *
     * @return void
     */
    public function booking()
    {
        return $this->hasOne(Booking::class, 'booking_id', 'booking_id');
    }
    
}
