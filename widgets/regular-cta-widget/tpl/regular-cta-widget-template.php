
<div class="fp_regular-cta
  <?php if($background != 'white'): ?> fp_regular-cta--colored <?php endif; ?>
  <?php if($bordered): ?> fp_regular-cta--bordered <?php endif; ?>
">
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="col-sm-12">
        <div class="fp_regular-cta--wrapper">
          <h3 class="fp_regular-cta__main"><?php echo $main; ?></h3>
          <?php if($background != 'white'): ?>
            <a href="<?php echo $cta_url; ?>" class="fp_regular-cta__cta btn btn--block" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
              <?php echo $cta_text; ?>
            </a>
          <?php else: ?>
            <a href="<?php echo $cta_url; ?>" class="fp_regular-cta__cta btn btn--primary btn--block" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
              <?php echo $cta_text; ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
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
