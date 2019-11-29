<nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-5">
  <?php
    // Hämta länken till WordPress installationenen
  ?>
  <a class="navbar-brand" href="<?php echo home_url(); ?>">
    <?php
      // Hämta namnet på WordPress sidan från inställningarna
      bloginfo('name');
    ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primaryMenu" aria-controls="primaryMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="primaryMenu">
     <?php
      // Hämta meny plats primary
      sp_get_nav_menu('primary');

      // Hämta searchform.php
      get_search_form();
    ?>
  </div>
</nav>