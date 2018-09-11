jQuery(function(){
  console.log('wysiwyg-widget - ready');

  $('.modal.modal--wysiwyg').on('show.bs.modal', function () {
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
      $iframe.attr('src', src + 'autoplay=1');
    }
  });

  $('.modal.modal--wysiwyg').on('hide.bs.modal', function () {
    var $modal = $(this);
    var $iframe = $modal.find('iframe.video-iframe');
    if ($iframe.length){
      var src = $iframe.data('src');

      $iframe.attr('src', src);
    }
  });

});
