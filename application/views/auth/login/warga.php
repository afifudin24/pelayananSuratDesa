<div class="container">
	<div class="row">
		<div class="col-md-5 col-sm-12 mx-auto">
			<div class="card pt-2">
				<div class="card-body">
					<div class="text-center mb-2">
						<img src="<?= base_url() ?>./assets/logo/jpr.png" height="100" class='mb-3'>
						<!-- <h3>Sign In</h3> -->
						<h5><strong>APLIKASI PELAYANAN SURAT</strong></h5>
						<h6><strong>DESA TUNJUNG</strong></h6>

					</div>
					<form action="<?= base_url('user-login-proses'); ?>" method="post" enctype="multipart/form-data">
						<div class="form-group position-relative has-icon-left">
							<label for="nik">NIK</label>
							<div class="position-relative">
								<input type="text" name="nik" class="form-control" id="nik">
								<div class="form-control-icon">
									<i class="bi bi-person-vcard"></i>
								</div>
								<small class="text-center"><?= form_error('nik') ?></small>
							</div>
						</div>
						<div class="form-group position-relative has-icon-left">
							<div class="clearfix">
								<label for="nokk">No KK</label>
							</div>
							<div class="position-relative">
								<input type="password" name="nokk" class="form-control" id="nokk">
								<div class="form-control-icon">
									<i class="bi bi-file-earmark-text"></i>
								</div>
								<small class="text-center"><?= form_error('nokk') ?></small>
							</div>
						</div>

						<!-- <div class='form-check clearfix my-4'>
							<div class="float-right">
								Belum punya akun ? <a href="<?= base_url('user/register') ?>">Register disini !</a>
							</div>
						</div> -->
						<div class="clearfix">
							<a href="<?= base_url('login') ?>" type="button"
								class="btn btn-danger float-left">Kembali</a>
							<button class="btn btn-primary float-right">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>