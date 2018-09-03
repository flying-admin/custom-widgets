<div class="fp_multi-distributor">
  <div class="fp_multi-distributor--inner">

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
            <?php if($items[$i]['image_url'] != ''): ?>
              <div class="fp_multi-distributor__content__item__figure fp_multi-distributor__content__item__figure--image">
                <img src="<?php echo $items[$i]['image_url']; ?>" alt="" class="fp_multi-distributor__content__item__figure__image">
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <?php if($items_type == 'icons'): ?>
            <?php if($items[$i]['icon'] != ''): ?>
              <div class="fp_multi-distributor__content__item__figure fp_multi-distributor__content__item__figure--icon" style="background-color: <?php echo $items[$i]['icon_bgcolor'] ?>;">
                <p class="fp_multi-distributor__content__item__figure__icon" style="color: <?php echo $items[$i]['icon_color'] ?>;">
                  <?php echo siteorigin_widget_get_icon( $items[$i]['icon'] ); ?>
                </p>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <div class="fp_multi-distributor__content__item__info">
            <p class="fp_multi-distributor__content__item__info__title medium_text">
              <?php echo $items[$i]['item_title']; ?>
            </p>
            <p class="fp_multi-distributor__content__item__info__text medium_text">
              <?php echo $items[$i]['item_text']; ?>
            </p>
            <?php if($items[$i]['item_link_text'] != '' && $items[$i]['item_link_url'] != ''): ?>
              <a href="<?php echo $items[$i]['item_link_url'] ?>" class="fp_multi-distributor__content__item__info__link link-text" <?php if($items[$i]['item_new_window']): ?> target="_blank" <?php endif; ?>>
                <?php echo $items[$i]['item_link_text']; ?>
              </a>
            <?php endif; ?>
            <p class="fp_multi-distributor__content__item__info__aux tiny_text">
              <?php echo $items[$i]['item_info']; ?>
            </p>
          </div>

        </div>
      <?php endfor; ?>

    </div>

    <?php if($cta_text != '' && $cta_url != ''): ?>
      <a href="<?php echo $cta_url; ?>" class="btn fp_multi-distributor__cta" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
        <span><?php echo $cta_text; ?></span>
      </a>
    <?php endif; ?>

  </div>
</div>
