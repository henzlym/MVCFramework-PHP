<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row">

            <div class="col-md-6 mx-auto">

                <div class="card bg-light mt-5">

                    <div class="card-body">
                        <h2>Create Account</h2>
                        <p>Please fill out form to register.</p>
                        <form action="<?= BASE_URL; ?>/users/register" method="post">

                            <div class="form-group">
                                <label for="user_name">Username: <sup>*</sup></label>
                                <input type="text" name="user_name" id="" class="form-control <?= (!empty($data['user_name_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['user_name'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['user_name_error'])) ? $data['user_name_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_email">Email: <sup>*</sup></label>
                                <input type="email" name="user_email" id="" class="form-control <?= (!empty($data['user_email_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['user_email'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['user_email_error'])) ? $data['user_email_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password: <sup>*</sup></label>
                                <input type="password" name="user_password" id="" class="form-control <?= (!empty($data['user_password_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['user_password'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['user_password_error'])) ? $data['user_password_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confrim_password">Confirm Password: <sup>*</sup></label>
                                <input type="password" name="confrim_password" id="" class="form-control <?= (!empty($data['confrim_password_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['confrim_password'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['confrim_password_error'])) ? $data['confrim_password_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <input type="submit" value="Register" class="btn btn-primary btn-block">
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
