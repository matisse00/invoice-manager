<div class="modal fade invoide-details-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Faktura nr {{$invoice['invoice_number']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('invoice_table', $invoice)
            </div>
            <div class="modal-footer">
                <a href="/invoice/{{$invoice['id']}}/download">
                    <button class="btn btn-primary">Pobierz PDF</button>
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>
