
<div class="fp_featured-cta
  <?php if($background != 'white'): ?> fp_featured-cta--colored <?php endif; ?>
  <?php if($bordered): ?> fp_featured-cta--bordered <?php endif; ?>
">
  <div class="fp_featured-cta--inner">
    <?php if ($icon): ?>
      <div class="row justify-content-center no-gutters">
        <div class="col-xl-6 col-lg-8 col-md-10">
          <div class="fp_featured-cta__icon fp_featured-cta__icon--<?php echo $icon_type; ?>">
            <?php if($icon_type == 'icon'): ?>
              <?php echo siteorigin_widget_get_icon( $icon ); ?>
            <?php endif; ?>
            <?php if($icon_type == 'image'): ?>
              <img src="<?php echo $icon; ?>" alt="">
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <div class="row justify-content-center no-gutters">
      <div class="col-xl-6 col-lg-8 col-md-10">
        <h3 class="fp_featured-cta__main"><?php echo $main; ?></h3>
        <?php if($desc != ''): ?>
          <p class="fp_featured-cta__desc"><?php echo $desc; ?></p>
        <?php endif; ?>
      </div>
    </div>
    <div class="row justify-content-center no-gutters">
      <div class="col-lg-10">
        <?php if($cta_url != '' && $cta_text != ''): ?>
          <?php if($background != 'white'): ?>
            <a href="<?php echo $cta_url; ?>" class="fp_featured-cta__cta btn btn--primary" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
              <span><?php echo $cta_text; ?></span>
            </a>
          <?php else: ?>
            <a href="<?php echo $cta_url; ?>" class="fp_featured-cta__cta btn" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
              <span><?php echo $cta_text; ?></span>
            </a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
