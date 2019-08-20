<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content">
<div class="page container search-province">
    <div class="page-container">
        <h1>Eastern Cape</h1>
    </div>
    <div class="page-container page-container__search">
        <form action="<?php echo URLROOT; ?>easternCapeJobs/search" method="get" class="form-inline">
            <input class="job-search form-control" name="search" type="search" placeholder="Search apha">
            <button class="job-search__btn" name="submit">Search</button>
        </form>
    </div>
</div>
<div class="body-container container">
    <div class="right-side col-md-3">
        <div class="sidebar-container">
            <h3>Please note</h3>
            <hr />
            <p>This website is written in isiXhosa. For the English version please click on English.</p>
        </div>
    </div>
    <div class="center-side col-md-7">
        <?php if (!empty($data['imisebenzi'])) { ?>
            <?php echo flash('message_yomsebenzi'); ?>
                <?php foreach ($data['imisebenzi'] as $umsebenzi): ?>
                    <div class="card-lo-msebenzi heading-container">
                        <div class="job-title__index">
                            <a href="<?php echo URLROOT; ?>easternCapeJobs/umsebenzi/<?php echo $umsebenzi->slug; ?>" class="umsebenzi-card__title">
                                <h6>
                                    <?php echo $umsebenzi->gama_le_company; ?> <?php echo $umsebenzi->job_title; ?> <?php echo $umsebenzi->ndawoni_pha; ?>
                                </h6>
                            </a>
                            <?php if (isset($_SESSION['id_yomntu']) && $umsebenzi->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                <div class="follow">
                                    <a href="<?php echo URLROOT; ?>easternCapeJobs/edit/<?php echo $umsebenzi->slug; ?>" class="edit-link follow-btn">Edit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <span>Closing date:</span>
                        <span><?php echo $date->convertDayDate($umsebenzi->closing_date); ?> ka <?php echo $date->convertMonthYear($umsebenzi->closing_date); ?></span>
                        <div class="description-yo__msebenzi">
                            <p class="requirements">Requirements</p>
                            <?php echo $umsebenzi->requirements; ?>
                            <a href="<?php echo URLROOT; ?>easternCapeJobs/umsebenzi/<?php echo $umsebenzi->slug; ?>" style="font-weight: 600">Cofa apha</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div>
                    <div class="pagination">
                        <ul class="pagination-links">
                            <li>1</li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href="">5</a></li>
                            <li><a href="">Next</a></li>
                        </ul>
                    </div>
                </div>
        <?php } else {
             echo "<p>Ingathi akukho msebenzi okhoyo. If uyakwazi ungawufaka nawe. <a href='http://localhost/mvc-app/addJobs/add'>Cofa apha.</a></p>";
        } ?>
    </div>
    <div class="left-side col-md-2">
        <div class="province-header">
            <h4>Ndawoni</h4>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter">
                <li><a href="">Alice</a></li>
                <li><a href="">East London</a></li>
                <li><a href="">Queenstown</a></li>
                <li><a href="">King William's Town</a></li>
                <li><a href="">Uitenhage</a></li>
                <li><a href="">Mthatha</a></li>
                <li><a href="">Cradock</a></li>
                <li><a href="">Port Elizabeth</a></li>
                <li><a href="">Ugie</a></li>
                <li><a href="">Butterworth</a></li>
            </ul>
        </div>
        <div class="province-header">
            <h4>Onjani</h4>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter">
                <li><a href="">Casual</a></li>
                <li><a href="">Contract</a></li>
                <li><a href="">Full-time</a></li>
                <li><a href="">Internship</a></li>
                <li><a href="">Learnership</a></li>
                <li><a href="">Part-time</a></li>
            </ul>
        </div>
        <div class="province-header">
            <h4>Imfundo</h4>
        </div>
        <div class="province-container">
            <ul class="province filter filter-container">
                <li><a href="">Doctorate</a></li>
                <li><a href="">Master's</a></li>
                <li><a href="">Honours/Postgraduate</a></li>
                <li><a href="">Degree/BTech/NQF Level 7</a></li>
                <li><a href="">Diploma/NQF Level 6</a></li>
                <li><a href="">Higher Certificate/NQF Level 5</a></li>
                <li><a href="">Matric/NQF Level 4</a></li>
                <li><a href="">Grade 11/N2/NQF Level 3</a></li>
                <li><a href="">Grade 10/N1/NQF Level 2</a></li>
                <li><a href="">Grade 4 - 9/NQF Level 1</a></li>
            </ul>
        </div>   
        <div class="province-header">
            <h4>Experience</h4>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter">
                <li><a href="">15+ years</a></li>
                <li><a href="">10 - 14 years</a></li>
                <li><a href="">6 - 9 years</a></li>
                <li><a href="">3 - 5 years</a></li>
                <li><a href="">1 - 2 years</a></li>
                <li><a href="">0 years</a></li>
            </ul>
        </div>
        <div class="province-header">
            <h4>Owantoni</h4>
        </div>
        <div class="province-container filter-container">
            <ul class="province filter">
                <li><a href="">Administrative</a></li>
                <li><a href="">Finance</a></li>
                <li><a href="">IT</a></li>
                <li><a href="">Law</a></li>
                <li><a href="">Retail</a></li>
                <li><a href="">Call Center</a></li>
                <li><a href="">Education</a></li>
                <li><a href="">Health</a></li>
                <li><a href="">Engineering</a></li>
                <li><a href="">Security</a></li>
                <li><a href="">General Work</a></li>
                <li><a href="">Transportation</a></li>
                <li><a href="">Government</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>