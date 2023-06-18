<?= $this->extend('template/index');

$this->section('page_content'); ?>
<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <b> Pengumuman dan Informasi </b>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    </thead>
                    <tbody>
                        <?php
                        $no  = 1;
                        foreach ($berkas as $row) {
                        ?>
                        <tr>
                            <td>
                                <?= $no++; echo"." ?>
                                <label for=""><?= $row->keterangan; ?></label>
                                <embed src="<?= base_url('uploads/berkas/' . $row->berkas); ?>" type="application/pdf"
                                    width="100%" height="500px">
                            </td>
                            <!-- <td><?= $row->keterangan; ?>
                            </td> -->
                            <!-- <td><a class="btn btn-info"
                                    href="<?= base_url(); ?>/berkas/download/<?= $row->id_berkas; ?>">Download</a></td> -->
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?= $this->endSection(); ?>