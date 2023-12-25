<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManPowerSupply extends Model
{
    use HasFactory;

    protected $table = 'man_power_supplies';
    protected $guarded = [];
    protected $dates = ['supply_date'];
    /**
     * Get the customer that owns the ManPowerSupply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }


    /**
     * Get the person that owns the ManPowerSupply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id', 'id');
    }
}
