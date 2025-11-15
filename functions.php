<?php
/**
 * ConfiGamer Theme Functions
 *
 * @package ConfiGamer
 * @since 1.0.0
 */

// Evitar acesso direto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function configamer_theme_setup() {
    // Suporte a título do site
    add_theme_support('title-tag');

    // Suporte a logo customizado
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Suporte a imagens destacadas
    add_theme_support('post-thumbnails');

    // Suporte a HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Registrar menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'configamer'),
        'footer-content' => __('Menu Footer - Conteúdo', 'configamer'),
        'footer-tools' => __('Menu Footer - Ferramentas', 'configamer'),
        'footer-about' => __('Menu Footer - Sobre', 'configamer'),
    ));

    // Tamanhos de imagem
    add_image_size('configamer-featured', 1200, 600, true);
    add_image_size('configamer-card', 400, 250, true);
    add_image_size('configamer-thumbnail', 300, 200, true);
}
add_action('after_setup_theme', 'configamer_theme_setup');

/**
 * Registrar Sidebars
 */
function configamer_widgets_init() {
    // Sidebar principal
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'configamer'),
        'id'            => 'sidebar-main',
        'description'   => __('Widgets para sidebar das páginas internas', 'configamer'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Widget de anúncio - Home Top
    register_sidebar(array(
        'name'          => __('Anúncio - Home Topo', 'configamer'),
        'id'            => 'ad-home-top',
        'description'   => __('Banner 728x90 após hero da home', 'configamer'),
        'before_widget' => '<div class="ad-container ad-desktop-only"><div class="ad-label">Publicidade</div><div class="ad-wrapper ad-728x90">',
        'after_widget'  => '</div></div>',
    ));

    // Widget de anúncio - Home Sidebar
    register_sidebar(array(
        'name'          => __('Anúncio - Home Sidebar', 'configamer'),
        'id'            => 'ad-home-sidebar',
        'description'   => __('Banner 300x250 na sidebar da home', 'configamer'),
        'before_widget' => '<div class="ad-container ad-sidebar-sticky ad-desktop-only"><div class="ad-label">Publicidade</div><div class="ad-wrapper ad-300x250">',
        'after_widget'  => '</div></div>',
    ));

    // Widget de anúncio - Conteúdo Topo
    register_sidebar(array(
        'name'          => __('Anúncio - Conteúdo Topo', 'configamer'),
        'id'            => 'ad-content-top',
        'description'   => __('Banner 728x90 no início do conteúdo', 'configamer'),
        'before_widget' => '<div class="ad-container ad-desktop-only"><div class="ad-label">Publicidade</div><div class="ad-wrapper ad-728x90">',
        'after_widget'  => '</div></div>',
    ));

    // Widget de anúncio - Conteúdo Sidebar
    register_sidebar(array(
        'name'          => __('Anúncio - Sidebar Sticky', 'configamer'),
        'id'            => 'ad-sidebar-sticky',
        'description'   => __('Banner 300x250 sticky na sidebar', 'configamer'),
        'before_widget' => '<div class="ad-container ad-sidebar-sticky ad-desktop-only"><div class="ad-label">Publicidade</div><div class="ad-wrapper ad-300x250">',
        'after_widget'  => '</div></div>',
    ));

    // Widget de anúncio - Conteúdo Final
    register_sidebar(array(
        'name'          => __('Anúncio - Final do Conteúdo', 'configamer'),
        'id'            => 'ad-content-bottom',
        'description'   => __('Banner 300x250 no final do artigo', 'configamer'),
        'before_widget' => '<div class="ad-container ad-desktop-only"><div class="ad-label">Publicidade</div><div class="ad-wrapper ad-300x250">',
        'after_widget'  => '</div></div>',
    ));

    // Widget de anúncio - Mobile Topo
    register_sidebar(array(
        'name'          => __('Anúncio - Mobile Topo', 'configamer'),
        'id'            => 'ad-mobile-top',
        'description'   => __('Banner 320x100 mobile', 'configamer'),
        'before_widget' => '<div class="ad-container ad-mobile-only"><div class="ad-label">Publicidade</div><div class="ad-wrapper ad-320x100">',
        'after_widget'  => '</div></div>',
    ));

    // Widget de anúncio - Mobile Meio
    register_sidebar(array(
        'name'          => __('Anúncio - Mobile Meio', 'configamer'),
        'id'            => 'ad-mobile-middle',
        'description'   => __('Banner 320x50 mobile meio do conteúdo', 'configamer'),
        'before_widget' => '<div class="ad-container ad-mobile-only"><div class="ad-label">Publicidade</div><div class="ad-wrapper ad-320x50">',
        'after_widget'  => '</div></div>',
    ));
}
add_action('widgets_init', 'configamer_widgets_init');

/**
 * Enqueue Scripts e Styles
 */
function configamer_scripts() {
    // Style principal
    wp_enqueue_style('configamer-style', get_stylesheet_uri(), array(), '1.0.0');

    // Scripts (se necessário no futuro)
    // wp_enqueue_script('configamer-main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'configamer_scripts');

/**
 * Customizer - Opções do tema
 */
function configamer_customize_register($wp_customize) {
    // Seção de Redes Sociais
    $wp_customize->add_section('configamer_social', array(
        'title'    => __('Redes Sociais', 'configamer'),
        'priority' => 30,
    ));

    // Twitter
    $wp_customize->add_setting('configamer_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('configamer_twitter', array(
        'label'   => __('URL do Twitter/X', 'configamer'),
        'section' => 'configamer_social',
        'type'    => 'url',
    ));

    // YouTube
    $wp_customize->add_setting('configamer_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('configamer_youtube', array(
        'label'   => __('URL do YouTube', 'configamer'),
        'section' => 'configamer_social',
        'type'    => 'url',
    ));

    // Discord
    $wp_customize->add_setting('configamer_discord', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('configamer_discord', array(
        'label'   => __('URL do Discord', 'configamer'),
        'section' => 'configamer_social',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'configamer_customize_register');

/**
 * Função helper para exibir widgets de anúncio
 */
function configamer_show_ad($sidebar_id) {
    if (is_active_sidebar($sidebar_id)) {
        dynamic_sidebar($sidebar_id);
    }
}

/**
 * Adicionar classe ao body para identificar tipo de página
 */
function configamer_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'page-home';
    }

    if (is_single()) {
        $classes[] = 'page-single';
    }

    if (is_page()) {
        $classes[] = 'page-template';
    }

    return $classes;
}
add_filter('body_class', 'configamer_body_classes');

/**
 * Limitar excerpt
 */
function configamer_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'configamer_excerpt_length');

/**
 * Mudar "Leia mais"
 */
function configamer_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'configamer_excerpt_more');
