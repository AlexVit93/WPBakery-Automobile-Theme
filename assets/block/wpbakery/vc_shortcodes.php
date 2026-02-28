<?php
add_action('vc_before_init', 'westmotors_hero_block');
function westmotors_hero_block() {
  vc_map(array(
    'name' => 'Hero Block',
    'base' => 'westmotors_hero',
    'description' => 'Hero секция для сайта',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок',
        'param_name' => 'title',
        'value' => 'Авто из США',
        'admin_label' => true
      ),
      array(
        'type' => 'textarea',
        'heading' => 'Текст до бренда',
        'param_name' => 'subtitle_before',
        'value' => 'Хотите выгодно купить бу автомобиль из Америки с доставкой в Беларусь?'
      ),
      array(
        'type' => 'textfield',
        'heading' => 'Название бренда',
        'param_name' => 'brand',
        'value' => 'WESTMOTORS'
      ),
      array(
        'type' => 'textfield',
        'heading' => 'Текст после бренда',
        'param_name' => 'subtitle_after',
        'value' => 'поможет!'
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Преимущества',
        'param_name' => 'advantages',
        'value' => urlencode(json_encode(array(
          array('text' => 'Экономия до 40%'),
          array('text' => 'Страховка покупки'),
          array('text' => 'Растаможка и доставка')
        ))),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => 'Текст',
            'param_name' => 'text'
          )
        )
      ),
      array(
        'type' => 'textfield',
        'heading' => 'Текст кнопки (основной)',
        'param_name' => 'btn_primary_text',
        'value' => 'Рассчитать стоимость'
      ),
      array(
    'type' => 'textfield',
    'heading' => 'Якорь или ID калькулятора',
    'param_name' => 'btn_primary_link',
    'value' => '#calculator',
    'description' => 'Укажите якорь (#section) или ID формы калькулятора (например: 456)'
),
array(
    'type' => 'textfield',
    'heading' => 'Якорь или ID формы',
    'param_name' => 'btn_secondary_link',
    'value' => '#consultation',
    'description' => 'Укажите якорь (#section) или ID формы Contact Form 7 (например: 123)'
),
     
      array(
        'type' => 'textfield',
        'heading' => 'ID видео YouTube',
        'param_name' => 'video_id',
        'value' => 'GrnnF7OOaHA'
      ),
      array(
        'type' => 'checkbox',
        'heading' => 'Соцсети',
        'param_name' => 'socials',
        'value' => array(
          'Viber' => 'viber',
          'Telegram' => 'telegram',
          'WhatsApp' => 'whatsapp'
        )
      )
    )
  ));
}

add_shortcode('westmotors_hero', 'westmotors_hero_render');
function westmotors_hero_render($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Авто из США',
        'subtitle_before' => 'Хотите выгодно купить бу автомобиль из Америки с доставкой в Беларусь?',
        'brand' => 'WESTMOTORS',
        'subtitle_after' => 'поможет!',
        'advantages' => '',
        'btn_primary_text' => 'Рассчитать стоимость',
        'btn_primary_link' => '#calculator',
        'btn_secondary_text' => 'Получить консультацию',
        'btn_secondary_link' => '#consultation',
        'video_id' => 'GrnnF7OOaHA',
        'socials' => ''
    ), $atts);

    $advantages = vc_param_group_parse_atts($atts['advantages']);
    $advantages_html = '';
    if (is_array($advantages)) {
        foreach ($advantages as $advantage) {
            $advantages_html .= '<div class="hero__advantage">' . esc_html($advantage['text']) . '</div>';
        }
    }

    // Соцсети
    $socials = explode(',', $atts['socials']);
    $socials_html = '';
    if (in_array('viber', $socials)) {
        $socials_html .= '<a href="#" class="hero__social"><i class="fab fa-viber"></i></a>';
    }
    if (in_array('telegram', $socials)) {
        $socials_html .= '<a href="#" class="hero__social"><i class="fab fa-telegram"></i></a>';
    }
    if (in_array('whatsapp', $socials)) {
        $socials_html .= '<a href="#" class="hero__social"><i class="fab fa-whatsapp"></i></a>';
    }

    $is_form_secondary = !empty($atts['btn_secondary_link']); 
    $btn_secondary_link = $is_form_secondary ? '#' : esc_attr($atts['btn_secondary_link']);
    $btn_data_secondary = $is_form_secondary ? ' data-form-id="' . esc_attr($atts['btn_secondary_link']) . '"' : '';

    $is_form_primary = !empty($atts['btn_primary_link']); 
    $btn_primary_link = $is_form_primary ? '#' : esc_attr($atts['btn_primary_link']);
    $btn_data_primary = $is_form_primary ? ' data-form-id="' . esc_attr($atts['btn_primary_link']) . '"' : '';

    ob_start(); ?>
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">
                    <section class="hero">
                        <div class="hero__container">
                            <div class="hero__content">
                                <h1 class="hero__title"><?php echo esc_html($atts['title']); ?></h1>
                                <p class="hero__subtitle">
                                    <?php echo esc_html($atts['subtitle_before']); ?>
                                    <span class="hero__brand"><?php echo esc_html($atts['brand']); ?></span>
                                    <?php echo esc_html($atts['subtitle_after']); ?>
                                </p>
                                <div class="hero__advantages">
                                    <?php echo $advantages_html; ?>
                                </div>
                                <div class="hero__buttons">
                                    <a href="<?php echo $btn_primary_link; ?>"<?php echo $btn_data_primary; ?> class="hero__button hero__button--primary<?php echo $is_form_primary ? ' js-callback-open' : ''; ?>">
                                        <?php echo esc_html($atts['btn_primary_text']); ?>
                                    </a>
                                    <a href="<?php echo $btn_secondary_link; ?>"<?php echo $btn_data_secondary; ?> class="hero__button hero__button--secondary<?php echo $is_form_secondary ? ' js-callback-open' : ''; ?>">
                                        <?php echo esc_html($atts['btn_secondary_text']); ?>
                                    </a>
                                </div>
                                <div class="hero__socials">
                                    <?php echo $socials_html; ?>
                                </div>
                            </div>
                            <div class="hero__video" id="video">
                                <div class="hero__video-wrapper" id="<?php echo esc_attr($atts['video_id']); ?>">
                                    <div class="hero__play">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <?php if ($is_form_primary): ?>
    <div class="wm-popup" id="callback-popup-<?php echo esc_attr($atts['btn_primary_link']); ?>" style="display:none;">
        <div class="wm-popup__overlay"></div>
        <div class="wm-popup__content">
            <button class="wm-popup__close">&times;</button>
            <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($atts['btn_primary_link']) . '"]'); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($is_form_secondary): ?>
    <div class="wm-popup" id="callback-popup-<?php echo esc_attr($atts['btn_secondary_link']); ?>" style="display:none;">
        <div class="wm-popup__overlay"></div>
        <div class="wm-popup__content">
            <button class="wm-popup__close">&times;</button>
            <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($atts['btn_secondary_link']) . '"]'); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php
    return ob_get_clean();
}



add_action('vc_before_init', 'westmotors_about_block');
function westmotors_about_block() {
  vc_map(array(
    'name' => 'About Block',
    'base' => 'westmotors_about',
    'description' => 'Секция "О компании" для сайта',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок',
        'param_name' => 'title',
        'value' => 'Доставляем автомобили из США',
        'admin_label' => true
      ),
      array(
        'type' => 'textarea',
        'heading' => 'Основной текст',
        'param_name' => 'text',
        'value' => 'Экономим ваше время и деньги: WESTMOTORS занимается подбором, покупкой, доставкой и растаможкой автомобилей из США. Мы работаем напрямую с крупнейшими аукционами, гарантируя качество и безопасность сделки.'
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Особенности',
        'param_name' => 'features',
        'value' => urlencode(json_encode(array(
          array(
            'icon' => 'fas fa-car',
            'text' => 'Доставка автомобилей'
          ),
          array(
            'icon' => 'fas fa-handshake',
            'text' => 'Проверка и сопровождение сделки'
          ),
          array(
            'icon' => 'fas fa-shield-alt',
            'text' => 'Юридическая гарантия чистоты'
          )
        ))),
        'params' => array(
          array(
            'type' => 'iconpicker',
            'heading' => 'Иконка',
            'param_name' => 'icon',
            'settings' => array(
              'emptyIcon' => false,
              'type' => 'fontawesome',
              'iconsPerPage' => 200
            )
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Текст',
            'param_name' => 'text'
          )
        )
      ),
      array(
        'type' => 'attach_image',
        'heading' => 'Изображение',
        'param_name' => 'image',
        'description' => 'Выберите изображение для секции'
      )
    )
  ));
}

add_shortcode('westmotors_about', 'westmotors_about_render');
function westmotors_about_render($atts) {
  $atts = shortcode_atts(array(
    'title' => 'Доставляем автомобили из США',
    'text' => 'Экономим ваше время и деньги: WESTMOTORS занимается подбором, покупкой, доставкой и растаможкой автомобилей из США. Мы работаем напрямую с крупнейшими аукционами, гарантируя качество и безопасность сделки.',
    'features' => '',
    'image' => ''
  ), $atts);

  $features = vc_param_group_parse_atts($atts['features']);
  $features_html = '';
  if (is_array($features)) {
    foreach ($features as $feature) {
      $features_html .= '
      <div class="about__feature">
        <i class="' . esc_attr($feature['icon']) . '"></i>
        <span>' . esc_html($feature['text']) . '</span>
      </div>';
    }
  }

  $image_url = '';
  if (!empty($atts['image'])) {
    $image_url = wp_get_attachment_image_url($atts['image'], 'full');
  }

  ob_start(); ?>
  <div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <section class="about" id="about">
            <div class="about__container">
              <div class="about__content">
                <h2 class="about__title"><?php echo esc_html($atts['title']); ?></h2>
                <p class="about__text"><?php echo esc_html($atts['text']); ?></p>
                <div class="about__features">
                  <?php echo $features_html; ?>
                </div>
              </div>
              <?php if ($image_url): ?>
              <div class="about__image">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($atts['title']); ?>" />
              </div>
              <?php endif; ?>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_action('vc_before_init', 'westmotors_services_block');
function westmotors_services_block() {
  vc_map(array(
    'name' => 'Services Block',
    'base' => 'westmotors_services',
    'description' => 'Секция услуг для сайта',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок секции',
        'param_name' => 'title',
        'value' => 'Наши услуги',
        'admin_label' => true
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Услуги',
        'param_name' => 'services',
        'value' => urlencode(json_encode(array(
          array(
            'icon' => 'fas fa-car-side',
            'title' => 'Подбор автомобиля',
            'text' => 'Поможем выбрать лучший вариант автомобиля из США с учётом ваших требований и бюджета.'
          ),
          array(
            'icon' => 'fas fa-ship',
            'title' => 'Доставка в Беларусь',
            'text' => 'Быстрая и безопасная доставка купленного авто до РБ, оформление всех документов.'
          ),
          array(
            'icon' => 'fas fa-file-invoice',
            'title' => 'Растаможка автомобиля',
            'text' => 'Полное юридическое сопровождение при растаможке авто на территории Беларуси.'
          )
        ))),
        'params' => array(
          array(
            'type' => 'iconpicker',
            'heading' => 'Иконка',
            'param_name' => 'icon',
            'settings' => array(
              'emptyIcon' => false,
              'type' => 'fontawesome',
              'iconsPerPage' => 200
            )
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Заголовок услуги',
            'param_name' => 'title'
          ),
          array(
            'type' => 'textarea',
            'heading' => 'Описание услуги',
            'param_name' => 'text'
          )
        )
      )
    )
  ));
}

add_shortcode('westmotors_services', 'westmotors_services_render');
function westmotors_services_render($atts) {
  $atts = shortcode_atts(array(
    'title' => 'Наши услуги',
    'services' => ''
  ), $atts);

  $services = vc_param_group_parse_atts($atts['services']);
  $services_html = '';
  if (is_array($services)) {
    foreach ($services as $service) {
      $services_html .= '
      <div class="services__item">
        <i class="' . esc_attr($service['icon']) . ' services__icon"></i>
        <h3 class="services__item-title">' . esc_html($service['title']) . '</h3>
        <p class="services__item-text">' . esc_html($service['text']) . '</p>
      </div>';
    }
  }

  ob_start(); ?>
  <div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <section class="services" id="services">
            <div class="services__container">
              <h2 class="services__title"><?php echo esc_html($atts['title']); ?></h2>
              <div class="services__list">
                <?php echo $services_html; ?>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_action('vc_before_init', 'westmotors_why_us_block');
function westmotors_why_us_block() {
  vc_map(array(
    'name' => 'Why Us Block',
    'base' => 'westmotors_why_us',
    'description' => 'Секция "Почему мы" для сайта',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок секции',
        'param_name' => 'title',
        'value' => 'Почему мы?',
        'admin_label' => true
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Преимущества',
        'param_name' => 'advantages',
        'value' => urlencode(json_encode(array(
          array(
            'icon' => 'fas fa-shield-alt',
            'title' => 'Безопасность сделки',
            'text' => 'Мы гарантируем, что все сделки проходят с полной юридической чистотой.'
          ),
          array(
            'icon' => 'fas fa-car-alt',
            'title' => 'Качество автомобилей',
            'text' => 'Мы работаем только с проверенными аукционами, чтобы ваши автомобили были на высшем уровне.'
          ),
          array(
            'icon' => 'fas fa-users',
            'title' => 'Клиентский сервис',
            'text' => 'Наши специалисты всегда готовы проконсультировать вас и ответить на любые вопросы.'
          )
        ))),
        'params' => array(
          array(
            'type' => 'iconpicker',
            'heading' => 'Иконка',
            'param_name' => 'icon',
            'settings' => array(
              'emptyIcon' => false,
              'type' => 'fontawesome',
              'iconsPerPage' => 200
            )
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Заголовок',
            'param_name' => 'title'
          ),
          array(
            'type' => 'textarea',
            'heading' => 'Текст',
            'param_name' => 'text'
          )
        )
      )
    )
  ));
}

add_shortcode('westmotors_why_us', 'westmotors_why_us_render');
function westmotors_why_us_render($atts) {
  $atts = shortcode_atts(array(
    'title' => 'Почему мы?',
    'advantages' => ''
  ), $atts);

  $advantages = vc_param_group_parse_atts($atts['advantages']);
  $advantages_html = '';
  if (is_array($advantages)) {
    foreach ($advantages as $advantage) {
      $advantages_html .= '
      <div class="why-us__item">
        <i class="' . esc_attr($advantage['icon']) . ' why-us__icon"></i>
        <h3 class="why-us__item-title">' . esc_html($advantage['title']) . '</h3>
        <p class="why-us__item-text">' . esc_html($advantage['text']) . '</p>
      </div>';
    }
  }

  ob_start(); ?>
  <div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <section class="why-us" id="why-us">
            <div class="why-us__container">
              <h2 class="why-us__title"><?php echo esc_html($atts['title']); ?></h2>
              <div class="why-us__list">
                <?php echo $advantages_html; ?>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_action('vc_before_init', 'westmotors_contacts_block');
function westmotors_contacts_block() {
  vc_map(array(
    'name' => 'Contacts Block',
    'base' => 'westmotors_contacts',
    'description' => 'Секция контактов для сайта',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок секции',
        'param_name' => 'title',
        'value' => 'Связаться с нами',
        'admin_label' => true
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Контактная информация',
        'param_name' => 'contacts',
        'value' => urlencode(json_encode(array(
          array(
            'icon' => 'fas fa-phone-alt',
            'text' => '+375 (29) 170-70-01'
          ),
          array(
            'icon' => 'fas fa-envelope',
            'text' => 'info@westmotors.by'
          ),
          array(
            'icon' => 'fas fa-map-marker-alt',
            'text' => 'Минск, ул. Примерная, 5'
          )
        ))),
        'params' => array(
          array(
            'type' => 'iconpicker',
            'heading' => 'Иконка',
            'param_name' => 'icon',
            'settings' => array(
              'emptyIcon' => false,
              'type' => 'fontawesome',
              'iconsPerPage' => 200
            )
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Текст',
            'param_name' => 'text'
          )
        )
      ),
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок формы',
        'param_name' => 'form_title',
        'value' => 'Отправьте сообщение'
      ),
      array(
        'type' => 'textfield',
        'heading' => 'Атрибут action формы',
        'param_name' => 'form_action',
        'value' => '#'
      )
    )
  ));
}

add_shortcode('westmotors_contacts', 'westmotors_contacts_render');
function westmotors_contacts_render($atts) {
  $atts = shortcode_atts(array(
    'title' => 'Связаться с нами',
    'contacts' => '',
    'form_title' => 'Отправьте сообщение',
    'form_action' => '#'
  ), $atts);

  $contacts = vc_param_group_parse_atts($atts['contacts']);
  $contacts_html = '';
  if (is_array($contacts)) {
    foreach ($contacts as $contact) {
      $contacts_html .= '
      <div class="contacts__item">
        <i class="' . esc_attr($contact['icon']) . ' contacts__icon"></i>
        <p class="contacts__text">' . esc_html($contact['text']) . '</p>
      </div>';
    }
  }

  ob_start(); ?>
  <div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <section class="contacts" id="contacts">
            <div class="contacts__container">
              <h2 class="contacts__title"><?php echo esc_html($atts['title']); ?></h2>
              <div class="contacts__info">
                <?php echo $contacts_html; ?>
              </div>
              <div class="contacts__form">
                <h3 class="contacts__form-title"><?php echo esc_html($atts['form_title']); ?></h3>
                <form action="<?php echo esc_attr($atts['form_action']); ?>" method="post" class="contacts__message-form">
                  <input
                    type="text"
                    name="name"
                    placeholder="Ваше имя"
                    class="contacts__input"
                    required
                  />
                  <input
                    type="email"
                    name="email"
                    placeholder="Ваш email"
                    class="contacts__input"
                    required
                  />
                  <textarea
                    name="message"
                    placeholder="Ваше сообщение"
                    class="contacts__textarea"
                    required
                  ></textarea>
                  <button type="submit" class="contacts__submit">Отправить</button>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_action('vc_before_init', 'westmotors_faq_block');
function westmotors_faq_block() {
  vc_map(array(
    'name' => 'FAQ Block',
    'base' => 'westmotors_faq',
    'description' => 'Секция часто задаваемых вопросов',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок секции',
        'param_name' => 'title',
        'value' => 'Часто задаваемые вопросы',
        'admin_label' => true
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Вопросы и ответы',
        'param_name' => 'faq_items',
        'value' => urlencode(json_encode(array(
          array(
            'question' => 'Какой процесс покупки автомобиля?',
            'answer' => 'Мы подбираем авто, оцениваем его состояние, делаем расчёты, а затем оформляем покупку и доставку.'
          ),
          array(
            'question' => 'Как происходит растаможка?',
            'answer' => 'Мы оформляем все документы для растаможки вашего авто в Беларуси, работаем с проверенными поставщиками.'
          ),
          array(
            'question' => 'Какие гарантии на авто?',
            'answer' => 'Мы даём гарантию на все автомобили, обеспечиваем юридическую чистоту сделки и техническое состояние.'
          )
        ))),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => 'Вопрос',
            'param_name' => 'question'
          ),
          array(
            'type' => 'textarea',
            'heading' => 'Ответ',
            'param_name' => 'answer'
          )
        )
      )
    )
  ));
}

add_shortcode('westmotors_faq', 'westmotors_faq_render');
function westmotors_faq_render($atts) {
  $atts = shortcode_atts(array(
    'title' => 'Часто задаваемые вопросы',
    'faq_items' => ''
  ), $atts);

  $faq_items = vc_param_group_parse_atts($atts['faq_items']);
  $faq_html = '';
  if (is_array($faq_items)) {
    foreach ($faq_items as $item) {
      $faq_html .= '
      <div class="faq__item">
        <div class="faq__question">
          <i class="fas fa-plus faq__icon"></i>
          <h3 class="faq__question-title">' . esc_html($item['question']) . '</h3>
        </div>
        <div class="faq__answer">
          <p>' . esc_html($item['answer']) . '</p>
        </div>
      </div>';
    }
  }

  ob_start(); ?>
  <div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <section class="faq" id="faq">
            <div class="faq__container">
              <h2 class="faq__title"><?php echo esc_html($atts['title']); ?></h2>
              <?php echo $faq_html; ?>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_action('vc_before_init', 'westmotors_contacts_page_block');
function westmotors_contacts_page_block() {
  vc_map(array(
    'name' => 'Contacts Page Block',
    'base' => 'westmotors_contacts_page',
    'description' => 'Секция контактов с офисами',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => 'Основной заголовок',
        'param_name' => 'title',
        'value' => 'Наши офисы',
        'admin_label' => true
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Основные контакты',
        'param_name' => 'main_contacts',
        'value' => urlencode(json_encode(array(
          array(
            'icon' => 'fas fa-phone-alt',
            'text' => '+375 (29) 170-70-01'
          ),
          array(
            'icon' => 'fas fa-envelope',
            'text' => 'info@westmotors.by'
          ),
          array(
            'icon' => 'fas fa-map-marker-alt',
            'text' => 'Минск, ул. Примерная, 5'
          )
        ))),
        'params' => array(
          array(
            'type' => 'iconpicker',
            'heading' => 'Иконка',
            'param_name' => 'icon',
            'settings' => array(
              'emptyIcon' => false,
              'type' => 'fontawesome',
              'iconsPerPage' => 200
            )
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Текст',
            'param_name' => 'text'
          )
        )
      ),
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок офисов',
        'param_name' => 'locations_title',
        'value' => 'Наши офисы в других городах'
      ),
      array(
        'type' => 'param_group',
        'heading' => 'Офисы в городах',
        'param_name' => 'locations',
        'value' => urlencode(json_encode(array(
          array(
            'city' => 'Гродно',
            'image_id' => '',
            'phone' => '+375 (29) 328-40-88',
            'address' => 'г. Гродно, ул. Примерная, 10'
          ),
          array(
            'city' => 'Минск (филиал)',
            'image_id' => '',
            'phone' => '+375 (29) 170-70-47',
            'address' => 'г. Минск, ул. Примерная, 5'
          )
        ))),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => 'Город',
            'param_name' => 'city'
          ),
          array(
            'type' => 'attach_image',
            'heading' => 'Изображение офиса',
            'param_name' => 'image_id'
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Телефон',
            'param_name' => 'phone'
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Адрес',
            'param_name' => 'address'
          )
        )
      ),
      array(
        'type' => 'textfield',
        'heading' => 'Заголовок карты',
        'param_name' => 'map_title',
        'value' => 'Офисы на карте'
      )
    )
  ));
}

add_shortcode('westmotors_contacts_page', 'westmotors_contacts_page_render');
function westmotors_contacts_page_render($atts) {
  $atts = shortcode_atts(array(
    'title' => 'Наши офисы',
    'main_contacts' => '',
    'locations_title' => 'Наши офисы в других городах',
    'locations' => '',
    'map_title' => 'Офисы на карте'
  ), $atts);

  $main_contacts = vc_param_group_parse_atts($atts['main_contacts']);
  $main_contacts_html = '';
  if (is_array($main_contacts)) {
    foreach ($main_contacts as $contact) {
      $main_contacts_html .= '
      <div class="contacts__item">
        <i class="' . esc_attr($contact['icon']) . ' contacts__icon"></i>
        <p class="contacts__text">' . esc_html($contact['text']) . '</p>
      </div>';
    }
  }

  $locations = vc_param_group_parse_atts($atts['locations']);
  $locations_html = '';
  if (is_array($locations)) {
    foreach ($locations as $location) {
      $image_url = !empty($location['image_id']) ? wp_get_attachment_image_url($location['image_id'], 'full') : '';
      $locations_html .= '
      <div class="contacts__location">
        <h4>' . esc_html($location['city']) . '</h4>
        ' . ($image_url ? '<div class="contacts__location-image"><img src="' . esc_url($image_url) . '" alt="Офис в ' . esc_attr($location['city']) . '" /></div>' : '') . '
        <p class="contacts__location-info">' . esc_html($location['phone']) . '</p>
        <p class="contacts__location-info">' . esc_html($location['address']) . '</p>
      </div>';
    }
  }

  ob_start(); ?>
  <div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <section class="contacts" id="contacts">
            <div class="contacts__container">
              <h2 class="contacts__title"><?php echo esc_html($atts['title']); ?></h2>
              <div class="contacts__info">
                <?php echo $main_contacts_html; ?>
              </div>
              <div class="contacts__locations">
                <h3 class="contacts__locations-title"><?php echo esc_html($atts['locations_title']); ?></h3>
                <?php echo $locations_html; ?>
              </div>
              <div class="contacts__map">
                <h3 class="contacts__map-title"><?php echo esc_html($atts['map_title']); ?></h3>
                <div id="map"></div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_action('vc_before_init', 'westmotors_services_page_block');
function westmotors_services_page_block() {
  vc_map(array(
    'name' => 'Single Service Page Block',
    'base' => 'westmotors_services_page',
    'description' => 'Секция услуги для страницы',
    'category' => 'WestMotors',
    'params' => array(
      array(
        'type' => 'param_group',
        'heading' => 'Услуги',
        'param_name' => 'services',
        'value' => urlencode(json_encode(array(
          array(
            'section_id' => 'auto-import',
            'icon' => 'fas fa-search',
            'title' => 'Импорт автомобилей из США',
            'text' => 'Мы подбираем автомобили с крупнейших аукционов США, гарантируя их техническое состояние. Осуществляем полный цикл оформления и доставку.'
          ),
          array(
            'section_id' => 'customs-assistance',
            'icon' => 'fas fa-file-invoice',
            'title' => 'Растаможка автомобиля',
            'text' => 'Мы предоставляем полное юридическое сопровождение при растаможке автомобиля, включая помощь в сборе и подготовке всех необходимых документов.'
          ),
          array(
            'section_id' => 'avto-delivery',
            'icon' => 'fas fa-truck',
            'title' => 'Доставка автомобилей',
            'text' => 'Обеспечиваем безопасную и быструю доставку автомобилей с аукционов США в Беларусь. Мы работаем с проверенными логистическими компаниями для вашей безопасности.'
          ),
          array(
            'section_id' => 'wholesale-customers',
            'icon' => 'fas fa-users',
            'title' => 'Для оптовых клиентов',
            'text' => 'Мы предоставляем выгодные условия для оптовых закупок автомобилей. Гибкая система скидок и индивидуальный подход каждому клиенту.'
          ),
          array(
            'section_id' => 'cars-for-legal-entities',
            'icon' => 'fas fa-building',
            'title' => 'Авто для юридических лиц',
            'text' => 'Предлагаем широкий выбор автомобилей для бизнеса. Индивидуальный подход и выгодные условия покупки для юридических лиц.'
          )
        ))),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => 'ID секции',
            'param_name' => 'section_id',
            'description' => 'Уникальный ID для якорной ссылки'
          ),
          array(
            'type' => 'iconpicker',
            'heading' => 'Иконка',
            'param_name' => 'icon',
            'settings' => array(
              'emptyIcon' => false,
              'type' => 'fontawesome',
              'iconsPerPage' => 200
            )
          ),
          array(
            'type' => 'textfield',
            'heading' => 'Заголовок',
            'param_name' => 'title'
          ),
          array(
            'type' => 'textarea',
            'heading' => 'Описание',
            'param_name' => 'text'
          )
        )
      ),
      array(
        'type' => 'colorpicker',
        'heading' => 'Цвет фона по умолчанию',
        'param_name' => 'bg_color',
        'description' => 'Базовый цвет фона для всех блоков'
      )
    )
  ));
}

add_shortcode('westmotors_services_page', 'westmotors_services_page_render');
function westmotors_services_page_render($atts) {
  $atts = shortcode_atts(array(
    'services' => '',
    'bg_color' => ''
  ), $atts);

  $services = vc_param_group_parse_atts($atts['services']);
  $services_html = '';
  
  if (is_array($services)) {
    foreach ($services as $service) {
      $style = !empty($atts['bg_color']) ? 'style="background-color: ' . esc_attr($atts['bg_color']) . '"' : '';
      
      $services_html .= '
      <section class="services__item" id="' . esc_attr($service['section_id']) . '" ' . $style . '>
        <i class="' . esc_attr($service['icon']) . ' services__icon"></i>
        <h3 class="services__item-title">' . esc_html($service['title']) . '</h3>
        <p class="services__item-text">' . esc_html($service['text']) . '</p>
      </section>';
    }
  }

  ob_start(); ?>
  <div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <div class="services-page-container">
            <?php echo $services_html; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_action('vc_before_init', 'westmotors_callback_block');
function westmotors_callback_block() {
    vc_map(array(
        'name' => 'Callback Form',
        'base' => 'westmotors_callback',
        'description' => 'Форма обратного звонка',
        'category' => 'WestMotors',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => 'Заголовок формы',
                'param_name' => 'title',
                'value' => 'Заказать обратный звонок',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => 'Контактная форма 7 ID',
                'param_name' => 'cf7_id',
                'description' => 'Введите ID формы Contact Form 7 (например: 123 или abc456)'
            ),
            array(
                'type' => 'textfield',
                'heading' => 'Текст кнопки',
                'param_name' => 'btn_text',
                'value' => 'Отправить'
            )
        )
    ));
}

add_shortcode('westmotors_callback', 'westmotors_callback_render');
function westmotors_callback_render($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Отправьте сообщение',
        'cf7_id' => '',
        'btn_text' => 'Отправить'
    ), $atts);

    ob_start(); ?>
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">
                    <section class="callback-form">
                        <div class="callback-form__container">
                            <h3 class="callback-form__title"><?php echo esc_html($atts['title']); ?></h3>

                            <?php if (!empty($atts['cf7_id'])): ?>
                                <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($atts['cf7_id']) . '" title="' . esc_attr($atts['title']) . '"]'); ?>
                            <?php else: ?>
                                <form class="callback-form__form">
                                    <input type="text" name="name" placeholder="Ваше имя" required>
                                    <input type="tel" name="phone" placeholder="Ваш телефон" required>
                                    <button type="submit" class="callback-form__submit"><?php echo esc_html($atts['btn_text']); ?></button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}