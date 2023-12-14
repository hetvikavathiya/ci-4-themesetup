<?php if (isset($validation)) : ?>
    <div class="col-12">
        <div class="alert alert-danger" role="alert">
            <?= $validation->listErrors() ?>
        </div>
    </div>
<?php endif; ?>