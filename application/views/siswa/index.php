<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class=" h3 mb-2 text-primary"><?= $title; ?></h1> -->

    <?= $this->session->flashdata('message'); ?>

    <!-- data table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            <a class="btn btn-sm btn-primary shadow-sm" href="<?= base_url('siswa/tambahsiswa'); ?>"><i class="fas fa-user-plus fa-sm"></i> Tambah Siswa</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-uppercase text-center thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($siswa as $s) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i; ?></th>
                                <td class="text-center"><?= $s['nik']; ?></td>
                                <td><?= $s['nama_siswa']; ?></td>
                                <td><?= $s['jenis_kelamin']; ?></td>
                                <td><?= $s['kelas']; ?></td>
                                <td class="text-center">
                                    <a href="#transaksiModal<?= $s['nik']; ?>" class="badge badge-success" data-target="#transaksiModal<?= $s['nik']; ?>" id="custId" data-toggle="modal"><i class="far fa-fw fa-user fa-sm"></i> input transaksi siswa</a>
                                    <a href="#detailModal" data-toggle="modal" class="badge badge-info" data-id="<?= $s['nik']; ?>" id="custId"><i class="fas fa-fw fa-book-reader fa-sm"></i> Detail</a>
                                    <a href="#editModal<?= $s['nik']; ?>" class="badge badge-warning" data-target="#editModal<?= $s['nik']; ?>" id="custId" data-toggle="modal"><i class="fas fa-fw fa-edit fa-sm"></i> edit</a>
                                    <a href="#hapusModal<?= $s['nik']; ?>" class="badge badge-danger" data-target="#hapusModal<?= $s['nik']; ?>" id="custId" data-toggle="modal"><i class="far fa-fw fa-trash-alt fa-sm"></i> delete</a>
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


<!-- Detail Modal-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Siswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- akhir Modal -->


<!-- Hapus Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="hapusModal<?= $s['nik']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form action="<?= base_url('siswa/hapusdatasiswa'); ?>" method="post">
                        <div class="col-lg">
                            <p>Yakin ingin menghapus data siswa berikut?</p>
                            <div class="form-group">
                                <label for="nik">Nomor Induk Kependudakan (NIK)</label>
                                <input type="text" class="form-control" id="nik" value="<?= $s['nik']; ?>" name="nik" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_siswa">Nama</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $s['nama_siswa']; ?>" readonly>
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
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="editModal<?= $s['nik']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form method="post" action="<?= base_url('siswa/editsiswa'); ?>">
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="nik">Nomor Induk Kependudakan (NIK)</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $s['nik']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nok">Nomor KK (NOK)</label>
                                    <input type="text" class="form-control" id="nok" name="nok" maxlength="16" value="<?= $s['nok']; ?>">
                                    <?= form_error('nok', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $s['nama_siswa']; ?>">
                                    <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>

                                    <?php if ($s['jenis_kelamin'] == "Laki-laki") {
                                            $label1 = "Laki-laki";
                                            $label2 = "Perempuan";
                                        } else {
                                            $label1 = "Perempuan";
                                            $label2 = "Laki-laki";
                                        }
                                        ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="<?= $label1; ?>" checked>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            <?= $label1; ?>
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="<?= $label2; ?>">
                                        <label class="form-check-label" for="jenis_kelamin">
                                            <?= $label2; ?>
                                        </label>
                                    </div>
                                    <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select class="custom-select form-control" id="kelas" name="kelas" type="text">
                                        <option value="">-- Pilih kelas --</option>
                                        <option value="VII-1">Kelas VII-1</option>
                                        <option value="VII-2">Kelas VII-2</option>
                                        <option value="VIII-1">Kelas VIII-1</option>
                                        <option value="VIII-2">Kelas VIII-2</option>
                                        <option value="IX-1">Kelas IX-1</option>
                                        <option value="IX-2">Kelas IX-2</option>
                                    </select>
                                    <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $s['nama_ayah']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $s['nama_ibu']; ?>">
                                    <?= form_error('nama_ibu', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_ortu">Alamat Lengkap Orang Tua</label>
                                    <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3" aria-valuemax="<?= $s['nok']; ?>"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('siswa'); ?>">Batal</a>
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

<!-- Transaksi Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="transaksiModal<?= $s['nik']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Tambah Data Transaksi SPP Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- form Input data -->
                    <form method="post" action="<?= base_url('siswa/tambahtransaksi'); ?>">
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="nik_siswa">Nomor Induk Kependudakan (NIK)</label>
                                    <input type="text" class="form-control" id="nik_siswa" name="nik_siswa" value="<?= $s['nik']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $s['nama_siswa']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $s['kelas']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_walikelas">Wali Kelas</label>
                                    <select class="custom-select form-control" id="nama_walikelas" name="nama_walikelas" type="text">
                                        <option value="">-- Pilih Walikelas --</option>
                                        <?php foreach ($walikelas as $w) : ?>
                                            <option value="<?= $w['name']; ?>"><?= $w['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jmlh_iuran">Jumlah Iuran</label>
                                    <input type="text" class="form-control" id="jmlh_iuran" name="jmlh_iuran" value="<?= set_value('jmlh_iuran'); ?>">
                                    <?= form_error('jmlh_iuran', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="nama_ibu">Jumlah Bayar</label>
                                    <input type="text" class="form-control" id="jml_bayar" name="jmlh_bayar" value="<?= set_value('jmlh_bayar'); ?>">
                                    <?= form_error('jmlh_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="custom-select form-control" id="status" name="status" type="text">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('siswa'); ?>">Batal</a>
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
<!-- akhir Transaksi Modal -->