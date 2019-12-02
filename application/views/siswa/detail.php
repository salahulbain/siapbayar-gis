<div class="col-lg">
    <div class="form-group">
        <label for="nik">Nomor Induk Kependudakan (NIK)</label>
        <input type="text" class="form-control" id="nik" value="<?= $detail['nik']; ?>">
    </div>
    <div class="form-group">
        <label for="nok">Nomor KK (NOK)</label>
        <input type="text" class="form-control" id="nok" value="<?= $detail['nok']; ?>">
    </div>
    <div class="form-group">
        <label for="nama_siswa">Nama Siswa</label>
        <input type="text" class="form-control" id="nama_siswa" value="<?= $detail['nama_siswa']; ?>">
    </div>
    <div class="form-group">
        <label for="nama_siswa">Jenis Kelamin</label>
        <input type="text" class="form-control" id="nama_siswa" value="<?= $detail['jenis_kelamin']; ?>">
    </div>
</div>
<div class="col-lg">
    <div class="form-group">
        <label for="kelas">Kelas</label>
        <input type="text" class="form-control" id="kelas" value="<?= $detail['kelas']; ?>">
    </div>
    <div class="form-group">
        <label for="nama_ayah">Nama Ayah</label>
        <input type="text" class="form-control" id="nama_ayah" value="<?= $detail['nama_ayah']; ?>">
    </div>
    <div class="form-group">
        <label for="nama_ibu">Nama Ibu</label>
        <input type="text" class="form-control" id="nama_ibu" value="<?= $detail['nama_ibu']; ?>">
    </div>
    <div class="form-group">
        <label for="alamat_ortu">Alamat Lengkap Orang Tua</label>
        <textarea class="form-control" id="alamat_ortu" rows="3" value="<?= $detail['alamat_ortu']; ?>"><?= $detail['alamat_ortu']; ?></textarea>
    </div>
</div>