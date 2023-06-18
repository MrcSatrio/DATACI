<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">KODE PEMESANAN</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <br>
                        <label for="saldo" class="form-label">kode Pemesanan:</label> <br>
                        <label>
                            <h1>
                                <p><?= $booking_code ?><button id="copyButton" class="btn"><img src="<?= base_url() ?>assets/img/kopi.png" width="24px"></button></p>
                            </h1>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="denda" class="form-label">Total Pembayaran</label> <br>
                        <label>
                            <h1>
                                <p>Rp <?= number_format($nominal_saldo, 0, ',', '.') ?></p>
                            </h1>
                        </label>
                    </div>
                    <div class="card-header text-white bg-warning mb-3">
                        <center><label> Silahkan bayar di bagian keuangan</label></center>
                    </div>
                    <br>
                    <!-- kembali ke halaman sebelumnya -->
                    <a href="<?= base_url() ?>user/riwayatTransaksi" class="btn btn-primary btn-block">Kembali</a>
                </div>
                <script>
                    document.getElementById("copyButton").addEventListener("click", function() {
                        var textToCopy = "<?= $booking_code; ?>";
                        var tempInput = document.createElement("input");
                        tempInput.value = textToCopy;
                        document.body.appendChild(tempInput);
                        tempInput.select();
                        document.execCommand("copy");
                        document.body.removeChild(tempInput);
                        alert("Teks berhasil disalin!");
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>