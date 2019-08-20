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
                <h1>Achievements</h1>
                <div class="card card-body bg-light md-5">
                    <?php echo flash('message_ye_achievements'); ?>
                    <form action="<?php echo URLROOT; ?>abantu/achievements/<?php echo $data['id_yomntu'] ?>" method="post">
                        <div class="form-group">
                            <label for="Achievement name">Achievement name</label>
                            <input type="text" name="achievement_name" class="form-control form-control-lg <?php echo (!empty($data['achievement_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['achievement_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['achievement_name_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="From which company">From which company</label>
                            <input type="text" name="company" class="form-control form-control-lg <?php echo (!empty($data['company_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['company']; ?>">
                            <span class="invalid-feedback"><?php echo $data['company_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Which year">Which year</label>
                            <input type="number" name="year" class="form-control form-control-lg <?php echo (!empty($data['year_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['year']; ?>">
                            <span class="invalid-feedback"><?php echo $data['year_err']; ?></span>
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
                        <li><a href="<?php echo URLROOT; ?>abantu/skills/<?php echo $_SESSION['id_yomntu'] ?>">Skills &amp; Competencies</a></li>
                        <li>Achievements</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>