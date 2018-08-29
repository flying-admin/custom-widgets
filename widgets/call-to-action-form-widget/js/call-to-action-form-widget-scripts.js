jQuery(function(){
  console.log('call-to-action-form-widget - ready');
  jQuery(".field input").each(function(){

    var attr = jQuery(this).attr('placeholder');

    var $label = jQuery(this).closest(".field").find('span').first();
    if(jQuery(this).val() != '' ){
      $label.addClass('active');
    }else if( typeof attr !== typeof undefined && attr !== false ) {
      if(attr.length != 0){
        $label.addClass('active');
      }
    }
  });

  jQuery(".field input").on('focus', function(){
    var $label = jQuery(this).closest(".field").find('span').first();
    $label.addClass('active');
  });

  jQuery(".field input").on('blur', function(){
    var attr = jQuery(this).attr('placeholder');

    var $label = jQuery(this).closest(".field").find('span').first();
    
    if( jQuery(this).val() != '' ){
      var $label = jQuery(this).closest(".field").find('span').first();
      $label.addClass('active');
    }else if( typeof attr !== typeof undefined && attr !== false ) {
      if(attr.length != 0){
        $label.addClass('active');
      }
    }else{
      $label.removeClass('active');
    }
  });

});
