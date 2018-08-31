jQuery(function(){

  var module = $('.sticky__module');
  if (module.length > 0) {
    // sticky elements
    $('.sticky__module .sticky__item').addClass('d-none');

    var $stickyModule = $('.sticky__module').first();
    var $stickyContent = $stickyModule.find('.sticky__content');
    var $stickyElement = $stickyModule.find('.sticky__item');
		$stickyElement.removeClass('d-none'); 
		
		var _stickyHeight = $stickyElement.outerHeight();
		$stickyElement.css({
			transform: "translateY(-"+_stickyHeight+"px) translateZ(0px)",
		});

    var _contentPosition = ($stickyContent.offset().top) + $stickyContent.outerHeight();
  
    $(window).on('scroll', function () {
      var _headerHeight = $('.header__main').outerHeight();
      _stickyHeight = $stickyElement.outerHeight();
      var st = $(this).scrollTop();

      if (st < _contentPosition) {
        $stickyElement.removeClass('active');
        $stickyElement.css({
          transform: "translateY(-"+_stickyHeight+"px) translateZ(0px)",
        });
      } else if (st > _contentPosition) {
        $stickyElement.addClass('active');
        if ($('header').hasClass('header--sticky')) {
          $stickyElement.css({
            transform: "translateY(" + _headerHeight + "px) translateZ(0px)",
          });
        } else {
          $stickyElement.css({
            transform: "translateY(0px) translateZ(0px)",
          });
        }
      }
    });

   

    $(window).on('resize', function(){
      $(window).trigger('scroll');
      _contentPosition = ($stickyContent.offset().top) + $stickyContent.outerHeight();
    });
  }


    
  // input text animation if filled or focus
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

  // cta form validation
	jQuery(".cta-form .send_button").on( 'click', function(e){
    var moduleCtaFormParent = jQuery(this).closest(".cta-form");
    
		e.preventDefault();
		var email = jQuery(moduleCtaFormParent).find("#email").val();
		var expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
		var name = jQuery(moduleCtaFormParent).find("#name").val();
		var lastname = jQuery(moduleCtaFormParent).find("#lastname").val();
		var message = jQuery(moduleCtaFormParent).find("#message").val();
		var sendTo = jQuery(moduleCtaFormParent).find("#sendto").val();
		var eventURL = jQuery(moduleCtaFormParent).find("#eventurl").val();
		var eventTopic = jQuery(moduleCtaFormParent).find("#eventtopic").val();
		var cond1 = true; var cond2 = true; var cond3 = true; var cond4 = true; var cond5 = true;


		//Comprombamos que esté marcadas las condiciones legales
		jQuery(moduleCtaFormParent).find('#label_form p').remove();
		jQuery(moduleCtaFormParent).find('.checkbox').removeClass('error');
		if( !jQuery(moduleCtaFormParent).find('#checkbox_01').is(':checked') ){
			jQuery(moduleCtaFormParent).find('.checkbox').addClass('error');
			jQuery(moduleCtaFormParent).find('#label_form p').remove();
			jQuery(moduleCtaFormParent).find('#label_form').append( "<p>Debes aceptar las Condiciones Legales</p>" );
			cond1 = false;
		}
		//Comprombamos que el correo esté escrito y sea un formato correcto
		jQuery(moduleCtaFormParent).find('.field.field_mail p').remove();
		jQuery(moduleCtaFormParent).find('.field.field_mail').removeClass('error');
		if( email == null || email.length == 0 || !expresion.test(email) ) {
			jQuery(moduleCtaFormParent).find('.field.field_mail').addClass('error');
			jQuery(moduleCtaFormParent).find('.field.field_mail').append( "<p>Introduce un email válido</p>" );
			cond2 = false;
	}
		//Comprombamos el nombre
		jQuery(moduleCtaFormParent).find('.field.field_name p').remove();
		jQuery(moduleCtaFormParent).find('.field.field_name').removeClass('error');
		if( name == null || name.length == 0  ) {
			jQuery(moduleCtaFormParent).find('.field.field_name').addClass('error');
			jQuery(moduleCtaFormParent).find('.field.field_name').append( "<p>Enter a name</p>" );
			cond3 = false;
		 }
		//Comprombamos el apellido
		jQuery(moduleCtaFormParent).find('.field.field_lastname p').remove();
		jQuery(moduleCtaFormParent).find('.field.field_lastname').removeClass('error');
		if( lastname == null || lastname.length == 0 ) {
			jQuery(moduleCtaFormParent).find('.field.field_lastname').addClass('error');
			jQuery(moduleCtaFormParent).find('.field.field_lastname').append( "<p>Enter a lastname</p>" );
			cond4 = false;
		}
		//Comprombamos el mensaje
		jQuery(moduleCtaFormParent).find('.field.field_message p').remove();
		jQuery(moduleCtaFormParent).find('.field.field_message').removeClass('error');
		if( message == null || message.length == 0  ) {
			jQuery(moduleCtaFormParent).find('.field.field_message').addClass('error');
			jQuery(moduleCtaFormParent).find('.field.field_message').append( "<p>Enter a message</p>" );
			cond5 = false;
		}
		//Si entra en if, ha rellenado correctamente formulario
		if ( cond1 && cond2 && cond3 && cond4 && cond5) {
			var emailData = {
				usermail: email,
				username: name,
				userlastname: lastname,
				usermessage: message,
				sendto: sendTo,
				eventurl: eventURL,
				eventtopic: eventTopic
			};
			jQuery.ajax({
				type: "POST",
				url: "#" ,
				data: { action: 'ie_exec_cta_formulario', emaildata: emailData },
				success: function(data) {
					
					jQuery(moduleCtaFormParent).find(".form-content").addClass('d-none');
					jQuery(moduleCtaFormParent).find(".form-error").addClass('d-none');
					jQuery(moduleCtaFormParent).find(".form-success").removeClass('d-none');
					
        },
        error: function(msg) {
          console.log(msg.statusText);
          jQuery(moduleCtaFormParent).find(".form-error").removeClass('d-none');
        }
        
			});
		}

	});



});
