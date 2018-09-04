<div class="fp_icon-distributor">
  <div class="fp_icon-distributor--inner">
    <div class="fp_icon-distributor__header">
      <?php if($title != ''): ?>
        <h3 class="fp_icon-distributor__header__title title_text"><?php echo $title; ?></h3>
      <?php endif; ?>
      <?php if($text != ''): ?>
        <p class="fp_icon-distributor__header__desc regular_text"><?php echo $text; ?></p>
      <?php endif; ?>
    </div>
    <div class="fp_icon-distributor__icons
      <?php echo "fp_icon-distributor__icons--" . $items_align; ?>
      <?php echo "fp_icon-distributor__icons--" . $items_row; ?>
    ">
      <?php for ($i = 0; $i < count($items); $i++): ?>
        <div class="fp_icon-distributor__icons__item">
          <?php if($items[$i]['icon_type'] == 'icon'): ?>
            <?php if($items[$i]['icon_icon'] != ''): ?>
              <div class="fp_icon-distributor__icons__item__icon--icon--wrapper">
                <p class="fp_icon-distributor__icons__item__icon fp_icon-distributor__icons__item__icon--icon">
                  <?php echo siteorigin_widget_get_icon( $items[$i]['icon_icon'] ); ?>
                </p>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <?php if($items[$i]['icon_type'] == 'image'): ?>
            <?php if($items[$i]['icon_image'] != ''): ?>
              <div class="fp_icon-distributor__icons__item__icon--image--wrapper">
                <img src="<?php echo $items[$i]['icon_image']; ?>" class="fp_icon-distributor__icons__item__icon fp_icon-distributor__icons__item__icon--image">
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <?php if($items[$i]['icon_title'] != ''): ?>
            <p class="fp_icon-distributor__icons__item__title tiny_text"><?php echo $items[$i]['icon_title']; ?></p>
          <?php endif; ?>
          <?php if($items[$i]['icon_text'] != ''): ?>
            <p class="fp_icon-distributor__icons__item__desc tiny_text"><?php echo $items[$i]['icon_text']; ?></p>
          <?php endif; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</div>
