<?php


namespace App\Services;


use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceService
{
    public function store($request) : InvoiceResource
    {

        $invoice = Invoice::create(['customer_name' => $request['customer_name']]);
        foreach ($request['fruit_items'] as $fruit) {
            $invoice->fruit_items()->attach($fruit['id'], ['quantity' => $fruit['quantity']]);
        }

        return new InvoiceResource($invoice);
    }

    public function show(Invoice $invoice) : InvoiceResource
    {
         return new InvoiceResource($invoice);
    }

    public function update($request, Invoice $invoice) : InvoiceResource
    {

        if (isset($request['customer_name'])) {
            $invoice->update(['customer_name' => $request['customer_name']]);
        }
        $invoice->fruit_items()->sync([]);
        foreach ($request['fruit_items'] as $fruit) {
            $invoice->fruits()->attach($fruit['id'], ['quantity' => $fruit['quantity']]);
        }

        return new InvoiceResource($invoice);
    }
}
