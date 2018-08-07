
<div class="fp_featured-cta
  <?php if($background != 'white'): ?> fp_featured-cta--colored <?php endif; ?>
  <?php if($bordered): ?> fp_featured-cta--bordered <?php endif; ?>
">
  <?php if ($icon): ?>
    <div class="row justify-content-center no-gutters">
      <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="fp_featured-cta__icon">
          <?php echo siteorigin_widget_get_icon( $icon ); ?>
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
    <div class="col-xl-6 col-lg-8 col-md-10">
      <?php if($background != 'white'): ?>
        <a href="<?php echo $cta_url; ?>" class="fp_featured-cta__cta btn btn--block" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
          <?php echo $cta_text; ?>
        </a>
      <?php else: ?>
        <a href="<?php echo $cta_url; ?>" class="fp_featured-cta__cta btn btn--primary btn--block" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
          <?php echo $cta_text; ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
  foreach ($instance as $key => $value) {
    echo $key . ': ' . $value . '<br/>';
    if (is_array($value)){
      foreach ($value as $k => $v) {
        echo '- '.$k . ': ' . $v . '<br/>';
      }
      echo '<br/>';
    }
  }
?>
