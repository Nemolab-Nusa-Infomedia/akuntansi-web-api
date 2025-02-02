<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProductRestock extends Model
{
    use HasUuids;

    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_restocks';

    protected $fillable = [
        // REQUIRED
        'price_buy',
        'amount',
        'stock',

        // FOREIGN KEY
        'product_id',
    ];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | Relation - Belongs To
    |--------------------------------------------------------------------------
    */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
