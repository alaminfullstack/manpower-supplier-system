<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $guarded = [];
    protected $dates = ['invoice_date','due_date'];

    /**
     * Get the customer that owns the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }


    /**
     * Get all of the details for the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id', 'id');
    }


    /**
     * Get all of the payments for the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(PaymentDetails::class, 'invoice_id', 'id');
    }
}
