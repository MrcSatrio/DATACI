<?= $this->extend('template/index');

$this->section('page_content'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mx-2">
            <div class="card-header">
                <h2 class="text-center">PEMBUATAN KARTU BARU</h2>
            </div>
            <div class="card-body">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h4>Error</h4>
                        </hr>
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url() ?>user/transaksi_kartuHilang" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Pokok Mahasiswa</label>
                        <input type="text" class="form-control" value="<?= $user['npm'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <br>
                        <label for="saldo" class="form-label">Isi Saldo:</label>
                        <select class="custom-select" name="nominal_transaksi" required aria-readonly="true">
                            <option selected>Pilih nominal...</option>
                            <option value="0">Rp 0</option>
                            <option value="50000">Rp 50.000</option>
                            <option value="75000">Rp 75.000</option>
                            <option value="90000">Rp 90.000</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="denda" class="form-label">Denda kartu hilang: 10.000</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">
                            Kartu anda akan dihapus setelah anda melanjutkan "Buat Kartu".
                        </label>
                        <div class="invalid-feedback">Anda harus menyetujui untuk melanjutkan.</div>
                    </div>
                    <!-- JENIS TRANSAKSI -->
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" value="2" name="id_jenis_transaksi">
                    </div>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" value="<?= $user['saldo'] ?>" name="saldoawal_transaksi">
                    </div>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" value="1" name="id_status_transaksi">
                    </div>
                    <div class="col-sm-9">
                        <br>
                        <button class="btn btn-primary btn-block">Buat Kartu</button>
                        <script>
                            function validateBooking() {
                                Swal.fire({

                                    title: 'Hapus Kartu?',
                                    text: 'Apakah Anda yakin ingin booking kartu? kartu lama anda akan dihapus setelah anda konfirmasi Pengajuan Kartu Hilang',

                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya',
                                    cancelButtonText: 'Tidak'
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        document.querySelector('form').submit();
                                    }
                                });
                            }
                        </script>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>