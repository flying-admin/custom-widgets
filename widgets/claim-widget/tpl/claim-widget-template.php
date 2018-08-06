<?php if($veil): ?>
  <div class="fp_claim" style="background-image: url('<?php echo $image_url; ?>');">
<?php else: ?>
  <div class="fp_claim fp_claim--no-veil" style="background-image: url('<?php echo $image_url; ?>');">
<?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="fp_claim__content">
          <h2 class="fp_claim__content__title"><?php echo $claim; ?></h2>
          <?php if($text != ''): ?>
            <p class="fp_claim__content__text"><?php echo $text; ?></p>
          <?php endif; ?>
          <?php if($cta_text != '' && $cta_url != ''): ?>
            <a href="<?php echo $cta_url; ?>" class="btn btn--ghost fp_claim__content__cta" <?php if($new_window): ?> target="_blank" <?php endif; ?>><?php echo $cta_text; ?></a>
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
