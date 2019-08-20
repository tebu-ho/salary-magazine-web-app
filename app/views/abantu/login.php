<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home">
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="page container">
                    <div class="page-container register-login">
                        <h1>Kungenwa Apha</h1>
                    </div>
                    <?php flash('register_success'); ?>
                </div>
                <div class="card card-body bg-light md-4">
                    <form action="<?php echo URLROOT; ?>abantu/login/" method="post">
                        <div class="form-group">
                            <label for="email">Email Yakho: <sup>*</sup></label>
                            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pasword">Password Yakho: <sup>*</sup></label>
                            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Cofa xa ugqibile" class="btn btn-warning btn-block">
                            </div>
                        </div>
                        <div class="input-label__container">
                        <div class="input-container">
                            <p>Password yakho uyilibele? <a href="<?php echo URLROOT; ?>abantu/password/">Cofa apha</a></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div><div class="page container">
        <div class="page-container register-login">
            <p>Ufuna ukubhalisa? <a href="<?php echo URLROOT; ?>abantu/register/">Cofa apha</a></p>
        </div>
    </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>