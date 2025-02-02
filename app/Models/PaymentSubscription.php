<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SerializeDate;

class PaymentSubscription extends Model
{
    use HasUuids, SerializeDate;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'payment_subscriptions';

    protected $fillable = [
        // REQUIRED
        'amount',
        'status',

        // FOREIGN KEY
        'subscription_id',
        'company_id',
    ];

    protected $hidden = [];

    // Status Value
    public const PENDING = 'pending';
    public const SUCCESS = 'success';
    public const FAILED = 'failed';


    /*
    |--------------------------------------------------------------------------
    | Relation - Belongs To
    |--------------------------------------------------------------------------
    */

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
