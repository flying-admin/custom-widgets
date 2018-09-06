<div class="fp_multi-distributor">
  <div class="fp_multi-distributor--inner">

    <div class="fp_multi-distributor__header">
      <h2 class="fp_multi-distributor__header__title title_text"><?php echo $title; ?></h2>
      <p class="fp_multi-distributor__header__text regular_text"><?php echo $text; ?></p>
    </div>

    <div class="fp_multi-distributor__content
    fp_multi-distributor__content--col-<?php echo $items_row; ?>
    fp_multi-distributor__content--type-<?php echo $items_type; ?>
    ">

      <?php for($i = 0; $i < count($items); $i++): ?>
        <div class="fp_multi-distributor__content__item">
          <?php if($items_type == 'normal'): ?>
            <?php if($items[$i]['image_url'] != ''): ?>
              <div class="fp_multi-distributor__content__item__figure fp_multi-distributor__content__item__figure--image">
                <img src="<?php echo $items[$i]['image_url']; ?>" alt="" class="fp_multi-distributor__content__item__figure__image">
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <?php if($items_type == 'icons'): ?>
            <?php if($items[$i]['icon'] != ''): ?>
              <div class="fp_multi-distributor__content__item__figure fp_multi-distributor__content__item__figure--icon" style="background-color: <?php echo $items[$i]['icon_bgcolor'] ?>;">
                <p class="fp_multi-distributor__content__item__figure__icon" style="color: <?php echo $items[$i]['icon_color'] ?>;">
                  <?php echo siteorigin_widget_get_icon( $items[$i]['icon'] ); ?>
                </p>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <div class="fp_multi-distributor__content__item__info">
            <p class="fp_multi-distributor__content__item__info__title medium_text">
              <?php echo $items[$i]['item_title']; ?>
            </p>
            <p class="fp_multi-distributor__content__item__info__text medium_text">
              <?php echo $items[$i]['item_text']; ?>
            </p>
            <?php if($items[$i]['item_link_type'] != 'none' && $items[$i]['item_link_text'] != ''): ?>
              <?php if($items[$i]['item_link_type'] == 'link' && $items[$i]['item_link_url'] != ''): ?>
                <a href="<?php echo $items[$i]['item_link_url'] ?>" class="fp_multi-distributor__content__item__info__link fp_multi-distributor__content__item__info__link--<?php echo $items[$i]['item_link_type']; ?> link-text" <?php if($items[$i]['item_new_window']): ?> target="_blank" <?php endif; ?>>
                  <?php echo $items[$i]['item_link_text']; ?>
                </a>
              <?php endif; ?>
              <?php if($items[$i]['item_link_type'] == 'modal' && $items[$i]['section_item_modal']['item_modal_id'] != ''): ?>
                <a href="#<?php echo $items[$i]['section_item_modal']['item_modal_id']; ?>" data-toggle="modal" class="fp_multi-distributor__content__item__info__link fp_multi-distributor__content__item__info__link--<?php echo $items[$i]['item_link_type']; ?> link-text">
                  <?php echo $items[$i]['item_link_text']; ?>
                </a>
              <?php endif; ?>
            <?php endif; ?>
            <p class="fp_multi-distributor__content__item__info__aux tiny_text">
              <?php echo $items[$i]['item_info']; ?>
            </p>
          </div>

        </div>
      <?php endfor; ?>

    </div>

    <?php if($cta_text != '' && $cta_url != ''): ?>
      <a href="<?php echo $cta_url; ?>" class="btn fp_multi-distributor__cta" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
        <span><?php echo $cta_text; ?></span>
      </a>
    <?php endif; ?>

  </div>
</div>
<?php for ($i = 0; $i < count($items); $i++): ?>
  <?php if($items[$i]['item_link_type'] == 'modal' && $items[$i]['section_item_modal']['item_modal_id'] != ''): ?>
  <div class="modal modal--ghost fade" id="<?php echo $items[$i]['section_item_modal']['item_modal_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-multiple-distributor">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <?php echo siteorigin_widget_get_icon( 'genericons-close-alt' ); ?>
                </button>
            </div>
            <div class="modal-body">
              <div class="fp_multi-distributor__modal">
                <?php $modal = $items[$i]['section_item_modal']; ?>
                <div class="fp_multi-distributor__modal__<?php echo $modal['item_modal_type']; ?>">
                  <?php if($modal['item_modal_type'] == 'text'): ?>

                    <?php echo $modal['item_modal_text']; ?>

                  <?php elseif ($modal['item_modal_type'] == 'image'): ?>

                    <img src="<?php echo $modal['item_modal_image']; ?>" alt="">

                  <?php elseif ($modal['item_modal_type'] == 'video'): ?>

                    <video width="auto" height="auto" controls>
                      <source src="<?php echo $modal['item_modal_video']; ?>" type="video/<?php echo substr($modal['item_modal_video'], -3); ?>">
                    </video>

                  <?php elseif ($modal['item_modal_type'] == 'stream'): ?>

                    <div class="embed-responsive embed-responsive-16by9">
                      <?php if( $modal['item_modal_stream_type'] == 'youtube' ): ?>
                        <iframe width="560" height="315" class="embed-responsive-item video-iframe youtube " src="https://www.youtube.com/embed/<?php echo $modal['item_modal_stream_code']; ?>?" frameborder="0" allowfullscreen="" enablejsapi=1 allow="autoplay"></iframe>
                      <?php endif; ?>
                      <?php if( $modal['item_modal_stream_type'] == 'vimeo' ): ?>
                        <iframe class="embed-responsive-item video-iframe vimeo" src="https://player.vimeo.com/video/<?php echo $modal['item_modal_stream_code']; ?>?" frameborder="0" allowfullscreen="" allow="autoplay"></iframe>
                      <?php endif; ?>
                    </div>

                  <?php elseif ($modal['item_modal_type'] == 'file'): ?>

                    <?php if( substr($modal['item_modal_video'], -3) == 'pdf' ): ?>
                      <object data="<?php echo $modal['item_modal_file']; ?>" type="application/pdf">
                        <iframe src="https://docs.google.com/viewer?url=<?php echo $modal['item_modal_file']; ?>&embedded=true"></iframe>
                      </object>
                    <?php else: ?>
                      <iframe src="https://docs.google.com/viewer?url=<?php echo $modal['item_modal_file']; ?>&embedded=true"></iframe>
                    <?php endif; ?>

                  <?php endif; ?>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
  <?php endif; ?>
<?php endfor; ?>
