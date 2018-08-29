<div class="fp_multi-distributor">
  <div class="fp_multi-distributor__header">
    <h2 class="fp_multi-distributor__header__title title_text"><?php echo $title; ?></h2>
    <p class="fp_multi-distributor__header__text regular_text"><?php echo $text; ?></p>
  </div>

  <div class="fp_multi-distributor__content
  fp_multi-distributor__content--col-<?php echo $items_row; ?>
  fp_multi-distributor__content--type-<?php echo $items_type; ?>
  ">

    <?php for($i = 0; $i < count($items); $i++): ?>
      <div class="fp_multi-distributor__content__item">
        <?php if($items_type == 'normal'): ?>
          <div class="fp_multi-distributor__content__item__figure fp_multi-distributor__content__item__figure--image">
            <img src="<?php echo $items[$i]['image_url']; ?>" alt="" class="fp_multi-distributor__content__item__figure__image">
          </div>
        <?php endif; ?>
        <?php if($items_type == 'icons'): ?>
          <div class="fp_multi-distributor__content__item__figure fp_multi-distributor__content__item__figure--icon" style="background-color: <?php echo $items[$i]['icon_bgcolor'] ?>;">
            <p class="fp_multi-distributor__content__item__figure__icon" style="color: <?php echo $items[$i]['icon_color'] ?>;">
              <?php echo siteorigin_widget_get_icon( $items[$i]['icon'] ); ?>
            </p>
          </div>
        <?php endif; ?>

        <div class="fp_multi-distributor__content__item__info">
          <p class="fp_multi-distributor__content__item__info__title medium_text">
            <?php echo $items[$i]['item_title']; ?>
          </p>
          <p class="fp_multi-distributor__content__item__info__text medium_text">
            <?php echo $items[$i]['item_text']; ?>
          </p>
          <a href="<?php $items[$i]['item_link_url'] ?>" class="fp_multi-distributor__content__item__info__link link-text" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
            <?php echo $items[$i]['item_link_text']; ?>
          </a>
        </div>

      </div>
    <?php endfor; ?>

  </div>

</div>

<?php
  foreach ($items as $key => $value) {
    echo $key . ': ' . $value . '<br/>';
    if (is_array($value)){
      foreach ($value as $k => $v) {
        echo '- '.$k . ': ' . $v . '<br/>';
        if (is_array($v)){
          foreach ($v as $k2 => $v2) {
            echo '- - '.$k2 . ': ' . $v2 . '<br/>';
            if (is_array($v2)){
              foreach ($v2 as $k3 => $v3) {
                echo '- - - '.$k3 . ': ' . $v3 . '<br/>';
                if (is_array($v3)){
                  foreach ($v3 as $k4 => $v4) {
                    echo '- - - - '.$k4 . ': ' . $v4 . '<br/>';
                  }
                }
              }
            }
          }
        }
      }
      echo '<br/>';
    }
  }
?>