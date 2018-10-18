jQuery(function(){
  console.log('claim-widget - ready');

  var $claimVideo = $('.fp_claim__video');
  if($claimVideo.length){
    $claimVideo.each(function(){
      claimVideoHandler(this);
    });

    $(window).on('resize', function(){
      $claimVideo.each(function(){
        claimVideoHandler(this);
      });
    });

    function claimVideoHandler(video){
      var $video = $(video);
      var $iframe = $video.find('iframe.fp_claim__video__iframe');
      var height = $video.height();
      var width = $video.width();

      var proportion = 0.5625;

      var finalHeight = 0;
      var finalWidth = 0;

      if ((height / proportion) >= width){
        var finalHeight = height;
        var finalWidth = height / proportion;
      }
      else {
        var finalWidth = width;
        var finalHeight = width * proportion;
      }

      $iframe.css({
        'height': finalHeight + 'px',
        'width': finalWidth + 'px'
      });
    }

    $('.modal.modal--claim').on('show.bs.modal', function () {
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

    $('.modal.modal--claim').on('hide.bs.modal', function () {
      var $modal = $(this);
      var $iframe = $modal.find('iframe.video-iframe');
      if ($iframe.length){
        var src = $iframe.data('src');

        $iframe.attr('src', src);
      }
    });
  }

});
