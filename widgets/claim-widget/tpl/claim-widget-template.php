<div class="fp_claim <?php echo 'fp_claim--' . $bg_type; ?>
  <?php if(!$veil): ?> fp_claim--no-veil <?php endif; ?>"
  <?php if($bg_type == 'image'): ?>style="background-image: url('<?php echo $image_url; ?>');"<?php endif; ?>
  <?php if($bg_type == 'video'): ?>style="background-image: url('<?php echo $video_bg; ?>');"<?php endif; ?>
>
  <?php if($bg_type == 'video'): ?>
    <div class="fp_claim__video">
      <?php if( $video_type == 'youtube' ): ?>
        <iframe class="fp_claim__video__iframe youtube" src="https://www.youtube.com/embed/<?php echo $video_code; ?>?showinfo=0&amp;controls=0&amp;autohide=1&amp;modestbranding=1&amp;autoplay=1&amp;loop=1&amp;mute=1&amp;playlist=<?php echo $video_code; ?>" frameborder="0" enablejsapi=1 allow="autoplay"></iframe>
      <?php endif; ?>
      <?php if( $video_type == 'vimeo' ): ?>
        <iframe class="fp_claim__video__iframe vimeo" src="https://player.vimeo.com/video/<?php echo $video_code; ?>?background=1" frameborder="0" allow="autoplay"></iframe>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <div class="fp_claim__content">
    <div class="fp_claim__content--inner">
      <h2 class="fp_claim__content__title"><?php echo $claim; ?></h2>
      <?php if($text != ''): ?>
        <p class="fp_claim__content__text"><?php echo $text; ?></p>
      <?php endif; ?>
      <?php if($cta_text != '' && $cta_url != ''): ?>
        <a href="<?php echo $cta_url; ?>" class="btn btn--ghost fp_claim__content__cta" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
          <span><?php echo $cta_text; ?></span>
        </a>
      <?php endif; ?>
      <?php if($video_modal): ?>
        <a href="#video__modal-video-<?php echo $video_code ?>" data-toggle="modal" class="btn btn--ghost fp_claim__content__cta">
          <span><?php echo $video_modal_text; ?></span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php if($video_modal): ?>
  <!-- MODAL -->
  <div class="modal modal--ghost modal--claim fade" id="video__modal-video-<?php echo $video_code ?>" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
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
