<?php


namespace App\Services;


use App\Http\Resources\FruitCategoryResource;
use App\Models\FruitCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitCategoryService
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        $fruit_categories = FruitCategory::all();
        return  FruitCategoryResource::collection($fruit_categories);
    }

    /**
     * @param FruitCategory $fruit_category
     * @return FruitCategoryResource
     */
    public function show(FruitCategory $fruit_category) : FruitCategoryResource
    {
        return new FruitCategoryResource($fruit_category);
    }

    /**
     * @param array $request
     * @return FruitCategoryResource
     */
    public function store(array $request) : FruitCategoryResource
    {
        $fruit_category = FruitCategory::create($request);
        return new FruitCategoryResource($fruit_category);
    }

    /**
     * @param array $request
     * @param FruitCategory $fruitCategory
     * @return FruitCategoryResource
     */
    public function update(array $request, FruitCategory $fruitCategory) : FruitCategoryResource
    {
        $fruitCategory->update($request);
        return new FruitCategoryResource($fruitCategory);
    }

    /**
     * @param FruitCategory $fruitCategory
     * @return JsonResponse
     */
    public function delete(FruitCategory $fruitCategory) : JsonResponse
    {
        $fruitCategory->delete();
        return response()->json(['message'=>'The fruit category has been deleted']);
    }
}
