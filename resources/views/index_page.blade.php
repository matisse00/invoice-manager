<!doctype html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <script type="text/javascript" src="{{url('js/app.js')}}"></script>
</head>
<body>
<div class="container">
    @include('navigation', $companies)
    <table class="table table-hover invoices">
        <thead>
        <tr>
            <th scope="col">Number faktury</th>
            <th scope="col">Data wystawienia</th>
            <th scope="col">Nazwa płatnika</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoices as $invoice)
            <tr class="clickable-row invoice" data-content="[{{$invoice->id}}]">
                <td>{{$invoice->invoice_number}}</td>
                <td>{{$invoice->invoice_date}}</td>
                <td>{{$invoice->payer_name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$invoices->links()}}
</div>

<div class="invoice-details"></div>
</body>
</html>


<script>
    $("table.invoices").on("click", "tr.invoice", (e) => {
        const invoice_id = $(e.currentTarget).data('content');
        $.ajax({
            type: 'GET',
            url: window.location.pathname + '/' + invoice_id,
            dataType: 'json',
        }).done((data) => {
            $('.invoice-details').html(data.invoice);
            $('.invoide-details-modal').modal('show');
        })
    });
</script>
