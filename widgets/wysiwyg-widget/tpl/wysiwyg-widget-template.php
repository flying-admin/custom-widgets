<div class="fp_module">
  <div class="fp_module__content">
    <div class="fp_wysiwyg">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="fp_wysiwyg__content">
              <div class="row">
                <div class="col-lg-10 col-sm-12">
                  <?php if($title != ''): ?>
                    <h2 class="fp_wysiwyg__content__title">
                      <?php echo $title; ?>
                    </h2>
                  <?php endif; ?>
                  <?php if($text != ''): ?>
                    <p class="fp_wysiwyg__content__text">
                      <?php echo $text; ?>
                    </p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row" >
                <?php if( $extra_content != 'none' ): ?>
                  <div class="col-12">
                    <div class="extra-content">

                      <?php if( $image   && $image_url): ?>
                        <figure class="extra-content__img content_image" data-width="740" data-height="480" >
                          <img src="<?php echo $image_url; ?>" class="">
                        </figure>
                      <?php endif; ?>

                      <?php if( $video ): ?>
                        <?php if( $video_url == false ): ?>
                          <p>  error video URL </p>
                        <?php else: ?>
                          <a href="#introduccion__modal-video-<?php echo $video_code ?>" data-toggle="modal"   class="extra-content__video">
                            <figure class="extra-content__video__image content_image" data-width="740" data-height="480" >
                                <img src="<?php echo $video_image ?>" class="">
                            </figure>
                            <?php echo siteorigin_widget_get_icon( 'ionicons-ios-play-outline' ); ?>
                          </a>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <div class=" col-12">
                  <?php if($rich_text != ''): ?>
                    <div class="fp_wysiwyg__content__module">
                      <?php echo $rich_text; ?>
                    </div>
                  <?php endif; ?>
                  <?php if($link): ?>
                    <a href="<?php echo $link_url; ?>" class="link link--primary link--external fp_wysiwyg__content__cta" <?php if($link_blank): ?> target="_blank" <?php endif; ?>>
                      <?php echo $link_text; ?>
                      <?php echo siteorigin_widget_get_icon( 'genericons-external' ); ?>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if( $extra_content == 'video' ): ?>
  <!-- MODAL -->
  <div class="modal fade modal--video modal--ghost" id="introduccion__modal-video-<?php echo $video_code ?>" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <?php echo siteorigin_widget_get_icon( 'genericons-close-alt' ); ?>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="modal-video">
                      <div class="embed-responsive embed-responsive-16by9">
                        <?php if( $video_type == 'youtube' ): ?>
                            <iframe width="560" height="315" class="embed-responsive-item video-iframe youtube " src="https://www.youtube.com/embed/<?php echo $video_code ?>?" frameborder="0" allowfullscreen="" enablejsapi=1 allow="autoplay"></iframe>
                        <?php endif; ?>
                        <?php if( $video_type == 'vimeo' ): ?>
                            <iframe class="embed-responsive-item video-iframe vimeo" src="https://player.vimeo.com/video/<?php echo $video_code ?>?" frameborder="0" allowfullscreen="" allow="autoplay"></iframe>
                        <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php endif; ?>
