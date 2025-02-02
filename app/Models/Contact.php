<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SerializeDate;

class Contact extends Model
{
    use HasUuids, SerializeDate;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'contacts';

    protected $fillable = [
        // REQUIRED
        'billing_address',
        'payment_address',
        'name_bank',
        'identity',
        'no_bank',
        'pt_name',
        'status',
        'email',
        'phone',
        'name',

        // FOREIGN KEY
        'type_id',
    ];

    protected $hidden = [];

    // Identity Value
    public const PASPOR = 'paspor';
    public const KTP = 'ktp';
    public const SIM = 'sim';


    /*
    |--------------------------------------------------------------------------
    | Relation - Belongs To
    |--------------------------------------------------------------------------
    */

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContactType::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relation - Has Many
    |--------------------------------------------------------------------------
    */

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
