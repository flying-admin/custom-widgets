jQuery(function(){
  console.log('introduction-horizontal-widget - ready');

    $('.fp_introduction-h .content_image').each(function () {
      var $img = $(this);
      var w = $img.data('width');
      var h = $img.data('height');
      var padding = (h * 100) / w;
      $img.css('padding-top' , padding + "%");
    });

});
