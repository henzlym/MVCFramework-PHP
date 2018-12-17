<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row">

            <div class="col">
                <h1>
                    <?= $data->post_title; ?>
                </h1>

            </div>

        </div>

        <div class="row">

            <div class="col">
                <p>
                    <?= $data->post_content; ?>
                </p>
            </div>

        </div>

    </div>

</div>

<?php require_once APP_PATH . '/views/footer.php'; ?>
