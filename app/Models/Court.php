<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    /**
     * Table primary key name
     * @var string
     */
    protected $primaryKey = 'court_id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_id',
        'name',
        'rate_per_hour',
        'peak_rate_per_hour',
        'minimum_rental_per_hour',
        'operating_hour',
        'amenity',
        'court_type',
        'additional_info',
    ];

     /**
     * Get the address record associated with the court.
     */
    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

}
