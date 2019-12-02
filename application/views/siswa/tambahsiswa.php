<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary"><?= $title; ?></h1>

    <!-- card -->
    <div class="card shadow mb-4 py-4 px-4">

        <!-- form Input data -->
        <form method="post" action="<?= base_url('siswa/tambahsiswa'); ?>">
            <div class="row">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="nik">Nomor Induk Kependudakan (NIK)</label>
                        <input type="text" class="form-control" id="nik" name="nik" maxlength="16" value="<?= set_value('nik'); ?>">
                        <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nok">Nomor KK (NOK)</label>
                        <input type="text" class="form-control" id="nok" name="nok" maxlength="16" value="<?= set_value('nok'); ?>">
                        <?= form_error('nok', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= set_value('nama_siswa'); ?>">
                        <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki">
                            <label class="form-check-label" for="jenis_kelamin">
                                Laki-laki
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                            <label class="form-check-label" for="jenis_kelamin">
                                Perempuan
                            </label>
                        </div>
                        <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg">

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="custom-select form-control" id="kelas" name="kelas" type="text">
                            <option value="">-- Pilih kelas --</option> -->
                            <?php foreach ($walikelas as $w) : ?>
                                <option value="<?= $w['kelas_binaan']; ?>"><?= $w['kelas_binaan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>
                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= set_value('nama_ayah'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= set_value('nama_ibu'); ?>">
                        <?= form_error('nama_ibu', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="alamat_ortu">Alamat Lengkap Orang Tua</label>
                        <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3"></textarea>
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