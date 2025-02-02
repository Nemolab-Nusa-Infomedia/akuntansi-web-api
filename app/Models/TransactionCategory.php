<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'transaction_categories';

    protected $fillable = [
        // REQUIRED
        'name',
        'type',
    ];

    protected $hidden = [];

    protected $timestamps = false;


    /*
    |--------------------------------------------------------------------------
    | Relation - Has Many
    |--------------------------------------------------------------------------
    */

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
