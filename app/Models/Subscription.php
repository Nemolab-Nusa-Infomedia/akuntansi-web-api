<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'subscriptions';

    protected $fillable = [
        // REQUIRED
        'duration_text',
        'description',
        'duration',
        'price',
        'name',
    ];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | Relation - Has Many
    |--------------------------------------------------------------------------
    */

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function paymentSubscriptions(): HasMany
    {
        return $this->hasMany(PaymentSubscription::class);
    }
}
