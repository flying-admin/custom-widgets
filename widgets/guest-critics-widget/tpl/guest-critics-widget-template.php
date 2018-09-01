<div class="fp_module">
  <div class="fp_module__content">
    <div class="fp_guest-critics">
        <div class="fp_guest-critics__content">
          <div class="row">
            <div class="col-lg-10 col-sm-12">
              <h2 class="fp_guest-critics__content__title">
                <?php echo $title; ?>
              </h2>
              <?php if($text != ''): ?>
              <p class="fp_guest-critics__content__text">
                <?php echo $text; ?>
              </p>
              <?php endif; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="fp_guest-critics__content__items">
                <div class="row justify-content-start">
                  <?php for ($i = 0; $i < count($items); $i++): ?>
                  <div class="col-md-6 col-xl-4 mt-4">
                  <?php if( $items[$i]["modal_id"] != ''  ): ?> <a href="#<?php echo $items[$i]["modal_id"]; ?>" data-toggle="modal"  > <?php endif; ?>
                    <div class="fp_guest-critics__content__item  <?php  if( $items[$i]['item_background'] != ''): ?> fp_guest-critics__content__item--bg  <?php endif; ?> "  <?php  if( $items[$i]['item_background'] != ''): ?>   style="background-image:url('<?php echo $items[$i]['item_background'] ?>')" <?php endif; ?>   />
                      <div class="fp_guest-critics__content__item__content d-flex flex-column <?php if($items[$i]['item_photo'] == ''): ?> justify-content-center <?php endif; ?>">
                        <?php if($items[$i]['item_photo'] != ''): ?>
                          <img src=" <?php echo  $items[$i]['item_photo'] ;  ?>" alt="" class="fp_guest-critics__content__item__img">
                        <?php endif; ?>
                        <?php if( $items[$i]['name'] != ''): ?>
                          <p class="fp_guest-critics__content__item__title"><?php echo $items[$i]['name'] ; ?></p>
                        <?php endif; ?>
                        <?php if( $items[$i]['position'] != ''): ?>
                          <p class="fp_guest-critics__content__item__text"><?php echo  $items[$i]['position'] ;  ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                    <?php if( $items[$i]["modal_id"] != '' ): ?> </a> <?php endif; ?>
                  </div>
                  <?php endfor; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<?php for ($i = 0; $i < count($items); $i++): ?>
  <?php if(  $items[$i]["modal_id"] != '' ): ?>
  <div class="modal modal--ghost fade" id="<?php echo $items[$i]["modal_id"]  ?>" tabindex="-1" role="dialog" aria-labelledby="modal-guest-critics-label">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <?php echo siteorigin_widget_get_icon( 'genericons-close-alt' ); ?>
                </button>
            </div>
            <div class="modal-body">
              <div class="fp_guest-critics__modal__item">
                <div class="row justify-content-between">
                  <div class="col-md-4 <?php if($items[$i]['item_photo'] != ''): ?> text-md-center <?php endif; ?> ">
                    <div class="row align-items-center">
                      <?php if($items[$i]['item_photo'] != ''): ?>
                        <div class="col-4 col-sm-3 col-md-12">
                          <img src=" <?php echo  $items[$i]['item_photo'] ;  ?>" alt="" class="fp_guest-critics__modal__item__img">
                        </div>
                      <?php endif; ?>
                      <div class="col-8 col-sm-9 col-md-12">
                        <div class="fp_guest-critics__modal__item__info">
                          <?php if( $items[$i]['name'] != ''): ?>
                            <p class="fp_guest-critics__modal__item__title"><?php echo $items[$i]['name'] ; ?></p>
                          <?php endif; ?>
                          <?php if( $items[$i]['position'] != ''): ?>
                            <p class="fp_guest-critics__modal__item__text"><?php echo  $items[$i]['position'] ;  ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="fp_guest-critics__modal__item__description">
                      <?php echo  $items[$i]['rich_text'] ;  ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
  <?php endif; ?>
<?php endfor; ?>
