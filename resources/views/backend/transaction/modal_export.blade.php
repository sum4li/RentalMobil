<!-- Modal -->
<div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ekspor Laporan Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('transaction.export')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="text" name="from" class="form-control datepicker" required="">
                    </div>
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="text" name="to" class="form-control datepicker" required="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-sm">Simpan</button>
                        <button type="button" class="btn btn-light shadow-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
