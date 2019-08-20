<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content">
    <div class="page container search-province">
        <div class="page-container">
            <h1>KwaZulu-Natal</h1>
        </div>
        <div class="page-container page-container__search">
            <form action="<?php echo URLROOT; ?>kwaZuluNatalJobs/search" method="GET" class="form-inline">
                <input class="job-search form-control" name="search" type="search" placeholder="Search apha">
                <button class="job-search__btn">Search</button>
            </form>
        </div>
    </div>
    <div class="body-container container">
        <div class="right-side">
            <div class="sidebar-container">
                <h3>Please note</h3>
                <hr />
                <p>This website is written in isiXhosa. For the English version please click on English.</p>
            </div>
        </div>
        <div class="center-side">
            <?php if (!empty($data['imisebenzi'])) { ?>
                <?php echo flash('message_yomsebenzi'); ?>
                <?php foreach ($data['imisebenzi'] as $umsebenzi): ?>
                    <div class="card-lo-msebenzi heading-container">
                        <div>
                            <a href="<?php echo URLROOT; ?>kwaZuluNatalJobs/umsebenzi/<?php echo $umsebenzi->slug; ?>" class="umsebenzi-card__title">
                                <h6>
                                    <?php echo $umsebenzi->gama_le_company; ?> <?php echo $umsebenzi->job_title; ?> <?php echo $umsebenzi->ndawoni; ?>
                                </h6>
                            </a>
                        </div>
                        <span>Closing date:</span>
                        <span><?php echo $date->convertDayDate($umsebenzi->closing_date); ?> ka <?php echo $date->convertMonthYear($umsebenzi->closing_date); ?></span>
                        <div class="description-yo__msebenzi">
                            <p class="requirements">Requirements</p>
                            <ul>
                                <li>Minimum of 2 years of experience organising, assembling, tagging and managing content through technical software and/or CMS systems.</li>
                            </ul>
                            <a href="<?php echo URLROOT; ?>kwaZuluNatalJobs/umsebenzi/<?php echo $umsebenzi->slug; ?>" style="font-weight: 600">Cofa apha</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div>
                    <div class="pagination" style="display:none">
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
        <div class="col-md-2"></div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>