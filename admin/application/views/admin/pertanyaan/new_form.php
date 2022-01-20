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


					<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
					<?php endif; ?>

					<div class="card mb-3 mt-3">
						<div class="card-header">
							<a href="<?php echo site_url('admin/pertanyaans/') ?>"><i class="material-icons">keyboard_backspace</i>
								Kembali</a>
						</div>
						<div class="card-body">

							<form action="<?php base_url('admin/kategori/add') ?>" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="pertanyaan">Pertanyaan*</label>
									<input class="form-control <?php echo form_error('pertanyaan') ? 'is-invalid' : '' ?>" type="text" name="pertanyaan" placeholder="Pertanyaan" />
									<div class="invalid-feedback">
										<?php echo form_error('name') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="jawaban">Jawaban*</label>
									<input class="form-control <?php echo form_error('jawaban') ? 'is-invalid' : '' ?>" type="text" name="jawaban" placeholder="Jawaban" />
									<div class="invalid-feedback">
										<?php echo form_error('jawaban') ?>
									</div>
								</div>

								<input class="btn btn-success" type="submit" name="btn" value="Simpan" />
							</form>

						</div>

						<div class="card-footer small text-muted">
							* harus diisi
						</div>


					</div>
					<!-- /.container-fluid -->

				</div>
				<!-- /.content-wrapper -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</main>
			<!-- /#wrapper -->

			</main>
		</div>
	</div>

</body>

</html>