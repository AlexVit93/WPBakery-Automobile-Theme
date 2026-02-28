<?php
require_once get_template_directory() . '/assets/block/wpbakery/vc_shortcodes.php';
if (!function_exists('empty_clean_setup')) :
    function empty_clean_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
		add_theme_support('custom-logo', [
    		'height'      => 60,
    		'width'       => 200,
    		'flex-height' => true,
    		'flex-width'  => true,
		]);

        register_nav_menus([
            'primary' => __('Primary Menu', 'new-wp-theme'),
			'mobile' => __('Mobile Menu', 'new-wp-theme'),
        ]);
        add_theme_support('widgets');
        register_sidebar([
            'name'          => __('Sidebar', 'new-wp-theme'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here.', 'new-wp-theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
endif;
add_action('after_setup_theme', 'empty_clean_setup');

function empty_clean_scripts() {
	if (!is_admin()) {
		wp_enqueue_style('theme-style', get_stylesheet_uri());
		wp_enqueue_style('style-reset', get_template_directory_uri() . '/assets/css/reset.css');
		wp_enqueue_style('style-main', get_template_directory_uri() . '/assets/css/style.css');
		
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.4.1.min.js', array(), '3.4.1', true);
    	wp_enqueue_script('jquery');
		wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/ab844838c1.js', array('jquery'), '1.0', true);
		wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0', true);
		if (is_front_page()) {
            wp_enqueue_script('hero', get_template_directory_uri() . '/assets/js/hero.js', array('jquery'), '1.0', true);
        }
		if (is_page('contacts')) {
			wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
            wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), '1.7.1', true);
            wp_enqueue_script('map', get_template_directory_uri() . '/assets/js/mapcode.js', array('jquery'), '1.0', true);
        }
	}
}
add_action('wp_enqueue_scripts', 'empty_clean_scripts');

wp_enqueue_script(
    'popup-contact', 
    get_template_directory_uri() . '/assets/js/popups_contant.js', 
    array('jquery'), 
    filemtime(get_template_directory() . '/assets/js/popups_contant.js'), 
    true
);

class Main_Theme_Menu extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = 'header__nav-link'; 
        $output .= '<a href="' . esc_url($item->url) . '" class="' . $classes . '">' . esc_html($item->title) . '</a>';
    }
}


function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');
add_action('add_meta_boxes', 'add_hide_title_meta_box');
function add_hide_title_meta_box() {
    add_meta_box(
        'hide_title_meta_box',
        'Настройки отображения',
        'render_hide_title_meta_box',
        'page',
        'side',
        'default'
    );
}

function render_hide_title_meta_box($post) {
    $hide_title = get_post_meta($post->ID, 'hide_title', true);
    ?>
    <label>
        <input type="checkbox" name="hide_title" <?php checked($hide_title, 'on'); ?> />
        Скрыть заголовок на странице
    </label>
    <?php
}

add_action('save_post', 'save_hide_title_meta');
function save_hide_title_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    update_post_meta(
        $post_id,
        'hide_title',
        isset($_POST['hide_title']) ? 'on' : 'off'
    );
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script(
        'westmotors-popup',
        get_template_directory_uri() . '/assets/js/westmotors-popup.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/westmotors-popup.js'),
        true 
    );
});