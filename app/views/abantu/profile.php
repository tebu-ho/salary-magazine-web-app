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
                <h1>Personal details</h1>
                <div class="card card-body bg-light md-5">
                    <?php echo flash('message_ye_experience'); ?>
                    <form action="<?php echo URLROOT; ?>abantu/profile/<?php echo $data['id']; ?>" method="post">
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
                            <label for="phone number">Phone number</label>
                            <input type="text" name="phone_number" class="form-control form-control-lg <?php echo (!empty($data['phone_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone_number']; ?>">
                            <span class="invalid-feedback"><?php echo $data['phone_number_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Phone yesibini">Phone number yesibini</label>
                            <input type="text" name="phone_number_yesibini" class="form-control form-control-lg <?php echo (!empty($data['phone_number_yesibini_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone_number_yesibini']; ?>">
                            <span class="invalid-feedback"><?php echo $data['phone_number_yesibini_err']; ?></span>
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
                            <label for="zazise">Zazise ngokufutshane</label>
                            <textarea rows="6" placeholder="Bhalangendlela onothanda abantu bakwazi ngayo" name="zazise" class="form-control form-control-lg <?php echo (!empty($data['zazise_err'])) ? 'is-invalid' : ''; ?>">
                                <?php echo ltrim($data['zazise']); ?>
                            </textarea>
                            <span class="invalid-feedback"><?php echo $data['zazise_err']; ?></span>
                        </div>
                        <div class="form-group mb-0">
                            <label for="Uyasebenza">Uyasebenza?</label>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input name="uyasebenza" class="form-check-input" type="radio" id="ewe_ndiyasebenza" value="Ewe">
                                <label class="form-check-label" for="inlineCheckbox1">Ewe</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="uyasebenza" class="form-check-input" type="radio" id="hayi_andisebenzi" value="Hayi">
                                <label class="form-check-label" for="inlineCheckbox2">Hayi</label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label for="Gender">Gender</label>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input name="gender" class="form-check-input" type="radio" id="ewe_ndiyasebenza" value="Female">
                                <label class="form-check-label" for="inlineCheckbox1">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="gender" class="form-check-input" type="radio" id="hayi_andisebenzi" value="Male">
                                <label class="form-check-label" for="inlineCheckbox2">Male</label>
                            </div>
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
                        <li>Personal details</li>
                        <li><a href="<?php echo URLROOT; ?>abantu/education/<?php echo $_SESSION['id_yomntu'] ?>">Education</a></li>
                        <li><a href="<?php echo URLROOT; ?>abantu/experience/<?php echo $_SESSION['id_yomntu'] ?>">Work Experience</a></li>
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