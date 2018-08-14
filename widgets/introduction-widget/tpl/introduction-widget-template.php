<div class="fp_introduction">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
      <div class="fp_introduction__content">
        <div class="row">
          <div class="col-lg-10 col-sm-12">
            <h2 class="fp_introduction__content__title">
              <?php echo $title; ?>
            </h2>
            <?php if($text != ''): ?>
            <p class="fp_introduction__content__text">
              <?php echo $text; ?>
            </p>
            <?php endif; ?>
          </div>
        </div>
        <div class="row  <?php if( $extra_content_position == 'left' ): echo 'flex-row-reverse'; endif; ?> " >
          <div class=" col-sm-12 <?php if( $extra_content == 'image' || $extra_content == 'video' ){ echo ' col-lg-6 '; }else{ echo ' col-lg-8 ' ;}?> ">
            <?php if($rich_text != ''): ?>
            <div class="fp_introduction__content__module">
              <?php echo $rich_text; ?>
            </div>
            <?php endif; ?>
            <?php if($link): ?>
              <a href="<?php echo $link_url; ?>" class="link link--primary link--external fp_introduction__content__cta" <?php if($link_blank): ?> target="_blank" <?php endif; ?>>
                <?php echo $link_text; ?>
                <?php echo siteorigin_widget_get_icon( 'genericons-external' ); ?>
              </a>
            <?php endif; ?>
          </div>
          <?php if( $extra_content != 'none' ): ?>
    
            <div class="col-sm-12 <?php if( $extra_content == 'image' || $extra_content == 'video' ){ echo ' col-lg-6 '; }else{ echo ' col-lg-4 ' ;}?>  ">
              <div class="extra-content">
                <?php if( $cta ): // start CTA ?>
                  <div class="extra-content__cta-block">
                    <?php if($cta_title != ''): ?> 
                      <p class="cta-block__title"> <?php echo $cta_title; ?></p> 
                    <?php endif; ?>

                    <?php if($cta_text != ''): ?> 
                    <p class="cta-block__text"> <?php echo $cta_text; ?></p>
                    <?php endif; ?>
                    
                    <?php if($cta_link_text != ''): ?> 
                    <div class="row justify-content-center">
                      <div class="col-lg-12 col-md-6">
                        <a href="<?php echo $cta_link_url; ?>" class="btn btn--block btn--primary cta-block__btn " <?php if($cta_new_window): ?> target="_blank" <?php endif; ?>>
                          <span>
                            <?php echo $cta_link_text; ?>
                            <?php echo siteorigin_widget_get_icon( 'genericons-external' ); ?>
                          </span>
                        </a>
                      </div>
                    </div>
                     
                    <?php endif; ?>
                  </div>
                <?php endif; // end CTA ?> 

                <?php if( $image   && $image_url): ?>
                  <img src="<?php echo $image_url; ?>" alt="" class="extra_content__img img-fluid">
                <?php endif; ?>

                <?php if( $video ): ?>
                  <?php if( $video_url == false ): ?>
                      <p>  error video URL </p>    
                  <?php else: ?>
                    <a href="#introduccion__modal-video-<?php echo $video_code ?>" data-toggle="modal"   class="extra_content__video">
                      <figure class="content_img">
                        
                          <img src="<?php echo $video_image ?>" class="extra_content__video__image">
                        
                      </figure>
                      <?php echo siteorigin_widget_get_icon( 'ionicons-ios-play-outline' ); ?>
                    </a>
                  <?php endif; ?>
                <?php endif; ?>

              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      </div>
    </div>
      
  </div>
</div>
<?php if( $extra_content == 'video' ): ?>
<!-- MODAL -->
<div class="modal fade modal--video" id="introduccion__modal-video-<?php echo $video_code ?>" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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