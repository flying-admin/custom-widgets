<?php if($background == 'white'){ ?>
  <div class="fp_featured-cta">
    white
<?php } else { ?>
  <div class="fp_featured-cta fp_featured-cta--color">
    color
<?php } ?>

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
