<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            <a class="btn btn-sm btn-primary shadow-sm" href="<?= base_url('siswa'); ?>"><i class="fas fa-user-plus fa-sm"></i> Tambah Transaksi Siswa</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-uppercase text-center thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jumlah Iuran Bulanan (Rp)</th>
                            <th scope="col">Jumlah Bayar (Rp)</th>
                            <th scope="col">Status</th>
                            <!-- <th scope="col">Nama Ayah</th>
                            <th scope="col">Nama Ibu</th> -->
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i; ?></th>
                                <td class="text-center"><?= $t['nik_siswa']; ?></td>
                                <td><?= $t['nama_siswa']; ?></td>
                                <td><?= $t['kelas']; ?></td>
                                <td><?= $t['jmlh_iuran']; ?></td>
                                <td><?= $t['jmlh_bayar']; ?></td>
                                <td><?= $t['status']; ?></td>
                                <td class="text-center">
                                    <a href="#detailModal" data-toggle="modal" class="badge badge-info" data-id="<?= $t['nik_siswa']; ?>" id="custId"><i class="fas fa-fw fa-book-reader fa-sm"></i> Detail</a>
                                    <a href="" class="badge badge-warning"><i class="fas fa-fw fa-edit fa-sm"></i> edit</a>
                                    <a href="#hapusModal" class="badge badge-danger" data-id="<?= $t['nik_siswa']; ?>" id="custId" data-toggle="modal"><i class="far fa-fw fa-trash-alt fa-sm"></i> delete</a>
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