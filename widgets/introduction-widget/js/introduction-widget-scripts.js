jQuery(function(){
  console.log('introduction-widget - ready');

  $('.modal.modal--introduction').on('show.bs.modal', function () {
    var $modal = $(this);
    var $iframe = $modal.find('iframe.video-iframe');
    if ($iframe.length){
      var src = '';
      var attr = $iframe.attr('data-src');

      // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
      if (typeof attr === typeof undefined || attr === false) {
        $iframe.data('src', $iframe.attr('src'));
      }
      src = $iframe.data('src');
      $iframe.attr('src', src + '&autoplay=1');
    }
  });

  $('.modal.modal--introduction').on('hide.bs.modal', function () {
    var $modal = $(this);
    var $iframe = $modal.find('iframe.video-iframe');
    if ($iframe.length){
      var src = $iframe.data('src');

      $iframe.attr('src', src);
    }
  });

  $('.fp_introduction .content_image').each(function () {
    var $img = $(this);
    var w = $img.data('width');
    var h = $img.data('height');
    var padding = (h * 100) / w;
    $img.css('padding-top' , padding + "%");
  });

});
