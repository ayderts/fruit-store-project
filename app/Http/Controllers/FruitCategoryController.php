<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitCategoryStoreRequest;
use App\Http\Requests\FruitCategoryUpdateRequest;
use App\Http\Resources\FruitCategoryResource;
use App\Models\FruitCategory;
use App\Services\FruitCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FruitCategoryController extends Controller
{

    /**
     * @var FruitCategoryService
     */
    protected FruitCategoryService $fruitCategoryService;

    /**
     * FruitCategoryController constructor.
     * @param FruitCategoryService $fruitCategoryService
     */
    public function __construct(FruitCategoryService $fruitCategoryService,)
    {
        $this->fruitCategoryService = $fruitCategoryService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->fruitCategoryService->index();
    }

    /**
     * @param FruitCategory $fruitCategory
     * @return FruitCategoryResource
     */
    public function show(FruitCategory $fruitCategory) : FruitCategoryResource
    {
        return $this->fruitCategoryService->show($fruitCategory);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * @param FruitCategoryStoreRequest $request
     * @return FruitCategoryResource
     */
    public function store(FruitCategoryStoreRequest $request) : FruitCategoryResource
    {
        return $this->fruitCategoryService->store($request->validated());
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FruitCategory $fruitCategory)
    {
        //
    }

    /**
     * @param FruitCategoryUpdateRequest $request
     * @param FruitCategory $fruitCategory
     * @return FruitCategoryResource
     */
    public function update(FruitCategoryUpdateRequest $request, FruitCategory $fruitCategory) : FruitCategoryResource
    {
        return $this->fruitCategoryService->update($request->validated(),$fruitCategory);
    }

    /**
     * @param FruitCategory $fruitCategory
     * @return JsonResponse
     */
    public function destroy(FruitCategory $fruitCategory) : JsonResponse
    {
        return $this->fruitCategoryService->delete($fruitCategory);
    }
}
