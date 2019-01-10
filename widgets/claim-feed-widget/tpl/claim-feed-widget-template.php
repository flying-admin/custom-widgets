<div class="fp_claim fp_claim--feed <?php echo 'fp_claim--' . $bg_type_feed; ?>
  <?php if(!$veil_feed): ?> fp_claim--no-veil <?php endif; ?>"
  <?php if($bg_type_feed == 'image'): ?>style="background-image: url('<?php echo $image_url_feed; ?>');"<?php endif; ?>
  <?php if($bg_type_feed == 'video'): ?>style="background-image: url('<?php echo $video_bg_feed; ?>');"<?php endif; ?>
>
  <?php if($bg_type_feed == 'video'): ?>
    <div class="fp_claim__video">
      <?php if( $video_type_feed == 'youtube' ): ?>
        <iframe class="fp_claim__video__iframe youtube" src="https://www.youtube.com/embed/<?php echo $video_code_feed; ?>?showinfo=0&amp;controls=0&amp;autohide=1&amp;modestbranding=1&amp;iv_load_policy=3&amp;rel=0&amp;autoplay=1&amp;loop=1&amp;mute=1&amp;playlist=<?php echo $video_code_feed; ?>" allow="autoplay"></iframe>
      <?php endif; ?>
      <?php if( $video_type_feed == 'vimeo' ): ?>
        <iframe class="fp_claim__video__iframe vimeo" src="https://player.vimeo.com/video/<?php echo $video_code_feed; ?>?background=1" frameborder="0" allow="autoplay"></iframe>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <div class="fp_claim__content">
    <div class="fp_claim__content--inner">
      <h2 class="fp_claim__content__title"><?php echo $claim_feed; ?></h2>
      <?php if($text_feed != ''): ?>
        <p class="fp_claim__content__text"><?php echo $text_feed; ?></p>
      <?php endif; ?>
      <?php if($cta_text_feed != '' && $cta_url_feed != ''): ?>
        <a href="<?php echo sow_esc_url($cta_url_feed); ?>" class="btn btn--ghost fp_claim__content__cta" <?php if($new_window_feed): ?> target="_blank" <?php endif; ?>>
          <span><?php echo $cta_text_feed; ?></span>
        </a>
      <?php endif; ?>
      <?php if($video_modal_feed): ?>
        <a href="#video__modal-video-<?php echo $video_code_feed ?>" data-toggle="modal" class="btn btn--ghost fp_claim__content__cta">
          <span><?php echo $video_modal_text_feed; ?></span>
        </a>
      <?php endif; ?>
    </div>
  </div>
  <?php $feed_claim = query_posts($posts_feed); ?>

  <?php if( count($feed_claim) > 0 ):?>
    <div class="fp_claim__feed">
      
    <?php
      for($i = 0; $i < count($feed_claim); $i++):
        $feed_cats = get_the_category($feed_claim[$i]->ID);
        $feed_permalink = get_the_permalink($feed_claim[$i]->ID);
        $feed_thumbnail = get_the_post_thumbnail($feed_claim[$i]->ID);
        if ($feed_thumbnail):
    ?>

          <div class="fp_claim__feed__item fp_claim__feed__item--thumb">
            <?php if ( count($feed_cats) >= 1 && $feed_cats[0]->name != 'Uncategorized' ): ?>
              <span class="fp_claim__feed__item__cat"> 
                <?php for( $cat = 0; $cat < count($feed_cats); $cat++ ) { ?>
                  <?php if ( $feed_cats[$cat]->name != 'uncategorized' ): ?>
                    <span><?php echo $feed_cats[$cat]->name; ?></span>
                  <?php endif; ?>
                <?php } ?>
              </span>
            <?php endif; ?>
            <div class="fp_claim__feed__item__wrap">
              <a href="<?php echo $feed_permalink; ?>" class="fp_claim__feed__item__wrap__thumbnail"><?php echo $feed_thumbnail; ?></a>
              <div class="fp_claim__feed__item__wrap__content">
                <p class="fp_claim__feed__item__wrap__content__title"><a href="<?php echo $feed_permalink; ?>"><?php echo $feed_claim[$i]->post_title; ?></a></p>
                
              </div>
            </div>
          </div>
    
        <?php else: ?>
          <div class="fp_claim__feed__item fp_claim__feed__item--nothumb">
            <?php if ( count($feed_cats) >= 1 && $feed_cats[0]->name != 'Uncategorized' ): ?>
              <span class="fp_claim__feed__item__cat"> 
                <?php for( $cat = 0; $cat < count($feed_cats); $cat++ ) { ?>
                  <?php if ( $feed_cats[$cat]->name != 'uncategorized' ): ?>
                    <span><?php echo $feed_cats[$cat]->name; ?></span>
                  <?php endif; ?>
                <?php } ?>
              </span>
            <?php endif; ?>
            <p class="fp_claim__feed__item__wrap__content__date">
              <?php echo get_the_date( 'j M Y', $feed_claim[$i]->ID ); ?>
            </p>
                <p class="fp_claim__feed__item__wrap__content__title"><a href="<?php echo $feed_permalink; ?>"><?php echo $feed_claim[$i]->post_title; ?></a></p>
            <p class="fp_claim__feed__item__wrap__content__excerpt"><a href="<?php echo $feed_permalink; ?>"><?php echo $feed_claim[$i]->post_excerpt; ?></a></p>
          </div>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</div>
<?php if($video_modal_feed): ?>
  <!-- MODAL -->
  <div class="modal modal--ghost modal--claim fade" id="video__modal-video-<?php echo $video_code_feed ?>" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
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
              <?php if( $video_type_feed == 'youtube' ): ?>
                <iframe class="embed-responsive-item video-iframe youtube" src="https://www.youtube.com/embed/<?php echo $video_code_feed ?>?" frameborder="0" allowfullscreen="" enablejsapi=1 allow="autoplay"></iframe>
              <?php endif; ?>
              <?php if( $video_type_feed == 'vimeo' ): ?>
                <iframe class="embed-responsive-item video-iframe vimeo" src="https://player.vimeo.com/video/<?php echo $video_code_feed ?>?" frameborder="0" allowfullscreen="" allow="autoplay"></iframe>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>

