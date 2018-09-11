jQuery(function(){
  console.log('video-widget - ready');

    $('.modal.modal--video').on('show.bs.modal', function () {
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

    $('.modal.modal--video').on('hide.bs.modal', function () {
      var $modal = $(this);
      var $iframe = $modal.find('iframe.video-iframe');
      if ($iframe.length){
        var src = $iframe.data('src');

        $iframe.attr('src', src);
      }
    });

    // $('.modal.modal--video').on('hidden.bs.modal', function (e) {
    //   $('.video-iframe').each(function(){
    //     $(this).attr("src",$(this).attr("src"));
    //   });
    //
    //   $('.video-iframe.vimeo').each(function(index) {
    //     console.log("vimeo", $(this));
    //     $(this)[0].contentWindow.postMessage('{"method":"unload"}','*');
    //   });
    // });
    //
    // $('.content_image').each(function () {
    //   var w = $(this).attr('data-width');
    //   var h = $(this).attr('data-height');
    //   var padding = (h * 100) / w;
    //   $(this).css('padding-bottom' , padding + "%");
    // });

});
