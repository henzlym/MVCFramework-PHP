<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <?php foreach ($data['posts'] as $key => $post) : ?>

        <div class="row mb-5">

            <div class="col-md-6">
                <?php get_alert_message('add_post_success'); ?>
                <h1>
                    <?= $post->post_title; ?>
                </h1>

                <div class="card-meta">



                    <div class="bg-info text-white p-2 mb-3 d-inline-block">
                        <span>
                            <?= $post->username; ?>
                        </span>

                    </div>

                    <div class="bg-light p-2 mb-3 d-inline-block">
                        <span class="post-date">
                            <?= date('M d, Y', strtotime($post->post_date)); ?>
                        </span>
                    </div>

                </div>
            </div>
            <?php if (is_logged_in()) : ?>

            <div class="col-md-6 text-right">

                <div class="post-actions d-flex float-right">

                    <a href="<?= BASE_URL; ?>/posts/edit/<?= $post->postID; ?>" class="btn btn-primary mr-md-3">
                        <i class="fas fa-pencil-alt"></i>
                        Edit Post
                    </a>
                    <form class="" action="<?= BASE_URL; ?>/posts/delete/<?= $post->postID; ?>" method="post">
                        <input type="submit" name="Submit" value="Delete" class="btn btn-danger">
                    </form>
                </div>

            </div>
            <?php endif; ?>
        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body mb-3">
                        <p class="card-text">
                            <?= get_content($post->post_content); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>




    </div>

</div>

<?php require_once APP_PATH . '/views/footer.php'; ?>
