<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="m-0">Change Password </h1>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                                            <path d="M15 9h.01" />
                                        </svg>Change Password
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <?= view('validation_error'); ?>
                                <?= view('flash_message'); ?>


                                <form action="<?= base_url('/change_password') ?>" method="post">
                                    <input type="hidden" name="id" value="<?php if (isset($edituser)) {
                                                                                echo $edituser['id'];
                                                                            } ?>">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="old_password">Old Password</label>
                                            <input type="password" class="form-control" id="old_password" placeholder="Enter old password" name="old_password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password " name="confirm_password" required>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class=" card-footer">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
            </section>

            <div class="col-sm-12">

            </div>

        </div>
    </div>
</div>

<?= $this->endsection(); ?>