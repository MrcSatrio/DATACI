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
                                <p><?= $booking_code ?><button class="btn copy-button"><img src="<?= base_url() ?>assets/img/kopi.png" width="24px"></button></p>
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
                    <?php if ($jenis_pembayaran == 2) : ?>
                        <div class="mb-3 card-header">
    <center>
        <label for="rekening" class="form-label">No Rekening:</label>
    </center>
    <center>
        <img src="https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/Bank_BTN-512.png" width="50px">
       
        <label style="font-size: 20px;">8415599001 <button class="btn copy-button"><img src="<?= base_url() ?>assets/img/kopi.png" width="24px"></button></label>
        <label style="font-size: 20px;"> YAYASAN PEDULI KAMU </label>
    </center>

    <div class="card-header text-white bg-warning mb-3">
        <center><label>Harap Melakukan Upload Bukti Transfer di Riwayat Transaksi</label></center>
    </div>
</div>

                    <?php elseif ($jenis_pembayaran == 1) : ?>
                        <div class="card-header text-white bg-warning mb-3">
                            <center><label> Silahkan bayar di bagian keuangan</label></center>
                        </div>
                    <?php endif; ?>

                    <br>
                    <!-- kembali ke halaman sebelumnya -->
                    <a href="<?= base_url() ?>user/riwayatTransaksi" class="btn btn-primary btn-block">Kembali</a>
                </div>
                <script>
                    const copyButtons = document.querySelectorAll('.copy-button');
                    copyButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const textToCopy = this.parentNode.parentNode.innerText.trim();
                            const tempInput = document.createElement('input');
                            tempInput.value = textToCopy;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand('copy');
                            document.body.removeChild(tempInput);
                            alert('Teks berhasil disalin!');
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
