<?php $this->load->view("admin/_partials/head.php") ?>


<?php $this->load->view("admin/_partials/menu.php") ?>
<div class="container">
	<div class="row kanankiri bg-white pads">

		<?php if ($this->session->flashdata('success')) : ?>
			<div class="alert alert-success" role="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
		<?php endif; ?>
		<br>
		<!-- Card  -->
		<div class="card mb-3 mt-3">
			<div class="card-header">
				<b>Profil </b>
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="nameKaryawan">Nama*</label>
							<input class="form-control" type="text" name="nameKaryawan" placeholder="Nama Pengguna" value="<?php echo $profil->nameUser ?>" disabled />
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="nikKaryawan">Email</label>
							<input class="form-control" type="text" name="nikKaryawan" min="0" placeholder="Username" value="<?php echo $profil->emailUser ?>" disabled />
						</div>
					</div>
				</div>


				<form action="<?php base_url("admin/profil/edit") ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $profil->idUser ?>" />
					<div class="row">

						<div class="col-lg-4 mb-3">
							<div class="form-group">
								<label for="passwordKaryawan">Update Password</label>
								<input class="form-control" type="password" name="passwordKaryawan" min="0" placeholder="Diisi jika ada perubahan" value="" />
							</div>

						</div>
						<div class="col-lg-12 mb-3">
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</div>
					</div>
				</form>

			</div>

		</div>

	</div>
</div>
<?php $this->load->view("admin/_partials/footer.php") ?>

<?php $this->load->view("admin/_partials/js.php") ?>
</body>

</html>