<?php


namespace App\Services;


use App\Http\Resources\FruitItemResource;
use App\Models\FruitItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FruitItemService
{
    public function index() : AnonymousResourceCollection
    {
        $fruitItems = FruitItem::all();
        return  FruitItemResource::collection($fruitItems);
    }
    public function show(FruitItem $fruitItem) : FruitItemResource
    {
        return new FruitItemResource($fruitItem);
    }

    public function store(array $request) : FruitItemResource
    {
        $fruitItem = FruitItem::create($request);
        return new FruitItemResource($fruitItem);
    }

    public function update(array $request, FruitItem $fruitItem)
    {
        $fruitItem->update($request);
        return new FruitItemResource($fruitItem);
    }

    public function delete(FruitItem $fruitItem) : JsonResponse
    {
        $fruitItem->delete();
        return response()->json(['message'=>'The fruit category has been deleted']);
    }
}
