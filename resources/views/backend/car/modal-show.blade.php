<!-- Modal -->
<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header bg-gradient-primary text-white rounded-0">
                <h5 class="modal-title">Detail Mobil</h5>
                <button type="button" class="close tet-white " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body rounded-0">

                <div class="row">
                <div class="col-lg-8">


                    <div class="row">
                        <div class="col">
                            <div id="carouselId" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="gambar"></div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>No Polisi</label>
                                <input type="text" name="license_number" class="form-control" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" name="color" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="text" name="year" class="form-control" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" name="manufacture" class="form-control" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Sewa per hari</label>
                                <input type="text" name="price" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Denda per hari</label>
                                <input type="text" name="penalty" class="form-control" readonly="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            </div>
        </div>
    </div>
</div>
