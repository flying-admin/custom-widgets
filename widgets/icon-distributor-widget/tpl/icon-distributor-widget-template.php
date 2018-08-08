<div class="fp_icon-distributor">
  <h2>Icon distributor</h2>
  <?php for ($i = 0; $i < count($items); $i++): ?>
    <p>
      <?php echo siteorigin_widget_get_icon( $items[$i]['icon'] ); ?>
    </p>
    <p>
      <?php echo $items[$i]['icon_title']; ?>
    </p>
    <p>
      <?php echo $items[$i]['icon_text']; ?>
    </p>
  <?php endfor; ?>
</div>

<?php
  foreach ($instance as $key => $value) {
    echo $key . ': ' . $value . '<br/>';
    if (is_array($value)){
      foreach ($value as $k => $v) {
        echo '- '.$k . ': ' . $v . '<br/>';
        if (is_array($value)){
          foreach ($v as $k2 => $v2) {
            echo '- - '.$k2 . ': ' . $v2 . '<br/>';
          }
        }
      }
      echo '<br/>';
    }
  }
?>
