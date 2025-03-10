<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'grand_total',
        'notes',
        'customer_id',
        'invoice_sent',
        'tax',
        'invoice',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactionProducts(): HasMany
    {
        return $this->hasMany(TransactionProduct::class);
    }
}