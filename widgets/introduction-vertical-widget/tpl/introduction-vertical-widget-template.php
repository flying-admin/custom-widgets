<div class="fp_introduction-v">
  <div class="container">
      <div class="fp_introduction-v__content">
        <div class="row">
          <div class="col-sm-8">
            <h2 class="fp_introduction-v__content__title">
              <?php echo $title; ?>
            </h2>
            <?php if($text != ''): ?>
            <p class="fp_introduction-v__content__text">
              <?php echo $text; ?>
            </p>
            <?php endif; ?>
            <?php if( $rich_text != ''): ?>
            <div class="fp_introduction-v__content__module">
              <?php echo $rich_text; ?>
            </div>
            <?php endif; ?>
          </div>
          <div class="col-sm-4 text-sm-right">
            <?php if( $image_url != '' || $link ): ?>
                  <?php if($image_url != ''): ?>
                  <figure class="container__image container__image--v fp_introduction-v__content__img">
                    <div class="content_image" data-width="1300" data-height="481">
                      <img src="<?php echo $image_url; ?>" class="">          
                    </div>
                </figure>
                  <?php endif; ?>
                  
                  <?php if( $link ): ?>
                    <a href="<?php echo $link_url; ?>" class="link link--primary link--external fp_introduction-v__content__cta" <?php if($link_blank): ?> target="_blank" <?php endif; ?>>
                      <?php echo $link_text; ?>
                      <?php echo siteorigin_widget_get_icon( 'genericons-external' ); ?>
                    </a>
                  <?php endif; ?>
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