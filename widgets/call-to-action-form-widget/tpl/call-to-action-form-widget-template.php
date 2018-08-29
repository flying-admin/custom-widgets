<?php
  $pageName ='';
  if($post->post_parent) {
    $parent_title = get_the_title($post->post_parent);
    $pageName = $parent_title;
  }
  else {
    $pageName = get_the_title($post->ID);
  }
?>

<div class="fp_cta_form fp_module">
  <div class="fp_cta_form__content">
    <div class="row">
      <div class="fp_cta_form__content__contact-info">
        <?php if($image != ''): ?>
          <img src="<?php echo $image; ?>" alt="" class="fp_cta_form__content__contact-info__img">
        <?php endif; ?> 
        
        <?php if($contact_person != ''): ?>
          <div class="fp_cta_form__content__contact-info__name"><?php echo $contact_person; ?></div>
        <?php endif; ?> 
        
        <?php if($chargue != ''): ?>
          <div class="fp_cta_form__content__contact-info__position"><?php echo $chargue; ?></div>
        <?php endif; ?> 
        
        <?php if( $contact_email != '' || $contact_phone != '' ): ?>
          <div class="fp_cta_form__content__contact-info__contact">
            <?php if( $contact_email != ''): ?>
            <a href="mailto:"> 
              <?php echo siteorigin_widget_get_icon( 'ionicons-ios-email-outline' ); ?>
              <?php echo $contact_email; ?>
            </a>
            <?php endif; ?> 
            
            <?php if($contact_phone != ''): ?>
            <a href="tel:+">
              <?php echo siteorigin_widget_get_icon( 'ionicons-ios-telephone-outline' ); ?>
              <?php echo $contact_phone; ?>
            </a>
            <?php endif; ?> 
          </div>
        <?php endif; ?> 
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10 col-sm-12">
        <h2 class="fp_cta_form__content__title">
          <?php echo $title; ?>
        </h2>
        <?php if($description != ''): ?>
        <p class="fp_cta_form__content__description hidden-sm-down">
          <?php echo $description; ?>
        </p>
        <?php endif; ?>
      </div>
    </div>
    <?php if( $add_form == 'yes' && $fp_ctaf != ''): ?>
      <div class="row">
        <form action="" class="cta-form">
          <div class="form-content">
            <label class="field">
              <span class="">Nombre</span>
              <input id="name" type="text" name="name" value="" size="40">
            </label>
            <label class="field">
              <span class="">Apellidos</span>
              <input id="lastname" type="text" name="name" value="" size="40">
            </label>
            <label class="field">
              <span>Email</span>
              <input id="email" type="email" placeholder="example@example.com">
            </label>
            <label class="field field_message">
              <span class="">Mensaje</span>
              <input id="message" type="text" name="Message" value="" size="250">
            </label>
            <div class="checkbox">
              <label id="label_form" for="checkbox_01">
                <input type="checkbox" id="checkbox_01">
                <span class="icon-check">Acepto las
                  <a href="https://www.ie.edu/politica-privacidad" target="_blank">Condiciones legales</a>
                </span>
              </label>
            </div>
            <input type="submit" class="" value="Enviar">
            <input id="sendto" type="hidden" value="$fp_ctaf">
            <input id="eventurl" type="hidden" value="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
            <input id="eventtopic" type="hidden" value="<?php echo $pageName ?>">
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="form_confirmation hidden">
            <i class="icon-check"></i>
            <h5 class="form_confirmation__title">Gracias</h5>
            <p class="form_confirmation__subtitle">La información se ha enviado correctamente</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>


<?php
  foreach ($instance as $key => $value) {
    echo $key . ': ' . $value . '<br/>';
    if (is_array($value)){
      foreach ($value as $k => $v) {
        echo '- '.$k . ': ' . $v . '<br/>';
      }
      echo '<br/>';
    }
  }
?>


