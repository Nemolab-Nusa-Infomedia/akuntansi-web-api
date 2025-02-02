<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CashflowType extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'cashflow_types';

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

    public function cashflows(): HasMany
    {
        return $this->hasMany(Cashflow::class);
    }
}
