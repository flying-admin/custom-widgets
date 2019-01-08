<div class="fp_companies">
  <div class="fp_companies--inner">

    <div class="fp_companies__header">
      <h2 class="fp_companies__header__title title_text"><?php echo $title; ?></h2>
      <p class="fp_companies__header__text regular_text"><?php echo $text; ?></p>
    </div>

    <div class="fp_companies__content
    fp_companies__content--col-<?php echo $items_row; ?>
    fp_companies__content--type-<?php echo $items_type; ?>
    ">

      <?php for($i = 0; $i < count($items); $i++): ?>
        <div class="fp_companies__content__item">
          <?php if($items[$i]['item_url'] != ''): ?>
            <a href="<?php echo $items[$i]['item_url']; ?>" <?php if($items[$i]['new_window']): ?> target="_blank" <?php endif; ?>>
          <?php endif; ?>
            <?php if($items_type == 'logo'): ?>
              <img src="<?php echo $items[$i]['image_url']; ?>" alt="">
            <?php endif; ?>
            <?php if($items_type == 'text'): ?>
              <p class="medium_text"><?php echo $items[$i]['item_name']; ?></p>
            <?php endif; ?>
          <?php if($items[$i]['item_url'] != ''): ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endfor; ?>

    </div>

    <?php if($cta_text != '' && $cta_url != ''): ?>
      <a href="<?php echo $cta_url; ?>" class="btn fp_companies__cta" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
        <span><?php echo $cta_text; ?></span>
        <span class="btn__bg" style="background-color: <?php echo $color; ?>;"></span>
      </a>
    <?php endif; ?>

  </div>
</div>
