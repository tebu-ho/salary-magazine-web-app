<?php require APPROOT .'/views/inc/header.php'; ?>
    <div class="main-content">
        <div class="body-container container">
            <div class="right-side profile-sidebar">
                <div class="sidebar-container">
                    <h2>Please note</h2>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="center-side profile-content">
                <h1>Education</h1>
                <div class="card card-body bg-light md-5">
                    <?php echo flash('message_ye_education'); ?>
                    <form action="<?php echo URLROOT; ?>abantu/education/<?php echo $data['id']; ?>" method="post">
                        <div class="form-group">
                            <label for="Ubufunda phi">Ubufunda phi: <sup>*</sup></label>
                            <input type="text" name="ubufunda_phi" class="form-control form-control-lg <?php echo (!empty($data['ubufunda_phi_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ubufunda_phi']; ?>">
                            <span class="invalid-feedback"><?php echo $data['ubufunda_phi_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Ubusenza ntoni">Ubusenza ntoni: <sup>*</sup></label>
                            <input type="text" name="ubusenza_ntoni" class="form-control form-control-lg <?php echo (!empty($data['ubusenza_ntoni_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ubusenza_ntoni']; ?>">
                            <span class="invalid-feedback"><?php echo $data['ubusenza_ntoni_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Ugqibe nini">Ugqibe nini: <sup>*</sup></label>
                            <input type="text" name="ugqibe_nini" class="form-control form-control-lg <?php echo (!empty($data['ugqibe_nini_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ugqibe_nini']; ?>">
                            <span class="invalid-feedback"><?php echo $data['ugqibe_nini_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col flex">
                                <button class="form-btn__primary">Cofa xa Ugqibile</button>
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
            <div class="left-side">
                <div class="province-header">
                    <h4>Profile</h4>
                </div>
                <div class="province-container filter-container">
                    <ul class="province filter">
                        <li><a href="<?php echo URLROOT; ?>abantu/profile/<?php echo $_SESSION['id_yomntu'] ?>">Personal details</a></li>
                        <li>Education</li>
                        <li><a href="<?php echo URLROOT; ?>abantu/experience/<?php echo $_SESSION['id_yomntu'] ?>">Work Experience</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/skills/<?php echo $_SESSION['id_yomntu'] ?>">Skills &amp; Competencies</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/achievements/<?php echo $_SESSION['id_yomntu'] ?>">Achievements</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/cv/<?php echo $_SESSION['id_yomntu'] ?>">CV</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/imisebenzi/<?php echo $_SESSION['id_yomntu'] ?>">Imisebenzi</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/izaziso/<?php echo $_SESSION['id_yomntu'] ?>">Izaziso</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/profile/<?php echo $_SESSION['id_yomntu'] ?>">Magazine</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>