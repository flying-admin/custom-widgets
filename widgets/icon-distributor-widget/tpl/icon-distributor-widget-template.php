<div class="fp_icon-distributor">
  <div class="fp_icon-distributor__content">
    <div class="fp_icon-distributor__content__general">
      <?php if($title != ''): ?>
        <h3 class="fp_icon-distributor__content__general__title"><?php echo $title; ?></h3>
      <?php endif; ?>
      <?php if($text != ''): ?>
        <p class="fp_icon-distributor__content__general__desc"><?php echo $text; ?></p>
      <?php endif; ?>
    </div>
    <div class="fp_icon-distributor__content__icons <?php echo "fp_icon-distributor__content__icons--" . $items_row; ?>">
      <?php for ($i = 0; $i < count($items); $i++): ?>
        <div class="fp_icon-distributor__content__icons__item">
          <?php if($items[$i]['icon'] != ''): ?>
            <p class="fp_icon-distributor__content__icons__item__icon"><?php echo siteorigin_widget_get_icon( $items[$i]['icon'] ); ?></p>
          <?php endif; ?>
          <?php if($items[$i]['icon_title'] != ''): ?>
            <p class="fp_icon-distributor__content__icons__item__title"><?php echo $items[$i]['icon_title']; ?></p>
          <?php endif; ?>
          <?php if($items[$i]['icon_text'] != ''): ?>
            <p class="fp_icon-distributor__content__icons__item__desc"><?php echo $items[$i]['icon_text']; ?></p>
          <?php endif; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
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
