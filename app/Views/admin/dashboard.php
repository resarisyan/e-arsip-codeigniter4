<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline mx-auto">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/uploads/userimg/<?= $data_user['foto']; ?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"></h3>
                <p class="text-muted text-center"><?= $data_user['nama_user']; ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?= $data_user['email'];  ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Level</b> <span class="float-right"><?= $data_user['level'] == 1 ? 'Admin' : 'User'  ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Departemen</b> <span class="float-right"><?= $data_user['nama_departemen']; ?></span>
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_arsip ?></h3>
                <p>Total Arsip</p>
            </div>
            <div class="icon">
                <i class="ion ion-archive"></i>
            </div>
            <a href="<?= route_to('admin.arsip') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $total_kategori ?><sup style="font-size: 20px">%</sup></h3>
                <p>Total Kategori</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= route_to('superadmin.kategori') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $total_user ?></h3>
                <p>User Registrasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= route_to('superadmin.user') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
</div <?= $this->endSection(); ?>