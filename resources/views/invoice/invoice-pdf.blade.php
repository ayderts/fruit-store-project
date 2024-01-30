<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Order - {{$invoice_res['customer']}}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Customer Order - {{$invoice_res['customer']}}</h2>

<table>
    <thead>
    <tr class="total">
        <td colspan="1">Customer</td>
        <td colspan="6">{{$invoice_res['customer']}}</td>
    </tr>
    <tr>
        <th>No</th>
        <th>Category</th>
        <th>Fruit</th>
        <th>Unit</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoice->fruit_items as $item)
        @php
        @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$invoice->fruitCategories[$loop->iteration - 1]->fruit_category->name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->unit}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->pivot->quantity}}</td>
                <td>{{$item->price * $item->pivot->quantity}}</td>
            </tr>

    @endforeach

{{--    @foreach($invoice->fruit_items as $item)--}}

{{--    @endforeach--}}

    </tbody>
    <tfoot>
    <tr class="total">
        <td colspan="6">Total</td>
        <td>{{$invoice_res['total']}}</td>
    </tr>
    </tfoot>
</table>

</body>
</html>
