jQuery(function(){
  console.log('wysiwyg-widget - ready');

    jQuery('.modal.modal--video').on('hidden.bs.modal', function (e) {
      jQuery('.video-iframe').each(function(){
        jQuery(this).attr("src",jQuery(this).attr("src"));
      });

      jQuery('.video-iframe.vimeo').each(function(index) {
        console.log("vimeo", jQuery(this));
        jQuery(this)[0].contentWindow.postMessage('{"method":"unload"}','*');
      });
    });

    jQuery('.content_image').each(function () {
      var w = jQuery(this).attr('data-width');
      var h = jQuery(this).attr('data-height');
      var padding = (h * 100) / w;
      jQuery(this).css('padding-bottom' , padding + "%");
    });

});
