<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row">

            <div class="col-md-6 mx-auto">

                <div class="card bg-light mt-5">

                    <div class="card-body">
                        <?php get_alert_message('register_success'); ?>
                        <h2>Login</h2>
                        <form action="<?= BASE_URL; ?>/users/login" method="post">

                            <div class="form-group">
                                <label for="user_email">Email: <sup>*</sup></label>
                                <input type="email" name="user_email" id="user_email" class="form-control <?= (!empty($data['user_email_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['user_email'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['user_email_error'])) ? $data['user_email_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password: <sup>*</sup></label>
                                <input type="password" name="user_password" id="user_password" class="form-control <?= (!empty($data['user_password_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['user_password'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['user_password_error'])) ? $data['user_password_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <input type="submit" value="Login" class="btn btn-primary btn-block">
                                </div>

                                <div class="col">

                                    <a href="<?= BASE_URL; ?>/users/login" class="btn btn-white btn-block">Have an
                                        account? Login</a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once APP_PATH . '/views/footer.php'; ?>
