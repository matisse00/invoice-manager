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
            <th scope="col">Numer faktury</th>
            <th scope="col">Data wystawienia</th>
            <th scope="col">Nazwa płatnika</th>
            <th scope="col">Usuń fakturę</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoices as $invoice)
            <tr class="clickable-row invoice" data-content="[{{$invoice->id}}]" style="cursor:pointer">
                <td>{{$invoice->invoice_number}}</td>
                <td>{{$invoice->invoice_date}}</td>
                <td>{{$invoice->payer_name}}</td>
                <td>
                    <a type="button" class="btn btn-danger" href="/invoice/{{$invoice->id}}/delete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
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
            url: _.replace( //Remove '/' if occurs more than once next to each other
                window.location.pathname + '/' + invoice_id, RegExp('\/{2,}'), '/'
            ),
            dataType: 'json',
        }).done((data) => {
            $('.invoice-details').html(data.invoice);
            $('.invoide-details-modal').modal('show');
        })
    });
</script>
