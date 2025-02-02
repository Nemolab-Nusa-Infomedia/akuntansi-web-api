<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'notifications';

    protected $fillable = [
        // REQUIRED
        'title',
        'body',

        // FOREIGN KEY
        'receiver_id',
        'sender_id',
    ];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | Relation - Belongs To
    |--------------------------------------------------------------------------
    */

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
