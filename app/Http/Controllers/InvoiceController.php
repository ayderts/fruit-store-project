<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Services\FruitItemService;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceController extends Controller
{

    /**
     * @var InvoiceService
     */
    protected InvoiceService $invoiceService;

    /**
     * InvoiceController constructor.
     * @param InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService,)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->invoiceService->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * @param InvoiceStoreRequest $request
     * @return InvoiceResource
     */
    public function store(InvoiceStoreRequest $request) : InvoiceResource
    {
        return $this->invoiceService->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice) : InvoiceResource
    {
        return $this->invoiceService->show($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * @param InvoiceUpdateRequest $request
     * @param Invoice $invoice
     * @return InvoiceResource
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice) : InvoiceResource
    {
        return $this->invoiceService->update($request->validated(),$invoice);
    }

    /**
     * @param Invoice $invoice
     * @return JsonResponse
     */
    public function destroy(Invoice $invoice) : JsonResponse
    {
        return $this->invoiceService->destroy($invoice);
    }

    /**
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function generatePdf(Invoice $invoice)
    {
        return $this->invoiceService->generatePdf($invoice);
    }
}
