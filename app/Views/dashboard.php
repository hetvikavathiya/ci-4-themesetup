<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="row mt-3">
        <div class="col-sm-12">
            <?= view('validation_error'); ?>
            <?= view('flash_message'); ?>
        </div>

    </div>
</div>
<?= $this->endsection(); ?>