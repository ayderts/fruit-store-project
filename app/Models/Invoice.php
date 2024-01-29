<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;

    public $guarded = [
        'id'
    ];

    public function fruit_items() : BelongsToMany
    {
        return $this->belongsToMany(FruitItem::class,'invoice_details')->withPivot('quantity');;
    }

    public function fruitCategories()
    {
        return $this->belongsToMany(FruitItem::class,'invoice_details')
            ->with('fruit_category'); // Load the related FruitCategory model
    }

}
