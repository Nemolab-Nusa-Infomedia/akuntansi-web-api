<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        // REQUIRED
        'sub_from',
        'sub_to',
        'name',

        // OPTIONAL
        'location',
    ];

    protected $hidden = [];
}
