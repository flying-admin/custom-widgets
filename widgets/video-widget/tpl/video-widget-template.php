<div class="fp_module fp_module--full-width">
  <div class="fp_module__content">
    <div class="fp_video fp_video--<?php echo $video_size; ?>">
      <div class="row">
        <div class="col-sm-12">
          <div class="fp_video__header">
            <div class="row">
              <div class="col-lg-10 col-sm-12">
                <h2 class="fp_video__header__title">
                  <?php echo $title; ?>
                </h2>
                <?php if($text != ''): ?>
                  <p class="fp_video__header__text">
                    <?php echo $text; ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="fp_video__content">
            <div class="row">
              <?php if( $video_url != false ): ?>
                <div class="col-sm-12">
                  <a href="#video__modal-video-<?php echo $video_code ?>" data-toggle="modal" class="fp_video__content__video">
                    <?php if( $video_image != false ): ?>
                      <div class="fp_video__content__video__image" style="background-image:url('<?php echo $video_image ?>')" ></div>
                    <?php endif; ?>
                    <?php echo siteorigin_widget_get_icon( 'ionicons-ios-play-outline' ); ?>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if( $video_url != false  ): ?>
  <!-- MODAL -->
  <div class="modal modal--ghost modal--video fade" id="video__modal-video-<?php echo $video_code ?>" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
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
                <iframe class="embed-responsive-item video-iframe youtube" src="https://www.youtube.com/embed/<?php echo $video_code ?>?" frameborder="0" allowfullscreen="" enablejsapi=1 allow="autoplay"></iframe>
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
