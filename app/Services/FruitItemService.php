<?php


namespace App\Services;


use App\Http\Resources\FruitItemResource;
use App\Models\FruitItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FruitItemService
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        $fruitItems = FruitItem::all();
        return  FruitItemResource::collection($fruitItems);
    }

    /**
     * @param FruitItem $fruitItem
     * @return FruitItemResource
     */
    public function show(FruitItem $fruitItem) : FruitItemResource
    {
        return new FruitItemResource($fruitItem);
    }

    /**
     * @param array $request
     * @return FruitItemResource
     */
    public function store(array $request) : FruitItemResource
    {
        $fruitItem = FruitItem::create($request);
        return new FruitItemResource($fruitItem);
    }

    /**
     * @param array $request
     * @param FruitItem $fruitItem
     * @return FruitItemResource
     */
    public function update(array $request, FruitItem $fruitItem)
    {
        $fruitItem->update($request);
        return new FruitItemResource($fruitItem);
    }

    /**
     * @param FruitItem $fruitItem
     * @return JsonResponse
     */
    public function delete(FruitItem $fruitItem) : JsonResponse
    {
        $fruitItem->delete();
        return response()->json(['message'=>'The fruit category has been deleted']);
    }
}
