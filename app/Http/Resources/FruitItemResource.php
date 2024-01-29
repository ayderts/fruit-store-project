<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'fruit_category' => $this->fruit_category->name,
            'unit' => $this->unit,
            'price' => $this->price,
            'invoice_id' => $this->pivot->invoice_id,
            'fruit_item_id' => $this->pivot->fruit_item_id,
            'quantity' => $this->pivot->quantity,
            'amount' => $this->pivot->quantity * $this->price
        ];
    }
}
