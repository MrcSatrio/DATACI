<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>

<div class="row">
    <div class="col-xl-3 col-md-3 mb-4 mx-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Waktu Saat Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="jam"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3 mb-4 mx-3">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Sisa Saldo
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp<?= number_format($user['saldo']) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menampilkan berkas terbaru -->
<div class="container">
    <?php
    // Mengurutkan array berdasarkan waktu terbaru
    usort($berkas, function ($a, $b) {
        return strtotime($b->created_at) - strtotime($a->created_at);
    });

    // Mengambil satu berkas terbaru
    $berkasTerbaru = array_slice($berkas, 0, 1);
    ?>

    <!-- Menampilkan berkas terbaru -->
    <?php foreach ($berkasTerbaru as $row): ?>
        <tr>
            <td>
                <embed src="<?= base_url('uploads/berkas/' . $row->berkas); ?>" type="application/pdf" width="100%" height="500px">
            </td>
        </tr>
    <?php endforeach; ?>
</div>
<script>
var myVar = setInterval(function() { myTimer() }, 1000);

function myTimer() {
    var d = new Date();
    document.getElementById("jam").innerHTML =  d.toLocaleTimeString();
}
</script>
<?= $this->endSection(); ?>
