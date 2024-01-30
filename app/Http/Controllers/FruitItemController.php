<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitItemStoreRequest;
use App\Http\Requests\FruitItemUpdateRequest;
use App\Http\Resources\FruitItemInvoiceResource;
use App\Http\Resources\FruitItemResource;
use App\Models\FruitItem;
use App\Services\FruitItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FruitItemController extends Controller
{

    /**
     * @var FruitItemService
     */
    protected FruitItemService $fruitItemService;

    /**
     * FruitCategoryController constructor.
     * @param FruitItemService $fruitItemService
     */
    public function __construct(FruitItemService $fruitItemService)
    {
        $this->fruitItemService = $fruitItemService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->fruitItemService->index();
    }

    /**
     * @param FruitItem $fruitItem
     * @return FruitItemResource
     */
    public function show(FruitItem $fruitItem) : FruitItemResource
    {
        return $this->fruitItemService->show($fruitItem);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * @param FruitItemStoreRequest $request
     * @return FruitItemResource
     */
    public function store(FruitItemStoreRequest $request) : FruitItemResource
    {

        return $this->fruitItemService->store($request->validated());
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * @param FruitItemUpdateRequest $request
     * @param FruitItem $fruitItem
     * @return FruitItemResource
     */
    public function update(FruitItemUpdateRequest $request, FruitItem $fruitItem) : FruitItemResource
    {
        return $this->fruitItemService->update($request->validated(),$fruitItem);
    }

    /**
     * @param FruitItem $fruitItem
     * @return JsonResponse
     */
    public function destroy(FruitItem $fruitItem) : JsonResponse
    {
        return $this->fruitItemService->delete($fruitItem);
    }
}
