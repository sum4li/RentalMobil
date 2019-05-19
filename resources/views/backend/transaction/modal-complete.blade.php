<!-- Modal -->
<div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0 bg-gradient-primary">
                    <h5 class="modal-title text-white">Selesaikan Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body rounded-0">
                    <form action="" method="POST" id="form">
                        @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>No Invoice</label>
                                <input type="text" name="invoice_no" class="form-control" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal Dikembalikan</label>
                                <input type="text" name="return_date" class="form-control datepicker" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary shadow-sm">Simpan</button>
                                <button class="btn btn-light shadow-sm" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
