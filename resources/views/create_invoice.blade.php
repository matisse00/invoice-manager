<html>
@include('head')
<body>
<div class="container">
    @include('navigation', $companies)
    <div>
        <form method="POST" action="{{url()->current()}}/send">
            @csrf
            <div class="form-group row col-sm-3">
                <label for="invoice_number">Numer faktury</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                       value="{{$invoice_number}}">
            </div>
            <div class="form-group row">
                <div class="form-group date col-sm-3">
                    <label for="invoice_date">Data wystawienia</label>
                    <input type="text" id="invoice_date" class="form-control" name="invoice_date" value="{{$today}}"/>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                <div class="form-group date col-sm-3">
                    <label for="sell_date">Data sprzedaży</label>
                    <input type="text" id="sell_date" class="form-control" name="sell_date" value="{{$today}}"/>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                <div class="form-group date col-sm-3">
                    <label for="payment_date">Data płatności</label>
                    <input type="text" id="payment_date" class="form-control" name="payment_date" value="{{$today}}"/>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label for="payer_name">Nazwa nabywcy</label>
                    <input type="text" id="payer_name" name="payer_name" class="form-control"/>
                </div>
                <div class="form-group col-sm-5">
                    <label for="payer_address">Adres nabywcy</label>
                    <input type="text" id="payer_address" name="payer_address" class="form-control"/>
                </div>
                <div class="form-group col-sm-2">
                    <label for="payer_nip">NIP Nabywcy</label>
                    <input type="text" id="payer_nip" name="payer_nip" class="form-control"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="add-item">Dodaj usługę</label>
                <button type="button" id="add-item" class="btn btn-default" aria-label="Add Item">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
            <div class="item-container">
            </div>
            <button class="btn btn-primary" type="submit">Zapisz fakturę</button>
        </form>

    </div>
</div>
</body>
</html>
<script type="text/javascript">

    $('.date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d'
    });

    // 'name', 'unit', 'amount', 'quantity', 'vat',

    let item_count = 0;
    $("#add-item").click(() => {
        item_count += 1;
        $(".item-container").append('\
        <div id="item">\
            <div class="form-group row">\
                <div class="form-group col-2">\
                    <label for="item_name">Nazwa usługi</label>\
                    <input type="text" id="item_name" name="item_name' + item_count + '" class="form-control">\
                </div>\
                <div class="form-group col-2">\
                    <label for="item_name">Jednostka</label>\
                    <input type="text" id="item_unit" name="item_unit' + item_count + '" class="form-control">\
                </div>\
                <div class="form-group col-2">\
                    <label for="item_name">Cena netto</label>\
                    <input type="text" id="item_amount" name="item_amount' + item_count + '" class="form-control">\
                </div>\
                <div class="form-group col-2">\
                    <label for="item_name">Ilość</label>\
                    <input type="text" id="item_quantity" name="item_quantity' + item_count + '" class="form-control">\
                </div>\
                <div class="form-group col-2">\
                    <label for="item_name">Stawka VAT</label>\
                    <input type="text" id="item_vat" name="item_vat' + item_count + '" class="form-control">\
                </div>\
            </div>\
        </div>\
        ');
    });

    // $(".item").append("<p>Dupa</p>")

</script>
