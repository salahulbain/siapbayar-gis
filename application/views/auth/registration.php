<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block text-center">
          <img src="<?= base_url('assets/'); ?>logo/siap-bayar-kecil.png" alt="logo-image" class="img-circle mt-5 mb-3">
          <h1 class="h4 text-gray-900 mb-1"><b>SIAP</b>-<em>bayar</em></h1>
          <p class="mb-5"><em class="text-primary">Sistem Informasi Aplikasi Pembayaran SPP Online</em></p>
          <p class="lead text-gray-900">SMP ISLAM IBNU KHALDUN BANDA ACEH</p>
        </div>
        <div class="col-lg-7">
          <div class="p-4">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
            </div>
            <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Masukkan nama anda, contoh : Muhammad Saifullah" value="<?= set_value('name'); ?>">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan email anda, contoh : example@gmail.com" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="koreg" name="koreg" placeholder="Kode Registrasi..." value="<?= set_value('koreg'); ?>" maxlength="8">
                <?= form_error('koreg', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password...">
                  <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password...">
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Register Account
              </button>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
            </div>
            <div class="text-center">
              <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>