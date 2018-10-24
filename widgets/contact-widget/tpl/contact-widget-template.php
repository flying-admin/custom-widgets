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
          <p class="fp_contact__content__item__title"><?php echo $contact['contact_title']; ?></p>
          <?php if($contact['contact_address'] != ''): ?>
            <p class="fp_contact__content__item__address"><?php echo str_replace(array("\r","\n"), "<br/>", $contact['contact_address']); ?></p>
          <?php endif; ?>
          <?php if($contact['contact_phone'] != ''): ?>
            <p class="fp_contact__content__item__phone">
              <a href="tel:<?php echo $contact['contact_phone']; ?>"><?php echo $contact['contact_phone']; ?></a>
            </p>
          <?php endif; ?>
          <?php if($contact['contact_email'] != ''): ?>
            <p class="fp_contact__content__item__email">
              <a href="mailto:<?php echo $contact['contact_email']; ?>"><?php echo $contact['contact_email']; ?></a>
            </p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
