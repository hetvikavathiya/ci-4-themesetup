<?php if ($alert = session()->getFlashdata('Flash_message')) : ?>
    <div class="alert alert-<?= $alert['class'] ?> alert-dismissible fade show " role="alert">
        <strong>
            <?= $alert['message']; ?>
        </strong>
        <a class="btn-close btn-close-red" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
<?php endif; ?>