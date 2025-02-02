<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'log_activities';

    protected $fillable = [
        // REQUIRED
        'title',
        'body',

        // FOREIGN KEY
        'user_id',
    ];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | Relation - Belongs To
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
