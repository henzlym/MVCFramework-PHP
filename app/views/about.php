<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="row">

        <div class="col">
            <h1>
                <?= $data['title']; ?>
            </h1>

        </div>

    </div>

    <div class="row">

        <div class="col">
            <p>
                <?= $data['description']; ?>
            </p>
        </div>

    </div>

</div>

<?php require_once APP_PATH . '/views/footer.php'; ?>
