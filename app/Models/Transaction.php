<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'transactions';

    protected $fillable = [
        // REQUIRED
        'description',
        'amount',
        'date',

        // FOREIGN KEY
        'transaction_category_id',
        'company_id',
        'user_id',
    ];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | Relation - Belongs To
    |--------------------------------------------------------------------------
    */

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactionCategory(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relation - Has Many
    |--------------------------------------------------------------------------
    */

    public function cashflows(): HasMany
    {
        return $this->hasMany(Cashflow::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
