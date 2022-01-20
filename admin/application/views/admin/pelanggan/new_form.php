<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<body class="h-100">
	<div class="container-fluid">
		<div class="row">
			<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
			<div class="main-navbar sticky-top bg-white">

				<?php $this->load->view("admin/_partials/navbar.php") ?>
			
			</div>
			<div class="main-content-container container-fluid px-4">

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3 mt-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/pelanggans/') ?>"><i class="material-icons">keyboard_backspace</i> Kembali</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/pelanggan/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
								<label for="nameUser">Nama*</label>
								<input class="form-control <?php echo form_error('nameUser') ? 'is-invalid':'' ?>"
								 type="text" name="nameUser" placeholder="Nama Pengguna" />
								<div class="invalid-feedback">
									<?php echo form_error('nameUser') ?>
								</div>
							</div>
							
							<div class="form-group">
								<label for="emailUser">Email</label>
								<input class="form-control <?php echo form_error('emailUser') ? 'is-invalid':'' ?>"
								 type="text" name="emailUser" placeholder="Email" />
								<div class="invalid-feedback">
									<?php echo form_error('emailUser') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="tlpnUser">Kontak</label>
								<input class="form-control <?php echo form_error('tlpnUser') ? 'is-invalid':'' ?>"
								 type="text" name="tlpnUser" placeholder="Kontak" />
								<div class="invalid-feedback">
									<?php echo form_error('tlpnUser') ?>
								</div>
							</div>

							<div class="form-group">
								<label >Password</label>
								<input class="form-control" type="password" name="passwordUser" placeholder="Password" />
								
							</div>
							
							<div class="form-group">
								<label for="alamatUser">Alamat</label>
								<input class="form-control <?php echo form_error('alamatUser') ? 'is-invalid':'' ?>"
								 type="text" name="alamatUser" placeholder="Alamat" />
								<div class="invalid-feedback">
									<?php echo form_error('alamatUser') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="statusUser">Status</label>
								<select class="form-control" name="statusUser" id="statusUser">
								  
								   <option value="Admin">Admin</option>
								   <option value="Pelanggan">Pelanggan</option>
								   
								</select>
							</div>
							<input class="btn btn-success" type="submit" name="btn" value="Simpan" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


				</div>

			</div>
			<?php $this->load->view("admin/_partials/footer.php") ?>

		</main>
		</div>
    </div>

<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>
