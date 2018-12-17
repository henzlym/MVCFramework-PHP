<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row">

            <div class="col">

                <a href="<?= BASE_URL; ?>/posts" class="btn btn-secondary"> <i class="fas fa-long-arrow-alt-left"></i></i>
                    Back to
                    Posts</a>

                <div class="card bg-light mt-5">

                    <div class="card-body">
                        <?php get_alert_message('register_success'); ?>
                        <h2 class="mb-5">Add Post</h2>
                        <form action="<?= BASE_URL; ?>/posts/add" method="post">

                            <div class="form-group">
                                <label for="post_title">Post Title: <sup>*</sup></label>
                                <input type="text" name="post_title" id="post_title" class="form-control <?= (!empty($data['post_title_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['post_title'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['post_title_error'])) ? $data['post_title_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="post_content">Post Content: <sup>*</sup></label>
                                <textarea type="text" name="post_content" id="post_content" class="form-control <?= (!empty($data['post_content_error'])) ? 'is-invalid' : ''; ?>"
                                    rows="10"><?= $data['post_content'] ?></textarea>

                                <div class="invalid-feedback">
                                    <?= (!empty($data['post_content_error'])) ? $data['post_content_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <input type="submit" value="Publish" class="btn btn-success btn-block">
                                </div>

                                <div class="col">
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
