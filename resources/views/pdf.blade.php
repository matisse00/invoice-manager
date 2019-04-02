<!DOCTYPE html>
<html>
<head>
    <title>Faktura nr {{$invoice['invoice_number']}}</title>
</head>
<body>
@include('invoice_table', $invoice)
</body>
</html>
