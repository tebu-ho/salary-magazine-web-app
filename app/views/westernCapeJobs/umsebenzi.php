<?php require APPROOT .'/views/inc/header.php'; ?>
<?php $date = new Convert; ?>
<div class="main-content">
    <div class="page container">
        <div class="page-container">
            <a href="<?php echo URLROOT; ?>westernCapeJobs"><i class="fas fa-angle-double-left"></i> <span>Buyela emva</span></a>
        </div>
    </div>
    <div class="body-container container">
        <?php require APPROOT .'/views/inc/right-sidebar.php'; ?>
        <div class="center-side col-md-6">
            <div class="card-lo-msebenzi cofa-card-lo__msebenzi heading-container">
                <div class="card-lo-msebenzi__container">
                    <h2><?php echo $data['umsebenzi']->gama_le_company . ' ' . $data['umsebenzi']->job_title . ' ' . $data['umsebenzi']->ndawoni; ?> </h2>
                    <p>Closing date yi <?php echo $date->convertDayDate($data['umsebenzi']->closing_date); ?> ka <?php echo $date->convertMonthYear($data['umsebenzi']->closing_date); ?>.</p>
                </div>
                <div class="description-yo__msebenzi">
                    <p class="requirements">Requirements</p>
                    <?php echo $data['umsebenzi']->requirements; ?>
                    <?php if (!empty($data['umsebenzi']->skills_competencies)) : ?>
                    <p class="requirements">Skills &amp; Competencies</p><?php echo $data['umsebenzi']->skills_competencies; ?>
                    <?php endif; ?>
                    <p class="requirements">Responsibilities</p>
                    <?php echo $data['umsebenzi']->responsibilities; ?>
                    <div class="apply">
                    <a href="<?php echo $data['umsebenzi']->application_mode; ?>" target="_blank" class="job-search__btn">Apply kwi website yale company</a>
                    </div>
                    <div class="contributor">
                        <span>Lomsebenzi ufakwe ngu <?php echo $data['umntu']->igama; ?> nge <?php echo $date->convertDayDate($data['umsebenzi']->created_at); ?> ka <?php echo $date->convertMonthYear($data['umsebenzi']->created_at); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>