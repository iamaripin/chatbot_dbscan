<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<body>
    
	<?php $this->load->view("admin/_partials/menu.php") ?>
    <!-- Content -->
    <div class="container">
        <div class="row clearfix py-4 kanankiri">
        <div class="preview col-md-12">

            <div class="page-wrap d-flex flex-row align-items-center" style="height:35vmax;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <span class="display-1 d-block">404</span>
                            <div class="mb-4 lead">Opps...! Halaman tidak ditemukan</div>
                            <a href="<?php echo site_url() ?>" class="btn btn-link">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<?php $this->load->view("admin/_partials/footer.php") ?> 
<?php $this->load->view("admin/_partials/js.php") ?>   
</body>
</html>