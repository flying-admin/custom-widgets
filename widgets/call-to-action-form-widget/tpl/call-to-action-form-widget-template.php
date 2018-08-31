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
<div class="fp_module bg-light" <?php if( $add_form == 'yes' && $fp_ctaf != ''): ?>id="fp_cta_form-<?php echo $form_id; ?>" <?php endif; ?> >
  <div class="fp_module__content">
    <div class="fp_cta_form <?php if( $add_form == 'yes' && $fp_ctaf != ''): ?> sticky__module  <?php endif; ?> ">
      <div class="fp_cta_form__content <?php if( $add_form == 'yes' && $fp_ctaf != ''): ?> sticky__content  <?php endif; ?>">
        <div class="row align-items-center">
          <div class="col-xl-6 col-sm-12">
            <div class="fp_cta_form__content__contact_info text-center text-xl-center text-md-left text-lg-left d-md-flex d-lg-flex d-xl-block">
              <?php if($image != ''): ?>
                <img src="<?php echo $image; ?>" alt="" class="fp_cta_form__content__contact_info__img" />
              <?php endif; ?> 
              <div>
                <?php if($contact_person != ''): ?>
                  <p class="fp_cta_form__content__contact_info__title"><?php echo $contact_person; ?></p>
                <?php endif; ?> 
                
                <?php if($chargue != ''): ?>
                  <p class="fp_cta_form__content__contact_info__text"><?php echo $chargue; ?></p>
                <?php endif; ?> 
                
                <?php if( $contact_email != '' || $contact_phone != '' ): ?>
                  <div class="fp_cta_form__content__contact_info__contact">

                    <?php if( $contact_email != ''): ?>
                    <a href="mailto:<?php echo $contact_email; ?>" class="link--primary"> 
                      <?php echo siteorigin_widget_get_icon( 'ionicons-ios-email-outline' ); ?>
                      <?php echo $contact_email; ?>
                    </a><br class="d-block d-md-none" />
                    <?php endif; ?> 
                    
                    <?php if($contact_phone != ''): ?>
                    <a href="tel:<?php echo $contact_phone; ?>" class="link--primary">
                      <?php echo siteorigin_widget_get_icon( 'ionicons-ios-telephone-outline' ); ?>
                      <?php echo $contact_phone; ?>
                    </a>
                    <?php endif; ?> 

                  </div>
                <?php endif; ?> 
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-sm-12">
            <div class="row no-gutters">
              <div class="col-10 col-xl-12 mt-4 mt-md-0">
                <h2 class="fp_cta_form__content__title">
                  <?php echo $title; ?>
                </h2>
                <?php if($description != ''): ?>
                <p class="fp_cta_form__content__text <?php if( $add_form == 'yes' && $fp_ctaf != '' ): ?> d-none d-md-block  <?php endif; ?>">
                  <?php echo $description; ?>
                </p>
                <?php endif; ?>
              </div>
            </div>
            <?php if( $add_form == 'yes' && $fp_ctaf != ''): ?>
            <div class="cta-form">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-content">
                    <label class="field field_name">
                      <span class="">Nombre</span>
                      <input id="name" type="text" name="name" value="" />
                    </label>
                    <label class="field field_lastname">
                      <span class="">Apellidos</span>
                      <input id="lastname" type="text" name="lastname" value="" />
                    </label>
                    <label class="field field_mail">
                      <span>Email</span>
                      <input id="email" type="email" name="email" placeholder="example@example.com" />
                    </label>
                    <label class="field field_message">
                      <span class="">Mensaje</span>
                      <input id="message" type="text" name="message" value="" />
                    </label>
                    <div class="row align-items-center">
                      <div class="col-sm-12 col-md mt-3">
                        <div class="checkbox">
                          <label id="label_form" for="checkbox_01">
                            <input type="checkbox" id="checkbox_01" />
                            <span class="icon-check">Acepto las
                              <a href="https://www.ie.edu/politica-privacidad" class="link--primary" target="_blank">Condiciones legales</a>
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="col text-md-right mt-3">
                        <button class="btn btn--primary send_button" ><span>Enviar</span></button>
                      </div>
                    </div>
                    <input id="sendto" type="hidden" value="<?php echo $fp_ctaf ?>" />
                    <input id="eventurl" type="hidden" value="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
                    <input id="eventtopic" type="hidden" value="<?php echo $pageName ?>" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form_confirmation d-none form-success">
                    <i class="icon-check"></i>
                    <h5 class="form_confirmation__title">Gracias</h5>
                    <p class="form_confirmation__subtitle">La información se ha enviado correctamente</p>
                  </div>
                  <div class="form-error d-none">
                    <h1>Error en el envio de formulario</h1>
                  </div>
                </div>
              </div>
            </div>
            <?php else: ?>
            <div class="row">
              <div class="col-sm-12">
                <a href="<?php echo $form_link_url; ?>" class="btn btn--primary mt-4">
                  <span><?php echo $form_link_text; ?> <?php echo siteorigin_widget_get_icon( 'genericons-external' ); ?></span>
                </a>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php if( $add_form == 'yes' && $fp_ctaf != ''): ?>
        <div class="fp_cta_form__sticky sticky__item">
          <div class="sticky__item__content">
            <div class="row">
              <div class="col-md-7 d-none d-md-block col-lg-9 ">
                <div class="d-flex align-items-center align-items-lg-start">
                    <?php if($image != ''): ?>
                      <img src="<?php echo $image; ?>" alt="" class="fp_cta_form__content__contact_info__img mr-3" />
                    <?php endif; ?> 
                    <div>
                      <?php if($contact_person != ''): ?>
                        <p class="fp_cta_form__content__contact_info__title"><?php echo $contact_person; ?></p>
                      <?php endif; ?> 
                      
                      <?php if($chargue != ''): ?>
                        <p class="fp_cta_form__content__contact_info__text"><?php echo $chargue; ?></p>
                      <?php endif; ?> 
                      <?php if( $contact_email != '' || $contact_phone != '' ): ?>
                        <div class="fp_cta_form__content__contact_info__contact d-none d-lg-block">

                          <?php if( $contact_email != ''): ?>
                          <a href="mailto:<?php echo $contact_email; ?>" class="link--primary">
                            <?php echo siteorigin_widget_get_icon( 'ionicons-ios-email-outline' ); ?>
                            <?php echo $contact_email; ?>
                          </a>
                          <br class="d-block d-md-none" />
                          <?php endif; ?>

                          <?php if($contact_phone != ''): ?>
                          <a href="tel:<?php echo $contact_phone; ?>" class="link--primary">
                            <?php echo siteorigin_widget_get_icon( 'ionicons-ios-telephone-outline' ); ?>
                            <?php echo $contact_phone; ?>
                          </a>
                          <?php endif; ?>

                        </div>
                      <?php endif; ?>
                    </div>
                  </div>  
              </div>
              <div class="col-12 col-md-5 col-lg-3 text-right">
                <a href="#fp_cta_form-<?php echo $form_id; ?>" class="btn btn--primary mt-md-4">
                  <span>¿Tienes alguna duda?</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>



