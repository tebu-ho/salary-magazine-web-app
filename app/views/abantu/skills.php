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
                <h1>Skills and Competencies</h1>
                <div class="card card-body bg-light md-5">
                    <?php echo flash('message_ye_skills'); ?>
                    <form action="<?php echo URLROOT; ?>abantu/skills/<?php echo $data['id_yomntu'] ?>" method="post">
                        <div class="form-group">
                            <label for="Skills sokuqala">Skill sokuqala</label>
                            <input type="text" name="skill_sokuqala" class="form-control form-control-lg <?php echo (!empty($data['skill_sokuqala_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['skill_sokuqala']; ?>">
                            <span class="invalid-feedback"><?php echo $data['skill_sokuqala_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Skill sesibini">Skill sesibini</label>
                            <input type="text" name="skill_sesibini" class="form-control form-control-lg <?php echo (!empty($data['skill_sesibini_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['skill_sesibini']; ?>">
                            <span class="invalid-feedback"><?php echo $data['skill_sesibini_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Skill sesithathu">Skill sesithathu</label>
                            <input type="text" name="skill_sesithathu" class="form-control form-control-lg <?php echo (!empty($data['skill_sesithathu_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['skill_sesithathu']; ?>">
                            <span class="invalid-feedback"><?php echo $data['skill_sesithathu_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Skill sesine">Skill sesine</label>
                            <input type="text" name="skill_sesine" class="form-control form-control-lg <?php echo (!empty($data['skill_sesine_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['skill_sesine']; ?>">
                            <span class="invalid-feedback"><?php echo $data['skill_sesine_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Skills sesihlanu">Skills sesihlanu</label>
                            <input type="text" name="skill_sesihlanu" class="form-control form-control-lg <?php echo (!empty($data['skill_sesihlanu_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['skill_sesihlanu']; ?>">
                            <span class="invalid-feedback"><?php echo $data['skill_sesihlanu_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Skill sesithandathu">Skill sesithandathu</label>
                            <input type="text" name="skill_sesithandathu" class="form-control form-control-lg <?php echo (!empty($data['skill_sesithandathu_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['skill_sesithandathu']; ?>">
                            <span class="invalid-feedback"><?php echo $data['skill_sesithandathu_err']; ?></span>
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
                        <li><a href="<?php echo URLROOT; ?>abantu/experience/<?php echo $_SESSION['id_yomntu'] ?>">Work Experience</a></li>
                        <li>Skills &amp; Competencies</li>
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