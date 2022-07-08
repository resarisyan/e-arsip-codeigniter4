<?= $this->extend('layout/template'); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url(); ?>/assets/js/iframe.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('customStyle'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/iframe.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-sm-12 col-centered">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" colspan="6">Informasi File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="width: 100px;">No Arsip</th>
                    <th style="width: 30px;">:</th>
                    <td><?= $arsip['no_arsip'] ?></td>
                    <th style="width: 100px;">Tanggal Upload</th>
                    <th style="width: 30px;">:</th>
                    <td><?= $arsip['created_at'] ?></td>
                </tr>
                <tr>
                    <th>Nama Arsip</th>
                    <th>:</th>
                    <td><?= $arsip['nama_arsip'] ?></td>
                    <th>Tanggal Update</th>
                    <th>:</th>
                    <td><?= $arsip['updated_at'] ?></td>
                </tr>
                <tr>
                    <th>Deskrpsi</th>
                    <th>:</th>
                    <td><?= $arsip['deskripsi'] ?></td>
                    <th>Ukuran File</th>
                    <th>:</th>
                    <td><?= $arsip['ukuran_file'] ?></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <th>:</th>
                    <td><?= $arsip['nama_kategori'] ?></td>
                    <th>User</th>
                    <th>:</th>
                    <td><?= $arsip['nama_user'] ?></td>
                </tr>
            </tbody>
        </table>
        <div class="iframe_wrapper">
            <div class="iframe">
                <iframe src="<?= base_url(); ?>/uploads/arsip/<?= $arsip['file_arsip']; ?>" /></iframe>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>