<?= $this->extend('layout/template'); ?>

<?= $this->section('script'); ?>
<script>
    let urlList = "<?= route_to('admin.kategori.ajaxList') ?>";
    let urlSave = "<?= route_to('admin.kategori.ajaxSave') ?>";
</script>
<script src="<?= base_url(); ?>/ajax/ajaxKategori.js"></script>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah Data" onclick="show()"><i class="fas fa-plus"></i></a>
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Refresh Data" onclick="reload_table()"><i class="fas fa-sync-alt"></i></a>
            </div>
            <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 5%;">No</th>
                            <th style="text-align: center;">Nama Kategori</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->include('form_admin/form_kategori'); ?>
<?= $this->endSection(); ?>