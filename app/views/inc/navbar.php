<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>" title="<?php echo SITENAME; ?>">
      <img src="<?php echo URLROOT; ?>public/img/sm-logo.png" alt="<?php echo SITENAME; ?>" />
    </a>
    <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">Menu</span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>">Imisebenzi <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>pages/chatroom">Chatroom</a>
        </li>
        <?php if (isset($_SESSION['id_yomntu']) ): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['igama_lomntu']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>abantu/logout">Logout</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>abantu/profile/<?php echo $_SESSION['id_yomntu'] ?>">Profile Yakho</a>
          </div>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>abantu/register">Bhalisa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>abantu/login">Ngena</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>