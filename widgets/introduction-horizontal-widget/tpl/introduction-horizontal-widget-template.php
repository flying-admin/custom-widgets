<div class="fp_module bg-light">
  <div class="fp_module__content">
    <div class="fp_introduction-h">
        <div class="fp_introduction-h__content">
          <div class="row">
            <div class="col-lg-11 col-sm-12">
              <h2 class="fp_introduction-h__content__title">
                <?php echo $title; ?>
              </h2>
              <?php if($text != ''): ?>
              <p class="fp_introduction-h__content__text">
                <?php echo $text; ?>
              </p>
              <?php endif; ?>
            </div>
            <div class="col-sm-12">
              <?php if( $image_url ): ?>
                  <figure class="container__image">
                    <div class="fp_introduction-h__content__img content_image" data-width="1300" data-height="481">
                      <img src="<?php echo $image_url; ?>" class="">
                    </div>
                  </figure>
              <?php endif; ?>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
