jQuery(function(){
  console.log('introduction-horizontal-widget - ready');

    jQuery('.content_image').each(function () {
      var w = jQuery(this).attr('data-width');
      var h = jQuery(this).attr('data-height');
      var padding = (h * 100) / w;
      jQuery(this).css('padding-bottom' , padding + "%");
    });

});
