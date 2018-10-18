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
    <div class="fp_cta_form <?php if( $add_sticky == 'yes' && $add_form == 'yes' && $fp_ctaf != ''): ?> sticky__module  <?php endif; ?> ">
      <div class="fp_cta_form__content <?php if( $add_sticky == 'yes' && $add_form == 'yes' && $fp_ctaf != ''): ?> sticky__content  <?php endif; ?>">
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

                <?php if($charge != ''): ?>
                  <p class="fp_cta_form__content__contact_info__text"><?php echo $charge; ?></p>
                <?php endif; ?>

                <?php if( $contact_email != '' || $contact_phone != '' ): ?>
                  <div class="fp_cta_form__content__contact_info__contact">

                    <?php if( $contact_email != ''): ?>
                      <a href="mailto:<?php echo $contact_email; ?>" class="link--primary">
                        <?php echo siteorigin_widget_get_icon( 'ionicons-ios-email-outline' ); ?>
                        <?php echo $contact_email; ?>
                      </a>
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
              <div class="cta-form" data-validation="<?php echo __('Please fill in the required fields', 'custom-widgets'); ?>.">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-content">
                      <?php if($form['firstname']): ?>
                        <label class="field field_firstname">
                          <span class=""><?php echo __('First name', 'custom-widgets'); ?></span>
                          <input type="text" id="firstname" name="firstname" value="" data-validation="<?php echo __('Please enter your First name', 'custom-widgets'); ?>"/>
                        </label>
                      <?php endif; ?>
                      <?php if($form['lastname']): ?>
                        <label class="field field_lastname">
                          <span class=""><?php echo __('Last name', 'custom-widgets'); ?></span>
                          <input type="text" id="lastname" name="lastname" value="" data-validation="<?php echo __('Please enter your Last name', 'custom-widgets'); ?>"/>
                        </label>
                      <?php endif; ?>
                      <?php if($form['email']): ?>
                        <label class="field field_email">
                          <span><?php echo __('Email', 'custom-widgets'); ?></span>
                          <input type="email" id="email" name="email" value="" data-validation="<?php echo __('Please enter a valid Email', 'custom-widgets'); ?>"/>
                        </label>
                      <?php endif; ?>
                      <?php if($form['message']): ?>
                        <label class="field field_message">
                          <span class=""><?php echo __('Message', 'custom-widgets'); ?></span>
                          <textarea id="message" name="message" rows="3" data-validation="<?php echo __('Please enter your Message', 'custom-widgets'); ?>"></textarea>
                        </label>
                      <?php endif; ?>
                      <div class="row align-items-center">
                        <div class="col-sm-12 col-md mt-3">
                          <div class="checkbox">
                            <label class="field_legal" for="legal">
                              <input type="checkbox" id="legal" name="legal" data-validation="<?php echo __('Please accept the Legal terms', 'custom-widgets'); ?>"/>
                              <span class="icon-check">
                                <?php echo __('I accept the', 'custom-widgets'); ?> <a href="<?php echo __('https://www.ie.edu/privacy-policy', 'custom-widgets') ?>" class="link--primary" target="_blank"><?php echo __('Legal terms', 'custom-widgets'); ?>.</a>
                              </span>
                            </label>
                          </div>
                        </div>
                        <div class="col text-md-right mt-3">
                          <button class="btn btn--primary send_button"><span><?php echo __('Send', 'custom-widgets'); ?></span></button>
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
                    <div class="form-success d-none">
                      <p class="form-success__title"><?php echo __('Thank you', 'custom-widgets'); ?></p>
                      <p class="form-success__subtitle"><?php echo __('The form has been sent succesfully', 'custom-widgets'); ?></p>
                    </div>
                    <div class="form-error d-none">
                      <p class="form-error__title"><?php echo __('Oops! Something went wrong, please try again later', 'custom-widgets'); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <div class="row">
                <div class="col-sm-12">
                  <a href="<?php echo $form_link_url; ?>" class="btn btn--primary mt-4" <?php if($new_window): ?> target="_blank" <?php endif; ?>>
                    <span><?php echo $form_link_text; ?> <?php echo siteorigin_widget_get_icon( 'genericons-external' ); ?></span>
                  </a>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php if( $add_sticky == 'yes' && $add_form == 'yes' && $fp_ctaf != ''): ?>
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

                      <?php if($charge != ''): ?>
                        <p class="fp_cta_form__content__contact_info__text"><?php echo $charge; ?></p>
                      <?php endif; ?>

                      <?php if( $contact_email != '' || $contact_phone != '' ): ?>
                        <div class="fp_cta_form__content__contact_info__contact d-none d-lg-block">

                          <?php if( $contact_email != ''): ?>
                            <a href="mailto:<?php echo $contact_email; ?>" class="link--primary">
                              <?php echo siteorigin_widget_get_icon( 'ionicons-ios-email-outline' ); ?>
                              <?php echo $contact_email; ?>
                            </a>
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
                <a href="#fp_cta_form-<?php echo $form_id; ?>" class="btn btn--primary">
                  <span><?php echo __('Any questions?', 'custom-widgets'); ?></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
