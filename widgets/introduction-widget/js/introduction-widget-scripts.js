jQuery(function(){
  console.log('introduction-widget - ready');

    jQuery('.modal.modal--video').on('hidden.bs.modal', function (e) {
      jQuery('.video-iframe').each(function(){
        jQuery(this).attr("src",jQuery(this).attr("src"));
      });

      jQuery('.video-iframe.vimeo').each(function(index) {
        console.log("vimeo", jQuery(this));
        jQuery(this)[0].contentWindow.postMessage('{"method":"unload"}','*');
      });
    });

});
