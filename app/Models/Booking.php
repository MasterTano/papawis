<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $table = 'user_court_bookings';
    /**
     * Table primary key name
     * @var string
     */
    protected $primaryKey = 'booking_id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'court_id',
        'user_id',
        'inclusion',
        'starts_at',
        'ends_at',
    ];

     /**
     * Get the court booked by the user
     */
    public function court()
    {
        return $this->hasOne('App\Models\Court', 'court_id', 'court_id');
    }

     /**
     * Get the user who owns the booking
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'user_id', 'user_id');
    }
}
