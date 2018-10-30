<div class="fp_contact">
  <div class="fp_contact--inner">
    <div class="fp_contact__header">
      <p class="fp_contact__header__title"><?php echo $title; ?></p>
      <p class="fp_contact__header__text"><?php echo $text; ?></p>
    </div>
    <div class="fp_contact__content">
      <?php foreach ($contacts as $contact): ?>
        <div class="fp_contact__content__item">
          <p class="fp_contact__content__item__name"><?php echo $contact['contact_name']; ?></p>
          <?php if($contact['contact_desc'] != ''): ?>
            <p class="fp_contact__content__item__desc"><?php echo str_replace(array("\r","\n"), "<br/>", $contact['contact_desc']); ?></p>
          <?php endif; ?>
          <?php foreach ($contact['departments'] as $dept): ?>
            <div class="fp_contact__content__item--dept">
              <p class="fp_contact__content__item__title"><?php echo $dept['department_title']; ?></p>
              <?php if($dept['department_address'] != ''): ?>
                <p class="fp_contact__content__item__address"><?php echo str_replace(array("\r","\n"), "<br/>", $dept['department_address']); ?></p>
              <?php endif; ?>
              <?php if($dept['department_phone'] != ''): ?>
                <p class="fp_contact__content__item__phone">
                  <a href="tel:<?php echo $dept['department_phone']; ?>"><?php echo $dept['department_phone']; ?></a>
                </p>
              <?php endif; ?>
              <?php if($dept['department_email'] != ''): ?>
                <p class="fp_contact__content__item__email">
                  <a href="mailto:<?php echo $dept['department_email']; ?>"><?php echo $dept['department_email']; ?></a>
                </p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
