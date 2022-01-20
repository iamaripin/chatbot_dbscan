<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>

    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="<?php echo base_url('styles/bootstrap.min.css') ?>" />
</head>

<body style="background:#629b07;color:#fff;">

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 text-center mt-5 mx-auto p-4">
                <h1 class="h2"><b>A&F STORE</b></h1>
                <p class="lead">Hello Admin, Silahkan Login!</p>
            </div>
            <div class="col-12 col-md-4 mx-auto mt-3" style="background:#fff;color:#000;padding:20px;border:5px solid #456b09;border-radius:10px;">

                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('admin/login') ?>" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email.." required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password.." required />
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="rememberme" id="rememberme" />
                                <label class="custom-control-label" for="rememberme"> Ingat Saya</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Login" />
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>