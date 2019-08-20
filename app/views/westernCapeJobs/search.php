<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content">
    <div class="page container search-province">
        <div class="page-container">
            <h1>Western Cape Results</h1>
        </div>
        <div class="page-container page-container__search">
            <form action="<?php echo URLROOT; ?>westernCapeJobs/search" method="GET" class="form-inline">
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
                                <a href="<?php echo URLROOT; ?>westernCapeJobs/umsebenzi/<?php echo $umsebenzi->slug; ?>" class="umsebenzi-card__title">
                                    <h6>
                                        <?php echo $umsebenzi->gama_le_company; ?> <?php echo $umsebenzi->job_title; ?> <?php echo $umsebenzi->ndawoni; ?>
                                    </h6>
                                </a>
                            <?php if (isset($_SESSION['id_yomntu']) && $umsebenzi->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                <div class="follow">
                                    <a href="<?php echo URLROOT; ?>westernCapeJobs/edit/<?php echo $umsebenzi->slug; ?>" class="edit-link follow-btn">Edit</a>
                                </div>
                            <?php endif; ?>
                            </div>
                            <span>Closing date:</span>
                            <span><?php echo $date->convertDayDate($umsebenzi->closing_date); ?> ka <?php echo $date->convertMonthYear($umsebenzi->closing_date); ?></span>
                            <div class="description-yo__msebenzi">
                                <p class="requirements">Requirements</p>
                                <?php echo $umsebenzi->requirements; ?>
                                <a href="<?php echo URLROOT; ?>westernCapeJobs/umsebenzi/<?php echo $umsebenzi->slug; ?>" style="font-weight: 600">Cofa apha</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            <?php } else {
                echo "<p>Ingathi akukho msebenzi okhoyo. If uyakwazi ungawufaka nawe. <a href='http://localhost/mvc-app/addJobs/add'>Cofa apha.</a></p>";
            } ?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>