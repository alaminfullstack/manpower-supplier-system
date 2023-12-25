<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $guarded = [];


    /**
     * Get all of the invoices for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id', 'id');
    }

    /**
     * Get all of the man_power_supplies for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function man_power_supplies()
    {
        return $this->hasMany(ManPowerSupply::class, 'customer_id', 'id');
    }
}
