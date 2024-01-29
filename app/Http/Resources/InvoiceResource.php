<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer_name,
            'total' => $this->getFruitsWithQuantity(),
            'fruits' => FruitItemResource::collection($this->fruit_items),
        ];
    }
    protected function getFruitsWithQuantity()
    {
        $total = 0;
        foreach ($this->fruit_items as $fruit)
        {
            $total += $fruit->pivot->quantity * $fruit->price;
        }
        return $total;
    }
}
