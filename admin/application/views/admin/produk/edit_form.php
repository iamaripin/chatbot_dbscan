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

					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
					<?php endif; ?>

					<!-- Card  -->
					<div class="card mb-3 mt-3">
						<div class="card-header">

							<a href="<?php echo site_url('admin/produks/') ?>"><i class="material-icons">keyboard_backspace</i>
								Kembali</a>
						</div>
						<div class="card-body">

							<form action="<?php base_url(" admin/produk/edit") ?>" method="post" enctype="multipart/form-data">

								<input type="hidden" name="id" value="<?php echo $produk->idProduk; ?>" />

								<div class="row">
									<div class="form-group col-lg-8">
										<label>Nama*</label>
										<input class="form-control<?php echo form_error('nameProduk') ? 'is-invalid' : '' ?>" type="text" name="nameProduk" placeholder="Nama Produk" value="<?php echo $produk->nameProduk; ?>" required />
										<div class="invalid-feedback">
											<?php echo form_error('nameProduk') ?>
										</div>
									</div>

									<div class="form-group col-lg-4">
										<label>Kode*</label>
										<input class="form-control<?php echo form_error('kdProduk') ? 'is-invalid' : '' ?>" type="text" name="kdProduk" placeholder="Kode Produk" value="<?php echo $produk->kdProduk; ?>" required />
										<div class="invalid-feedback">
											<?php echo form_error('kdProduk') ?>
										</div>
									</div>
								</div>


								<div class="form-group">
									<label>Kategori Produk*</label>
									<input class="form-control" type="text" name="katProduk" value="<?php echo $produk->katProduk; ?>" placeholder="Kategori Produk" />
								</div>

								<div class="form-group">
									<label>Keterangan*</label>
									<textarea class="form-control ckeditor <?php echo form_error('descProduk') ? 'is-invalid' : '' ?>" name="descProduk" placeholder="Deskripsi" required />
									<?php echo $produk->descProduk; ?>
									</textarea>
									<div class="invalid-feedback">
										<?php echo form_error('descProduk') ?>
									</div>
								</div>

								<div class="form-group">
									<label>Foto Produk*</label>
									<input class="form-control col-lg-4" type="file" name="image" accept="image/*" />

								</div>

								<div class="form-group">
									<label>Harga Produk*</label>
									<input class="form-control <?php echo form_error('hargaProduk') ? 'is-invalid' : '' ?>" type="number" name="hargaProduk" placeholder="Nominal" min="0" value="<?php echo $produk->hargaProduk; ?>" required />
									<div class="invalid-feedback">
										<?php echo form_error('hargaProduk') ?>
									</div>
								</div>

								<input class="btn btn-success" type="submit" name="btn" value="Simpan" />

							</form>

						</div>


					</div>

				</div>
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</main>
		</div>
	</div>


	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>
	<script>
		function deleteConfirm(url) {
			$('#btn-tolak').attr('href', url);
			$('#deleteModal2').modal();
		}
	</script>

</body>

</html>