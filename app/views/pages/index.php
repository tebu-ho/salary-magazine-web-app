<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content__home">
    <div class="body-container container home">
        <h1 class="display-3"><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
        <div class="right-side">
            <div class="province-header">
                <h2>Provinces</h2>
            </div>
            <div class="province-container">
                <ul class="province-ul">
                    <?php  foreach ($data['provinces'] as $province): ?>
                        <li>
                            <?php
                                $provinceJobController = '';
                                switch ($province) {
                                    case $province == 'Eastern Cape':
                                        $provinceJobController = 'easternCapeJobs';
                                        break;
                                    case $province == 'Free State':
                                        $provinceJobController = 'freeStateJobs';
                                        break;
                                    case $province == 'Gauteng':
                                        $provinceJobController = 'gautengJobs';
                                        break;
                                    case $province == 'KwaZulu-Natal':
                                        $provinceJobController = 'kwaZuluNatalJobs';
                                        break;
                                    case $province == 'Limpopo':
                                        $provinceJobController = 'limpopoJobs';
                                        break;
                                    case $province == 'Mpumalanga':
                                        $provinceJobController = 'mpumalangaJobs';
                                        break;
                                    case $province == 'North West':
                                        $provinceJobController = 'northWestJobs';
                                        break;
                                    case $province == 'Northern Cape':
                                        $provinceJobController = 'northernCapeJobs';
                                        break;
                                    case $province == 'Western Cape':
                                        $provinceJobController = 'westernCapeJobs';
                                        break;
                                }
                            ?>
                            <a href="<?php echo $provinceJobController; ?>/">
                                <?php echo $province; ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="full-width">
            <div class="container">
                <div class="cta-row">
                    <div class="cta-col">
                        <h2><?php echo $data['cta_heading']; ?></h2>
                        <p><?php echo $data['cta_content']; ?></p>
                    </div>
                    <div class="cta-btn-col">
                        <a href="abantu/login" class="job-search__btn">Cofa Apha</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>