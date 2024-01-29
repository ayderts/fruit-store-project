<?php


namespace App\Services;


use App\Http\Resources\FruitCategoryResource;
use App\Models\FruitCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitCategoryService
{
    public function index() : AnonymousResourceCollection
    {
        $fruit_categories = FruitCategory::all();
        return  FruitCategoryResource::collection($fruit_categories);
    }
    public function show(FruitCategory $fruit_category) : FruitCategoryResource
    {
        return new FruitCategoryResource($fruit_category);
    }

    public function store(array $request) : FruitCategoryResource
    {
        $fruit_category = FruitCategory::create($request);
        return new FruitCategoryResource($fruit_category);
    }

    public function update(array $request, FruitCategory $fruitCategory)
    {
        $fruitCategory->update($request);
        return new FruitCategoryResource($fruitCategory);
    }

    public function delete(FruitCategory $fruitCategory) : JsonResponse
    {
        $fruitCategory->delete();
        return response()->json(['message'=>'The fruit category has been deleted']);
    }
}
