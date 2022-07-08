<?= $this->extend('layout/template'); ?>

<?= $this->section('script'); ?>
<script>
    let urlList = "<?= route_to('admin.user.ajaxList') ?>";
    let urlSave = "<?= route_to('admin.user.ajaxSave') ?>";
    let urlEdit = "<?= base_url() ?>/admin/user/ajaxEdit/";
    let urlUpdate = "<?= base_url() ?>/admin/user/ajaxUpdate/";
    let urlDelete = "<?= base_url() ?>/admin/user/ajaxDelete/";
    let urlStatus = "<?= base_url() ?>/admin/user/ajaxStatus/";
    let urlImg = "<?= base_url(); ?>/uploads/userimg/";
    let urlImgDefault = "<?= base_url('assets/images/default.png'); ?>";
</script>
<script src="<?= base_url(); ?>/ajax/ajaxUser.js"></script>
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
                            <th style="text-align: center;">Foto</th>
                            <th style="text-align: center;">Nama User</th>
                            <th style="text-align: center;">Email</th>
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
<?= $this->include('form_admin/form_user'); ?>
<?= $this->endSection(); ?>