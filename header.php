<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo wp_get_document_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header class="header">
      <div class="header__container">
		  <?php if (has_custom_logo()) : ?>
    		<?php the_custom_logo(); ?>
			<?php else : ?>
    			<a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo">
        			<?php bloginfo('name'); ?>
    			</a>
			<?php endif; ?>
        <button
          class="header__burger"
          type="button"
          aria-label="Toggle navigation"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
        <nav class="header__nav">		
  			<?php
    			wp_nav_menu([
      			'theme_location' => 'primary',
      			'container' => false,
      			'items_wrap' => '%3$s',
      			'walker' => new Main_Theme_Menu(),
    			]);
  			?>


        </nav>
        <div class="header__contacts">
          <div class="header__phone-dropdown">
            <button class="header__phone-btn">+375 (29) 170-70-01</button>
            <ul class="header__phone-menu">
              <li>
                <a href="tel:+375291707001">Минск — +375 (29) 170-70-01</a>
              </li>
              <li>
                <a href="tel:+375293284088">Гродно — +375 (29) 328-40-88</a>
              </li>
              <li>
                <a href="tel:+375291707047"
                  >Минск (филиал) — +375 (29) 170-70-47</a
                >
              </li>
            </ul>
          </div>
          <button class="header__callback-btn">Обратный звонок</button>
        </div>
      </div>
      <div class="header__mobile-menu">
        <nav>
          <?php
  			wp_nav_menu([
    			'theme_location' => 'mobile',
    			'container' => false,
    			'items_wrap' => '%3$s',
    			'walker' => new Main_Theme_Menu(),
  			]);
			?>
          <hr />
          <a href="tel:+375291707001" class="header__nav-link"
            >📞 Минск — +375 (29) 170-70-01</a
          >
          <a href="tel:+375293284088" class="header__nav-link"
            >📞 Гродно — +375 (29) 328-40-88</a
          >
        </nav>
      </div>
    </header>
   