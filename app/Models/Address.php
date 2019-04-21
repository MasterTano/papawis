<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Table primary key name
     * @var string
     */
    protected $primaryKey = 'address_id';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_line1',
        'address_line2',
        'city_town',
        'province',
        'zip_code',
        'country_code',
    ];

     /**
     * Get the court on this address.
     */
    public function court()
    {
        return $this->belongsTo('App\Models\Court', 'address_id', 'court_id');
    }

}
