<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary"><?= $title; ?></h1>

    <!-- card -->
    <div class="card shadow mb-4 py-4 px-4">

        <!-- form Input data -->
        <form method="post" action="<?= base_url('walikelas/tambahwalikelas'); ?>">
            <div class="row">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="kelas_binaan">Kelas Binaan</label>
                        <input type="text" class="form-control" id="kelas_binaan" name="kelas_binaan" value="<?= set_value('nama_siswa'); ?>">
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
    <!-- /.card -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->