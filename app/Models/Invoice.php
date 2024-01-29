<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $guarded = [
        'id'
    ];

    public function fruit_items()
    {
        return $this->belongsToMany(FruitItem::class,'invoice_details')->withPivot('quantity');;
    }
}
