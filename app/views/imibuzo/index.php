<?php require APPROOT .'/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/chatroom-navbar.php'; ?>
<?php $date = new Convert; ?>
    <div class="main-content">
        <div class="page container search-province">
            <div class="page-container">
                <h1>Imibuzo</h1>
            </div>
        </div>
        <div class="body-container container">
            <div class="right-side profile-sidebar">
                <div class="sidebar-container">
                    <h3>Please note</h3>
                    <hr />
                    <p>This website is written in isiXhosa. For the English version please click on English.</p>
                </div>
            </div>
            <div class="center-side profile-content">
                <div class="card-lo-msebenzi heading-container card-lokubuza">
                    <div class="user-feed__meta">
                        <div class="avatar-link">
                            Cofa apha if ufuna ukubuza umbuzo wakho.&nbsp;<a href="<?php echo URLROOT .'imibuzo/buza'; ?>">Cofa apha</a>
                        </div>
                    </div>
                </div>
                <?php echo flash('message_yombuzo'); ?>
                <?php foreach ($data['imibuzo'] as $umbuzo): ?>
                    <div class="card-lo-msebenzi heading-container timeline-card">
                        <div class="user-feed__meta">
                            <div class="avatar-container">
                                <h5><?php echo $umbuzo->igama; ?></h5>
                            </div>
                            <div class="avatar-container">
                                <a href='<?php echo URLROOT ."imibuzo/phendula/$umbuzo->umbuzoId"; ?>'>&nbsp;<span class="timeline-date"><?php echo $date->convertDayDate($umbuzo->buzwe_nini); ?> ka <?php echo $date->convertMonthYear($umbuzo->buzwe_nini); ?></span></span></a>
                            </div>
                            <?php if (isset($_SESSION['id_yomntu']) && $umbuzo->id_yomntu == $_SESSION['id_yomntu']) : ?>
                                <div class="follow">
                                    <a href="<?php echo URLROOT; ?>imibuzo/edit/<?php echo $umbuzo->umbuzoId; ?>" class="edit-link follow-btn">Edit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="content-container">
                            <div class="content">
                                <p><?php echo $umbuzo->umbuzo; ?></p>
                            </div>
                            <div class="social-commentary">
                                <div class="user-to__do">
                                    <a href='<?php echo URLROOT ."imibuzo/phendula/$umbuzo->umbuzoId"; ?>'>
                                        <i class="far fa-comment-alt"></i> Phendula
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="left-side">
                <div class="province-header">
                    <h4>Profile</h4>
                </div>
                <div class="province-container filter-container">
                    <ul class="province filter">
                        <li><a href="">About</a></li>
                        <li><a href="">CV</a></li>
                        <li><a href="">Imisebenzi</a></li>
                        <li><a href="">Izaziso</a></li>
                        <li><a href="">Izikhalazo</a></li>
                        <li><a href="">Abantu</a></li>
                        <li><a href="">Images</a></li>
                        <li><a href="">Magazine</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>