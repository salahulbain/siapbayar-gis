<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary"><?= $title; ?></h1>

    <!-- card -->
    <div class="card shadow mb-4 py-4 px-4">
        <!-- form Input data -->
        <form method="post" action="<?= base_url('siswa/tambahtransaksi'); ?>">
            <div class="row">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="nik_siswa">Nomor Induk Kependudakan (NIK)</label>
                        <input type="text" class="form-control" id="nik_siswa" name="nik_siswa" maxlength="16" value="<?= $siswa['nik']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $siswa['nama_siswa']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $siswa['kelas']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="walikelas">Wali Kelas</label>
                        <select class="custom-select form-control" id="walikelas" name="walikelas" type="text">
                            <option value="">-- Pilih Status --</option>
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
    <!-- /.card -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->