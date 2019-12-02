<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- row untuk jadi satu baris card -->
    <div class="row">

        <div class="col-md-6">
            <div class="card shadow-lg mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="profile">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">My Profile</h5>
                            <p class="card-text"><?= $user['name']; ?></p>
                            <p class="card-text"><?= $user['email']; ?></p>
                            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="profile">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">My Profile</h5>
                            <p class="card-text"><?= $user['name']; ?></p>
                            <p class="card-text"><?= $user['email']; ?></p>
                            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.end raw card -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->