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
                Data Berkas
            </div>
            <div class="card-body">
                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
                <?php endif; ?>
                <a href="<?= base_url(); ?>keuangan/form_upload" class="btn btn-primary">Upload</a>
                <hr />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no  = 1;
                        foreach ($berkas as $row) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <embed src="<?= base_url('uploads/berkas/' . $row->berkas); ?>" type="application/pdf"
                                    width="100%" height="700px">
                            </td>
                            <td width="200px"><?= $row->keterangan; ?>
                            </td>
                            <td>
                                <form action="<?= base_url(); ?>keuangan/berkas/delete/<?= $row->id_berkas; ?>" method="POST"
                                    style="display: inline;">
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus berkas ini?')">Delete</button>
                                </form>
                            </td>
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