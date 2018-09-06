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
  $(".field input").each(function(){
    var attr = $(this).attr('placeholder');

    var $label = $(this).closest(".field").find('span').first();
    if( $(this).val() != '' ){
      $label.addClass('active');
    } else if( typeof attr !== typeof undefined && attr !== false ) {
      if(attr.length != 0){
        $label.addClass('active');
      }
    }
  });

  $(".field input").on('focus', function(){
    var $label = $(this).closest(".field").find('span').first();
    $label.addClass('active');
  });

  $(".field input").on('blur', function(){
    var attr = $(this).attr('placeholder');

    var $label = $(this).closest(".field").find('span').first();

    if( $(this).val() != '' ){
      var $label = $(this).closest(".field").find('span').first();
      $label.addClass('active');
    } else if( typeof attr !== typeof undefined && attr !== false ) {
      if(attr.length != 0){
        $label.addClass('active');
      }
    } else {
      $label.removeClass('active');
    }
  });

  // cta form validation
  $(".cta-form .send_button").on( 'click', function(e){
    var moduleCtaFormParent = $(this).closest(".cta-form");

    e.preventDefault();
    var email = $(moduleCtaFormParent).find("#email").val();
    var expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
    var name = $(moduleCtaFormParent).find("#name").val();
    var lastname = $(moduleCtaFormParent).find("#lastname").val();
    var message = $(moduleCtaFormParent).find("#message").val();
    var sendTo = $(moduleCtaFormParent).find("#sendto").val();
    var eventURL = $(moduleCtaFormParent).find("#eventurl").val();
    var eventTopic = $(moduleCtaFormParent).find("#eventtopic").val();
    var cond1 = true; var cond2 = true; var cond3 = true; var cond4 = true; var cond5 = true;

    //Comprombamos que esté marcadas las condiciones legales
    $(moduleCtaFormParent).find('#label_form p').remove();
    $(moduleCtaFormParent).find('.checkbox').removeClass('error');
    if( !$(moduleCtaFormParent).find('#checkbox_01').is(':checked') ){
      $(moduleCtaFormParent).find('.checkbox').addClass('error');
      $(moduleCtaFormParent).find('#label_form p').remove();
      $(moduleCtaFormParent).find('#label_form').append( "<p>Please accept the Legal terms</p>" );
      cond1 = false;
    }

    //Comprombamos que el correo esté escrito y sea un formato correcto
    $(moduleCtaFormParent).find('.field.field_mail p').remove();
    $(moduleCtaFormParent).find('.field.field_mail').removeClass('error');
    if( email == null || email.length == 0 || !expresion.test(email) ) {
      $(moduleCtaFormParent).find('.field.field_mail').addClass('error');
      $(moduleCtaFormParent).find('.field.field_mail').append( "<p>Please enter a valid Email</p>" );
      cond2 = false;
    }

    //Comprombamos el nombre
    $(moduleCtaFormParent).find('.field.field_name p').remove();
    $(moduleCtaFormParent).find('.field.field_name').removeClass('error');
    if( name == null || name.length == 0  ) {
      $(moduleCtaFormParent).find('.field.field_name').addClass('error');
      $(moduleCtaFormParent).find('.field.field_name').append( "<p>Please enter a Name</p>" );
      cond3 = false;
    }

    //Comprombamos el apellido
    $(moduleCtaFormParent).find('.field.field_lastname p').remove();
    $(moduleCtaFormParent).find('.field.field_lastname').removeClass('error');
    if( lastname == null || lastname.length == 0 ) {
      $(moduleCtaFormParent).find('.field.field_lastname').addClass('error');
      $(moduleCtaFormParent).find('.field.field_lastname').append( "<p>Please enter a Last name</p>" );
      cond4 = false;
    }

    //Comprombamos el mensaje
    $(moduleCtaFormParent).find('.field.field_message p').remove();
    $(moduleCtaFormParent).find('.field.field_message').removeClass('error');
    if( message == null || message.length == 0  ) {
      $(moduleCtaFormParent).find('.field.field_message').addClass('error');
      $(moduleCtaFormParent).find('.field.field_message').append( "<p>Please enter a Message</p>" );
      cond5 = false;
    }

    //Si entra en if, ha rellenado correctamente formulario
    if ( cond1 && cond2 && cond3 && cond4 && cond5 ) {
      var emailData = {
        usermail: email,
        username: name,
        userlastname: lastname,
        usermessage: message,
        sendto: sendTo,
        eventurl: eventURL,
        eventtopic: eventTopic
      };

      $.ajax({
        type: "POST",
        url: "#" ,
        data: { action: 'ie_exec_cta_formulario', emaildata: emailData },
        success: function(data) {
          $(moduleCtaFormParent).find(".form-content").addClass('d-none');
          $(moduleCtaFormParent).find(".form-error").addClass('d-none');
          $(moduleCtaFormParent).find(".form-success").removeClass('d-none');
        },
        error: function(msg) {
          console.log(msg.statusText);
          $(moduleCtaFormParent).find(".form-error").removeClass('d-none');
        }
      });
    }
  });
});
