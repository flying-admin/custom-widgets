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
      var st = $(this).scrollTop();
      var _headerHeight = $('.header__main').outerHeight();
      _stickyHeight = $stickyElement.outerHeight();

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
  $(".field input, .field textarea").each(function(){
    var attr = $(this).attr('placeholder');
    var $label = $(this).closest(".field").find('span').first();

    if( $(this).val() != '' ){
      $label.addClass('active');
    }
    else if( typeof attr !== typeof undefined && attr !== false ) {
      if(attr.length != 0){
        $label.addClass('active');
      }
    }
  });

  $(".field input, .field textarea").on('focus', function(){
    var $label = $(this).closest(".field").find('span').first();

    if( !$label.hasClass('active') ){
      $label.addClass('active');
    }
  });

  $(".field input, .field textarea").on('blur', function(){
    var attr = $(this).attr('placeholder');
    var $label = $(this).closest(".field").find('span').first();

    if( $(this).val() != '' ){
      var $label = $(this).closest(".field").find('span').first();
      $label.addClass('active');
    }
    else if( typeof attr !== typeof undefined && attr !== false ) {
      if(attr.length != 0){
        $label.addClass('active');
      }
    }
    else {
      $label.removeClass('active');
    }
  });

  // cta form validation
  $(".cta-form .send_button").on( 'click', function(e){
    e.preventDefault();

    var $moduleCtaForm = $(this).closest(".cta-form");
    var expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;

    var sendTo = $moduleCtaForm.find("#sendto").val();
    var eventURL = $moduleCtaForm.find("#eventurl").val();
    var eventTopic = $moduleCtaForm.find("#eventtopic").val();
    var cond1 = true, cond2 = true, cond3 = true, cond4 = true, cond5 = true;

    // Comprombamos que esté marcadas las condiciones legales
    var legalWrap = $moduleCtaForm.find('.checkbox');
    var legalLabel = legalWrap.find('.field_legal');
    var legalInput = legalLabel.find('#legal');
    var legalError = legalLabel.find('p');
    legalError.remove();
    legalWrap.removeClass('error');
    if( !legalInput.is(':checked') ){
      var legalValidation = legalInput.data('validation');
      legalError.remove();
      legalLabel.append( "<p>" + legalValidation + "</p>" );
      legalWrap.addClass('error');
      cond1 = false;
    }

    // Comprombamos que el correo esté escrito y sea un formato correcto
    var emailLabel = $moduleCtaForm.find('.field.field_email');
    var emailInput = emailLabel.find('#email');
    if (emailInput.length){
      var emailValue = emailInput.val();
      var emailError = emailLabel.find('p');

      emailError.remove();
      emailLabel.removeClass('error');
      if( emailValue == null || emailValue.length == 0 || !expresion.test(emailValue) ) {
        var emailValidation = emailInput.data('validation');
        emailError.remove();
        emailLabel.append( "<p>" + emailValidation + "</p>" );
        emailLabel.addClass('error');
        cond2 = false;
      }
    }

    // Comprombamos el nombre
    var firstnameLabel = $moduleCtaForm.find('.field.field_firstname');
    var firstnameInput = firstnameLabel.find('#firstname');
    if (firstnameInput.length){
      var firstnameValue = firstnameInput.val();
      var firstnameError = firstnameLabel.find('p');

      firstnameError.remove();
      firstnameLabel.removeClass('error');
      if( firstnameValue == null || firstnameValue.length == 0 ) {
        var firstnameValidation = firstnameInput.data('validation');
        firstnameError.remove();
        firstnameLabel.append( "<p>" + firstnameValidation + "</p>" );
        firstnameLabel.addClass('error');
        cond3 = false;
      }
    }

    // Comprombamos el apellido
    var lastnameLabel = $moduleCtaForm.find('.field.field_lastname');
    var lastnameInput = lastnameLabel.find('#lastname');
    if (lastnameInput.length){
      var lastnameValue = lastnameInput.val();
      var lastnameError = lastnameLabel.find('p');

      lastnameError.remove();
      lastnameLabel.removeClass('error');
      if( lastnameValue == null || lastnameValue.length == 0 ) {
        var lastnameValidation = lastnameInput.data('validation');
        lastnameError.remove();
        lastnameLabel.append( "<p>" + lastnameValidation + "</p>" );
        lastnameLabel.addClass('error');
        cond4 = false;
      }
    }

    // Comprombamos el mensaje
    var messageLabel = $moduleCtaForm.find('.field.field_message');
    var messageInput = messageLabel.find('#message');
    if (messageInput.length){
      var messageValue = messageInput.val();
      var messageError = messageLabel.find('p');

      messageError.remove();
      messageLabel.removeClass('error');
      if( messageValue == null || messageValue.length == 0 ) {
        var messageValidation = messageInput.data('validation');
        messageError.remove();
        messageLabel.append( "<p>" + messageValidation + "</p>" );
        messageLabel.addClass('error');
        cond5 = false;
      }
    }

    var validationError = $moduleCtaForm.find('.validation-error');
    validationError.remove();

    // Si entra en if, ha rellenado correctamente formulario
    if ( cond1 && cond2 && cond3 && cond4 && cond5 ) {
      var formData = {
        userfirstname: firstnameValue,
        userlastname: lastnameValue,
        useremail: emailValue,
        usermessage: messageValue,
        sendto: sendTo,
        eventurl: eventURL,
        eventtopic: eventTopic
      };

      $.ajax({
        type: "POST",
        url: "#" ,
        data: { action: 'ie_exec_cta_formulario', emaildata: formData },
        success: function(data) {
          $moduleCtaForm.find(".form-content").addClass('d-none');
          $moduleCtaForm.find(".form-error").addClass('d-none');
          $moduleCtaForm.find(".form-success").removeClass('d-none');
        },
        error: function(msg) {
          console.log(msg.statusText);
          $moduleCtaForm.find(".form-error").removeClass('d-none');
        }
      });
    }
    else {
      var generalValidation = $moduleCtaForm.data('validation');
      $moduleCtaForm.prepend( "<p class='validation-error'>" + generalValidation + "</p>" );
    }
  });
});
