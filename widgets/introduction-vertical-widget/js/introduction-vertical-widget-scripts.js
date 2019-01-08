jQuery(function(){
  console.log('introduction-vertical-widget - ready');

    $('.modal.modal--video').on('hidden.bs.modal', function (e) {
      $('.video-iframe').each(function(){
        $(this).attr("src",$(this).attr("src"));
      });

      $('.video-iframe.vimeo').each(function(index) {
        console.log("vimeo", $(this));
        $(this)[0].contentWindow.postMessage('{"method":"unload"}','*');
      });
    });

    // $('.fp_introduction-v .content_image').each(function () {
    //   var $img = $(this);
    //   var w = $img.data('width');
    //   var h = $img.data('height');
    //   var padding = (h * 100) / w;
    //   $img.css('padding-top' , padding + "%");
    // });

});
