
<div class="fp_featured-distributor <?php echo "fp_featured-distributor--" . $type; ?>">
  <div class="fp_featured-distributor__content">
    <?php if($link_url != ''): ?>
      <a href="<?php echo sow_esc_url($link_url); ?>" class="fp_featured-distributor__content__main fp_featured-distributor__content__main--link" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
    <?php else: ?>
      <div class="fp_featured-distributor__content__main fp_featured-distributor__content__main--no-link">
    <?php endif; ?>
      <?php if($main != ''): ?>
        <h3 class="fp_featured-distributor__content__main__title"><?php echo $main; ?></h3>
      <?php endif; ?>
      <?php if($desc != ''): ?>
        <p class="fp_featured-distributor__content__main__desc"><?php echo $desc; ?></p>
      <?php endif; ?>
      <?php if($link_text != '' && $link_url != ''): ?>
        <p class="fp_featured-distributor__content__main__link"><?php echo $link_text; ?></p>
      <?php endif; ?>
    <?php if($link_url != ''): ?>
      </a>
    <?php else: ?>
      </div>
    <?php endif; ?>
    <?php if($type != 'normal'): ?>
      <div class="fp_featured-distributor__content__side">
        <?php if($type == 'phrase'): ?>
          <p class="fp_featured-distributor__content__side__main"><?php echo $phrase_main; ?></p>
          <p class="fp_featured-distributor__content__side__desc"><?php echo $phrase_desc; ?></p>
        <?php endif; ?>
        <?php if($type == 'cypher'): ?>
          <p class="fp_featured-distributor__content__side__main">
            <?php echo $cypher_number; ?>
            <?php if($cypher_number != ''): ?>
              <small><?php echo $cypher_ordinal; ?></small>
            <?php endif; ?>
          </p>
          <p class="fp_featured-distributor__content__side__desc"><?php echo $cypher_desc; ?></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <div class="fp_featured-distributor__content__bg" style="background-image: url(<?php echo $image_url; ?>);"></div>
  </div>
</div>
