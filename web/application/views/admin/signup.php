<?php $this->load->view("admin/_partials/head.php") ?>


<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top border-bottom" style="background:#fff">
        <div class="container">

            <div class="row kanankiri">
                <a class="navbar-brand" href="<?php echo site_url() ?>">A&F</a>
            </div>

        </div>
    </nav>

    <div class="" style="min-height:800px;">
        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-12 col-md-6 col-lg-4 mx-auto mt-5 formlogin">
                    <p class="h2 mb-5 text-center">Register</p>
                    <form action="<?= site_url('Accounts/register') ?>" method="POST">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control p-2" name="namas" placeholder="Full Name" required />
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control p-2" name="emails" placeholder="Email" required />
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control p-2" name="phones" placeholder="Phone Number" value="62" required />
                            <small class="text-secondary">*) ext : 81374000000</small>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control p-2" name="passwords" placeholder="Password" required />
                        </div>
                        <div class="form-group mb-4">
                            <input type="submit" class="btn btn-success w-100 rounded-pill p-2" value="Register" />
                        </div>

                    </form>

                    <div class="batas mt-5"><span>Have Account?</span></div>

                    <div class="form-group mb-5">
                        <a href="<?php echo site_url('accounts') ?>"><input type="button" class="btn btn-outline-success w-100 rounded-pill p-2" value="Login" /></a>
                    </div>

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view("admin/_partials/footerx.php") ?>
</body>

</html>