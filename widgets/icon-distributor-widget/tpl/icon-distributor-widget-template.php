<div class="fp_icon-distributor">
  <h2>Icon distributor</h2>
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
