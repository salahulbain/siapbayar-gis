<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?= $this->session->flashdata('message'); ?>

    <!-- data table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            <a class="btn btn-sm btn-primary shadow-sm" href="<?= base_url('walikelas/tambahwalikelas'); ?>"><i class="fas fa-user-plus fa-sm"></i> Tambah Walikelas</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-uppercase text-center thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas Binaan</th>
                            <th scope="col">username Walikelas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($walikelas as $w) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i; ?></th>
                                <td><?= $w['name']; ?></td>
                                <td><?= $w['kelas_binaan']; ?></td>
                                <td><?= $w['email']; ?></td>
                                <td class="text-center">
                                    <a href="#editModal<?= $w['id']; ?>" class="badge badge-warning" data-target="#editModal<?= $w['id']; ?>" id="custId" data-toggle="modal"><i class="fas fa-fw fa-edit fa-sm"></i> edit</a>
                                    <a href="#hapusModal<?= $w['id']; ?>" class="badge badge-danger" data-target="#hapusModal<?= $w['id']; ?>" id="custId" data-toggle="modal"><i class="far fa-fw fa-trash-alt fa-sm"></i> delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Hapus Modal-->
<?php foreach ($walikelas as $w) : ?>
    <div class="modal fade" id="hapusModal<?= $w['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Walikelas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form action="<?= base_url('walikelas/hapuswalikelas'); ?>" method="post">
                        <div class="col-lg">
                            <p>Yakin ingin menghapus data Walikelas berikut?</p>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" value="<?= $w['name']; ?>" name="name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $w['email']; ?>" readonly>
                            </div>
                            <button class="btn btn-info" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                            <button type="submit" class="btn btn-danger btn-ok"><i class="fas fa-trash-alt"></i> Hapus</button>
                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- akhir hapus Modal -->

<!-- edit Modal-->
<?php foreach ($walikelas as $w) : ?>
    <div class="modal fade" id="editModal<?= $w['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Walikelas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form method="post" action="<?= base_url('siswa/editwalikelas'); ?>">
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="email">Username Walikelas</label>
                                    <input type="text" class="form-control" id="email" name="email" maxlength="16" value="<?= $w['email']; ?>" readonly>

                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $w['name']; ?>">
                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="Kelas Binaan">Kelas Binaan</label>
                                    <input type="text" class="form-control" id="kelas_binaan" name="kelas_binaan" value="<?= $w['kelas_binaan']; ?>">
                                    <?= form_error('kelas_binaan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('walikelas'); ?>">Batal</a>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- akhir form input -->

                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- akhir edit Modal -->