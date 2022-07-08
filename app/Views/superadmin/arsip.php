<?= $this->extend('layout/template'); ?>

<?= $this->section('script'); ?>
<script>
    let urlList = "<?= route_to('superadmin.arsip.ajaxList') ?>";
    let urlSave = "<?= route_to('superadmin.arsip.ajaxSave') ?>";
    let urlEdit = "<?= base_url() ?>/superadmin/arsip/ajaxEdit/";
    let urlUpdate = "<?= base_url() ?>/superadmin/arsip/ajaxUpdate/";
    let urlDelete = "<?= base_url() ?>/superadmin/arsip/ajaxDelete/";
    let urlStatus = "<?= base_url() ?>/superadmin/arsip/ajaxStatus/";
    let urlFile = "<?= base_url(); ?>/uploads/arsip/";
</script>
<script src="<?= base_url(); ?>/ajax/ajaxArsip.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Refresh Data" onclick="reload_table()"><i class="fas fa-sync-alt"></i></a>
                <a href="javascript:void(0)" class="btn btn-primary btn-sm mytambah" data-toggle="tooltip" title="Tambah Data" onclick="show()"><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 5%;">No</th>
                            <th style="text-align: center;">No Arsip</th>
                            <th style="text-align: center;">Nama Arsip</th>
                            <th style="text-align: center;">Kategori</th>
                            <th style="text-align: center;">Upload</th>
                            <th style="text-align: center;">Update</th>
                            <th style="text-align: center;">User</th>
                            <th style="text-align: center;">Departemen</th>
                            <th style="text-align: center;">File</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->include('form_superadmin/form_arsip'); ?>
<?= $this->endSection(); ?>