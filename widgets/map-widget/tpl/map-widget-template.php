<div class="fp_map <?php if(!$map_segmentation): ?> fp_map--no-segmentation <?php endif; ?>">
  <div class="fp_map--inner">
    <div class="fp_map__header">
      <p class="fp_map__header__title"><?php echo $map_title; ?></p>
      <p class="fp_map__header__text"><?php echo $map_text; ?></p>
      <div class="fp_map__header__toggle">
        <a href="#map" data-maptoggle="map" class="fp_map__header__toggle__item fp_map__header__toggle__item--map active"></a>
        <a href="#list" data-maptoggle="list" class="fp_map__header__toggle__item fp_map__header__toggle__item--list"></a>
      </div>
    </div>
    <div class="fp_map__content">
      <?php if($map_segmentation): ?>
        <ul class="fp_map__content__tabs">
          <li><a href="" class="active" data-mapfilter data-lat="25" data-lng="0" data-zoom="2.5" data-region="all"><?php echo __('All', 'custom-widgets') ?></a></li>
          <?php if($regions['europe']): ?>
            <?php $europe = []; ?>
            <li><a href="" data-mapfilter data-lat="46.5" data-lng="8.5" data-zoom="4" data-region="europe"><?php echo __('Europe', 'custom-widgets') ?></a></li>
          <?php endif; ?>
          <?php if($regions['africa']): ?>
            <?php $africa = []; ?>
            <li><a href="" data-mapfilter data-lat="19.5" data-lng="33.0" data-zoom="3.5" data-region="africa"><?php echo __('Middle East & Africa', 'custom-widgets') ?></a></li>
          <?php endif; ?>
          <?php if($regions['asia']): ?>
            <?php $asia = []; ?>
            <li><a href="" data-mapfilter data-lat="5" data-lng="110" data-zoom="3.5" data-region="asia"><?php echo __('Asia Pacific', 'custom-widgets') ?></a></li>
          <?php endif; ?>
          <?php if($regions['latin']): ?>
            <?php $latin = []; ?>
            <li><a href="" data-mapfilter data-lat="-13.5" data-lng="-58.0" data-zoom="3.5" data-region="latin"><?php echo __('Latin America', 'custom-widgets') ?></a></li>
          <?php endif; ?>
          <?php if($regions['america']): ?>
            <?php $america = []; ?>
            <li><a href="" data-mapfilter data-lat="42.5" data-lng="-93.5" data-zoom="3.5" data-region="america"><?php echo __('USA & Canada', 'custom-widgets') ?></a></li>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
      <div class="fp_map__content__map" data-map>
        <div class="fp_map__content__map__google-map"></div>
      </div>
      <div class="fp_map__content__lists" data-list>
        <?php foreach($markers as $mrkr): ?>
          <?php array_push(${$mrkr['marker_continent']}, $mrkr); ?>
        <?php endforeach; ?>
        <div class="fp_map__content__lists__item active" data-regionlist="all">
          <?php foreach($regions as $rgn): ?>
            <div class="fp_map__content__lists__item--header" data-accordionheader="<?php echo $rgn; ?>">
              <?php if($rgn == 'europe'): ?>
                <p class="fp_map__content__lists__item--header-title"><?php echo __('Europe', 'custom-widgets') ?></p>
              <?php endif; ?>
              <?php if($rgn == 'africa'): ?>
                <p class="fp_map__content__lists__item--header-title"><?php echo __('Middle East & Africa', 'custom-widgets') ?></p>
              <?php endif; ?>
              <?php if($rgn == 'asia'): ?>
                <p class="fp_map__content__lists__item--header-title"><?php echo __('Asia Pacific', 'custom-widgets') ?></p>
              <?php endif; ?>
              <?php if($rgn == 'latin'): ?>
                <p class="fp_map__content__lists__item--header-title"><?php echo __('Latin America', 'custom-widgets') ?></p>
              <?php endif; ?>
              <?php if($rgn == 'america'): ?>
                <p class="fp_map__content__lists__item--header-title"><?php echo __('USA & Canada', 'custom-widgets') ?></p>
              <?php endif; ?>
            </div>
            <div class="fp_map__content__lists__item--content" data-accordioncontent="<?php echo $rgn; ?>">
              <?php foreach (${$rgn} as $mrkr): ?>
                <div class="fp_map__content__lists__item__elem">
                  <?php if($mrkr['marker_image'] != ''): ?>
                    <div class="fp_map__content__lists__item__elem__image">
                      <img src="<?php echo $mrkr['marker_image']; ?>" alt="">
                    </div>
                  <?php endif; ?>
                  <div class="fp_map__content__lists__item__elem__info">
                    <p class="fp_map__content__lists__item__elem__info__title"><?php echo $mrkr['marker_title']; ?></p>
                    <p class="fp_map__content__lists__item__elem__info__text"><?php echo str_replace(array("\r","\n"),"<br/>",$mrkr['marker_text']); ?></p>
                    <?php if($mrkr['marker_phone'] != ''): ?>
                      <a class="fp_map__content__lists__item__elem__info__link fp_map__content__lists__item__elem__info__link--tel" href="tel:<?php echo $mrkr['marker_phone']; ?>"><?php echo $mrkr['marker_phone']; ?></a>
                    <?php endif; ?>
                    <?php if($mrkr['marker_email'] != ''): ?>
                      <a class="fp_map__content__lists__item__elem__info__link fp_map__content__lists__item__elem__info__link--mail" href="mailto:<?php echo $mrkr['marker_email']; ?>"><?php echo $mrkr['marker_email']; ?></a>
                    <?php endif; ?>
                    <p class="fp_map__content__lists__item__elem__info__address"><?php echo $mrkr['marker_address']; ?></p>
                    <?php if($mrkr['marker_cta'] != ''): ?>
                      <a class="fp_map__content__lists__item__elem__info__cta fp_map__content__lists__item__elem__info__cta--<?php echo $mrkr['marker_cta_style']; ?>" href="<?php echo $mrkr['marker_cta_url']; ?>" <?php if($mrkr['new_window']): ?>target="_blank"<?php endif; ?>>
                        <span><?php echo $mrkr['marker_cta_text']; ?></span>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <?php foreach($regions as $rgn): ?>
          <div class="fp_map__content__lists__item" data-regionlist="<?php echo $rgn; ?>">
            <div class="fp_map__content__lists__item--content">
              <?php foreach (${$rgn} as $mrkr): ?>
                <div class="fp_map__content__lists__item__elem">
                  <?php if($mrkr['marker_image'] != ''): ?>
                    <div class="fp_map__content__lists__item__elem__image">
                      <img src="<?php echo $mrkr['marker_image']; ?>" alt="">
                    </div>
                  <?php endif; ?>
                  <div class="fp_map__content__lists__item__elem__info">
                    <p class="fp_map__content__lists__item__elem__info__title"><?php echo $mrkr['marker_title']; ?></p>
                    <p class="fp_map__content__lists__item__elem__info__text"><?php echo str_replace(array("\r","\n"),"<br/>",$mrkr['marker_text']); ?></p>
                    <?php if($mrkr['marker_phone'] != ''): ?>
                      <a class="fp_map__content__lists__item__elem__info__link fp_map__content__lists__item__elem__info__link--tel" href="tel:<?php echo $mrkr['marker_phone']; ?>"><?php echo $mrkr['marker_phone']; ?></a>
                    <?php endif; ?>
                    <?php if($mrkr['marker_email'] != ''): ?>
                      <a class="fp_map__content__lists__item__elem__info__link fp_map__content__lists__item__elem__info__link--mail" href="mailto:<?php echo $mrkr['marker_email']; ?>"><?php echo $mrkr['marker_email']; ?></a>
                    <?php endif; ?>
                    <p class="fp_map__content__lists__item__elem__info__address"><?php echo $mrkr['marker_address']; ?></p>
                    <?php if($mrkr['marker_cta'] != ''): ?>
                      <a class="fp_map__content__lists__item__elem__info__cta fp_map__content__lists__item__elem__info__cta--<?php echo $mrkr['marker_cta_style']; ?>" href="<?php echo $mrkr['marker_cta_url']; ?>" <?php if($mrkr['new_window']): ?>target="_blank"<?php endif; ?>>
                        <span><?php echo $mrkr['marker_cta_text']; ?></span>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var locations = [
    <?php foreach($markers as $mrkr): ?>
      {
        'title': '<?php echo $mrkr['marker_title']; ?>',
        'text': '<?php echo str_replace(array("\r","\n"),"<br/>",$mrkr['marker_text']); ?>',
        'lat': <?php echo $mrkr['marker_lat']; ?>,
        'lng': <?php echo $mrkr['marker_lng']; ?>,
        'image': '<?php echo $mrkr['marker_image']; ?>',
        'phone': '<?php echo $mrkr['marker_phone']; ?>',
        'email': '<?php echo $mrkr['marker_email']; ?>',
        'address': '<?php echo $mrkr['marker_address']; ?>',
        'cta': <?php echo $mrkr['marker_cta']? 1 : 0; ?>,
        'cta_style': '<?php echo $mrkr['marker_cta_style']; ?>',
        'cta_text': '<?php echo $mrkr['marker_cta_text']; ?>',
        'cta_url': '<?php echo $mrkr['marker_cta_url']; ?>',
        'cta_blank': <?php echo $mrkr['new_window']? 1 : 0; ?>
      },
    <?php endforeach; ?>
  ];

</script>
<!-- <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJCnGHuhW7wGkJcWdHAuBFsuMqwOofYik&amp;callback=initMap"></script> -->
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJCnGHuhW7wGkJcWdHAuBFsuMqwOofYik"></script>
