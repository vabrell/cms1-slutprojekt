<?php
// Kolla om det finns några rader för medarbetare
if (have_rows('staff')) {
  // Medans det finns rader för medarbetare
  while (have_rows('staff')) {
    
    // Ta raden och plocka bort den från listan
    the_row();
    
    // Kolla om bilden skall vara till vänster
    if (get_row_layout() === 'image_left') {
      ?>

      <div class="row mb-3">

      <div class="col-2">
        <?php
          // Hämta bilden på medarbetaren
        ?>
        <img class="img-fluid img-thumbnail" src="<?php echo get_sub_field('image'); ?>">
      </div>

      <div class="col-10">
        <div class="row">
          <div class="col-12">
            <h3 class="text-primary">
            <?php
              // Hämta namnet på medarbetaren
              echo get_sub_field('name');
            ?>
            </h3>
          </div>
          <div class="col-12">
            <?php
              // Hämta e-posten till medarbetaren
              ?>
            <a href="mailto:<?php echo get_sub_field('email'); ?>"><?php echo get_sub_field('email'); ?></a>
          </div>
        </div>
      </div>

      </div>

      <?php
    }

    // Kolla om bilden skall vara till höger
    if (get_row_layout() === 'image_right') {
      ?>

      <div class="row mb-3">

      <div class="col-10 text-right">
        <div class="row">
          <div class="col-12">
            <h3 class="text-primary">
            <?php
              // Hämta namnet på medarbetaren
              echo get_sub_field('name');
            ?>
            </h3>
          </div>
          <div class="col-12">
            <?php
              // Hämta e-posten till medarbetaren
              ?>
            <a href="mailto:<?php echo get_sub_field('email'); ?>"><?php echo get_sub_field('email'); ?></a>
          </div>
        </div>
      </div>

       <div class="col-2">
        <?php
          // Hämta bilden på medarbetaren
        ?>
        <img class="img-fluid img-thumbnail" src="<?php echo get_sub_field('image'); ?>">
      </div>

      </div>
      <?php
    }

  }

}