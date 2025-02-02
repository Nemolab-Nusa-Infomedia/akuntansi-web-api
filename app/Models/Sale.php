<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'sales';

    protected $fillable = [
        // REQUIRED
        'transaction_date',
        'no_transaction',
        'payment_team',
        'attachment',
        'due_date',
        'subtotal',
        'total',
        'memo',

        // FOREIGN KEY
        'transaction_id',
        'contact_id',
    ];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | Relation - Belongs To
    |--------------------------------------------------------------------------
    */

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relation - Has Many
    |--------------------------------------------------------------------------
    */

    public function details(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }
}
