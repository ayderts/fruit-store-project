<?php


namespace App\Services;


use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    /**
     * @param array $request
     * @return InvoiceResource
     */
    public function store(array $request) : InvoiceResource
    {

        $invoice = Invoice::create(['customer_name' => $request['customer_name']]);
        foreach ($request['fruit_items'] as $fruit) {
            $invoice->fruit_items()->attach($fruit['id'], ['quantity' => $fruit['quantity']]);
        }

        return new InvoiceResource($invoice);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        $invoices = Invoice::get();

        return InvoiceResource::collection($invoices);
    }

    /**
     * @param Invoice $invoice
     * @return InvoiceResource
     */
    public function show(Invoice $invoice) : InvoiceResource
    {
         return new InvoiceResource($invoice);
    }

    /**
     * @param array $request
     * @param Invoice $invoice
     * @return InvoiceResource
     */
    public function update(array $request, Invoice $invoice) : InvoiceResource
    {
        if (isset($request['customer_name'])) {
            $invoice->update(['customer_name' => $request['customer_name']]);
        }
        if (isset($request['fruit_items'])) {
            $fruitItemsToUpdate = [];

            foreach ($request['fruit_items'] as $fruit) {
                $fruitItemsToUpdate[$fruit['id']] = ['quantity' => $fruit['quantity']];
            }

            $invoice->fruit_items()->sync($fruitItemsToUpdate, false);

            $newFruits = collect($request['fruit_items'])->pluck('id')->toArray();
            $existingFruits = $invoice->fruit_items->pluck('id')->toArray();
            $newFruits = array_diff($newFruits, $existingFruits);

            foreach ($newFruits as $newFruit) {
                $invoice->fruit_items()->attach($newFruit, ['quantity' => $request['fruit_items'][$newFruit]['quantity']]);
            }
        }
        return new InvoiceResource($invoice);
    }

    /**
     * @param Invoice $invoice
     * @return JsonResponse
     */
    public function destroy(Invoice $invoice) : JsonResponse
    {
        $invoice->fruit_items()->detach();

        $invoice->delete();

        return response()->json(['message' => 'Invoice and associated fruits deleted successfully.']);
    }

    /**
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function generatePdf(Invoice $invoice)
    {
        $invoice_res = new InvoiceResource($invoice);
        $invoice_details = $invoice->fruitCategories;

        $pdf = Pdf::loadView('invoice.invoice-pdf',
            ['invoice' => $invoice,'invoice_res' => $invoice_res->jsonSerialize()]);
        $file = Storage::disk('public')->put('invoices/'.$invoice->id.'/'. $invoice->id . '.' . 'pdf', $pdf->output());
        return $pdf->download();
    }
}
