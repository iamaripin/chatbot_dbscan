<?php $this->load->view("admin/_partials/head.php") ?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top border-bottom" style="background:#fff">
    <div class="container">

        <div class="row kanankiri">
            <a class="navbar-brand" href="<?php echo site_url() ?>"><b>A&F STORE</b></a>
        </div>

    </div>
</nav>

<div class="" style="min-height:800px;">
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-12 col-md-6 col-lg-4 mx-auto mt-5 formlogin">
                <p class="h2 mb-5 text-center">Log in</p>
                <form action="<?= site_url('Accounts/login') ?>" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control p-2" name="email" placeholder="Email" required />
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control p-2" name="password" placeholder="Password" required />
                    </div>
                    <div class="form-group mb-4">
                        <input type="submit" class="btn btn-success w-100 rounded-pill p-2" value="Log in" />
                    </div>

                </form>
            <!--
                <div class="batas mt-5"><span>Belum Punya Akun?</span></div>

                <div class="form-group mb-5">
                    <a href="<?php echo site_url('accounts/signup') ?>"><input type="button" class="btn btn-outline-success w-100 rounded-pill p-2" value="Sign-Up" /></a>
                </div>
-->
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