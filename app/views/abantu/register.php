<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home">
    <div class="page container">
        <div class="page-container register-login">
            <h1>Kubhaliswa Apha</h1>
        </div>
    </div>
    <div class="body-container container home">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body bg-light md-5">
                    <form action="<?php echo URLROOT; ?>abantu/register/" method="post">
                        <div class="form-group">
                            <label for="igama lakho">Igama lakho: <sup>*</sup></label>
                            <input type="text" name="igama" class="form-control form-control-lg <?php echo (!empty($data['igama_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['igama']; ?>">
                            <span class="invalid-feedback"><?php echo $data['igama_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="fani yakho">Fani Yakho: <sup>*</sup></label>
                            <input type="text" name="fani" class="form-control form-control-lg <?php echo (!empty($data['fani_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['fani']; ?>">
                            <span class="invalid-feedback"><?php echo $data['fani_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email: <sup>*</sup></label>
                            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="province_yakho">Province: <sup>*</sup></label>
                            <select name="province" class="form-control" id="">
                                <?php  foreach ($choose->provinces as $province): ?>
                                        <option class="form-control" value=" <?php echo $province; ?>"> <?php echo $province; ?></option>
                                <?php endforeach ?>
                            </select>
                            <input type="text" name="province" class="form-control form-control-lg <?php echo (!empty($data['province_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['province']; ?>">
                            <span class="invalid-feedback"><?php echo $data['province_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="ndawoni">Ndawoni: <sup>*</sup></label>
                            <input type="text" name="ndawoni" class="form-control form-control-lg <?php echo (!empty($data['ndawoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ndawoni']; ?>">
                            <span class="invalid-feedback"><?php echo $data['ndawoni_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pasword">Password: <sup>*</sup></label>
                            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                            <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Register" class="btn btn-light btn-block">
                            </div>
                        </div>
                        <div class="input-label__container">
                        <div class="input-container">
                            <p>Ukuba wakhe wabhalisa <a href="<?php echo URLROOT; ?>abantu/login/">cofa apha</a></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>