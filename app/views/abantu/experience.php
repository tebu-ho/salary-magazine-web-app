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
                <h1>Work Experience</h1>
                <div class="card card-body bg-light md-5">
                    <?php echo flash('message_ye_experience'); ?>
                    <form action="<?php echo URLROOT; ?>abantu/experience/<?php echo $data['id_yomntu']; ?>" method="post">
                        <div class="form-group">
                            <label for="Company">Company: <sup>*</sup></label>
                            <input type="text" name="company" class="form-control form-control-lg <?php echo (!empty($data['company_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['company']; ?>">
                            <span class="invalid-feedback"><?php echo $data['company_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Job title">Job title: <sup>*</sup></label>
                            <input type="text" name="job_title" class="form-control form-control-lg <?php echo (!empty($data['job_title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['job_title']; ?>">
                            <span class="invalid-feedback"><?php echo $data['job_title_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Uqale nini">Uqale nini: <sup>*</sup></label>
                            <input type="uqale_nini" name="uqale_nini" class="form-control form-control-lg <?php echo (!empty($data['uqale_nini_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['uqale_nini']; ?>">
                            <span class="invalid-feedback"><?php echo $data['uqale_nini_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input name="usasebenza_apha" class="form-check-input" type="radio" id="ewe_ndiyasebenza" value="Ewe">
                                <label class="form-check-label" for="inlineCheckbox1">Ewe</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="usasebenza_apha" class="form-check-input" type="radio" id="hayi_andisebenzi" value="Hayi">
                                <label class="form-check-label" for="inlineCheckbox2">Hayi</label>
                            </div>
                        </div>
                        <?php //if (isset($_POST['usasebenza_apha']) == "Hayi") : ?>
                        <div class="form-group">
                            <label for="Ugqibe nini">Ugqibe nini</label>
                            <input type="text" name="ugqibe_nini" class="form-control form-control-lg <?php echo (!empty($data['ugqibe_nini_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ugqibe_nini']; ?>">
                            <span class="invalid-feedback"><?php echo $data['ugqibe_nini_err']; ?></span>
                        </div>
                        <?php //endif; ?>
                        <div class="form-group">
                            <label for="Responsibilities">Responsibilities: <sup>*</sup></label>
                            <textarea name="responsibilities" class="form-control form-control-lg <?php echo (!empty($data['responsibilities_err'])) ? 'is-invalid' : ''; ?>">
                                <?php echo $data['responsibilities']; ?>
                            </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'responsibilities' );
                            </script>
                            <span class="invalid-feedback"><?php echo $data['responsibilities_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Reason for leaving">Reason for leaving</label>
                            <input type="text" name="reason_for_leaving" class="form-control form-control-lg <?php echo (!empty($data['reason_for_leaving_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reason_for_leaving']; ?>">
                            <span class="invalid-feedback"><?php echo $data['reason_for_leaving_err']; ?></span>
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
                        <li><a href="<?php echo URLROOT; ?>abantu/education/<?php echo $_SESSION['id_yomntu'] ?>">Education</a></li>
                        <li>Work Experience</li>
                        <li><a href="<?php echo URLROOT; ?>abantu/skills/<?php echo $_SESSION['id_yomntu'] ?>">Skills &amp; Competencies</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/achievements/<?php echo $_SESSION['id_yomntu'] ?>">Achievements</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/cv/<?php echo $_SESSION['id_yomntu'] ?>">CV</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/education/<?php echo $_SESSION['id_yomntu'] ?>">Imisebenzi</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/education/<?php echo $_SESSION['id_yomntu'] ?>">Izaziso</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/education/<?php echo $_SESSION['id_yomntu'] ?>">Magazine</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>