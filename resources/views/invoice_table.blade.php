<table class="table table-dark">
    <tbody>
    <tr>
        <th>Numer faktury</th>
        <td>{{$invoice['invoice_number']}}</td>
    </tr>
    <tr>
        <th>Data wystawienia faktury</th>
        <td>{{$invoice['invoice_date']}}</td>
    </tr>
    <tr>
        <th>Data sprzedaży</th>
        <td>{{$invoice['sell_date']}}</td>
    </tr>
    <tr>
        <th>Data zapłaty</th>
        <td>{{$invoice['payment_date']}}</td>
    </tr>
    <tr>
        <th>Nabywca</th>
        <td>{{$invoice['payer_name']}}</td>
    </tr>
    <tr>
        <th>Adres nabywcy</th>
        <td>{{$invoice['payer_address']}}</td>
    </tr>
    <tr>
        <th>NIP nabywcy</th>
        <td>{{$invoice['payer_nip']}}</td>
    </tr>
    <tr>
        <th>Suma netto</th>
        <td>{{$net_sum}}</td>
    </tr>
    <tr>
        <th>Suma brutto</th>
        <td>{{$gross_sum}}</td>
    </tr>
    </tbody>
</table>
<table class="table table-sm">
    <thead>
    <tr>
        <td>L.p.</td>
        <td>Nazwa usługi</td>
        <td>Jednostka</td>
        <td>Ilość</td>
        <td>Cena netto</td>
        <td>Stawka VAT</td>
        <td>Wartość netto</td>
        <td>Wartość brutto</td>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoice['items'] as $item)
        <tr>
            <td>{{$item['ordinalnumber']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['unit']}}</td>
            <td>{{$item['quantity']}}</td>
            <td>{{$item['amount']}}</td>
            <td>{{$item['vat']}}</td>
            <td>{{$item['netsum']}}</td>
            <td>{{$item['grosssum']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
