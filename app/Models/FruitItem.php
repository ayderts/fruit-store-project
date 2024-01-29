<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FruitItem extends Model
{
    use HasFactory;
    public $guarded = [
        'id'
    ];
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class,'invoice_details')->withPivot('quantity');;
    }
}
