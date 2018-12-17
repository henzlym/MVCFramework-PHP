<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row mb-5">

            <div class="col-md-6">
                <?php get_alert_message('post_message'); ?>
                <h1>
                    Posts
                </h1>

            </div>
            <?php if (is_logged_in()) : ?>

            <div class="col-md-6 text-right">

                <a href="<?= BASE_URL; ?>/posts/add" class="btn btn-primary pull-right">
                    <i class="fas fa-pencil-alt"></i>
                    Add Post
                </a>

            </div>
            <?php endif; ?>
        </div>

        <div class="row">

            <?php if (!empty($data['posts'])) : ?>
            <?php foreach ($data['posts'] as $key => $post) : ?>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-header">

                        <div class="post-date">
                            <?= $post->post_date; ?>
                        </div>
                    </div>

                    <div class="card-body mb-3">

                        <div class="card-meta">

                            <div class="bg-light p-2 mb-3 d-inline-block">
                                <?= $post->username; ?>
                            </div>
                        </div>
                        <h5 class="card-title">
                            <?= $post->post_title; ?>
                        </h5>
                        <p class="card-text">
                            <?= get_content($post->post_content, true); ?>
                        </p>

                        <a href="<?= BASE_URL; ?>/posts/<?= $post->post_slug; ?>" class="btn btn-dark"> Read More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>

            <div class="col-md-12">

                <h5 class="card-title">
                    No Posts have been published as yet.

                    <a href="<?= BASE_URL; ?>/users/register">Register</a> or

                    <a href="<?= BASE_URL; ?>/users/login">Login</a> to publish a post.
                </h5>

            </div>
            <?php endif; ?>
        </div>

    </div>

</div>

<?php require_once APP_PATH . '/views/footer.php'; ?>
