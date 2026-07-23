<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = Vite::asset('resources/css/editor.css');

    $settings['styles'][] = [
        'css' => "@import url('{$style}')",
    ];

    return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_action('admin_head', function () {
    if (! get_current_screen()?->is_block_editor()) {
        return;
    }

    if (! Vite::isRunningHot()) {
        $dependencies = json_decode(Vite::content('editor.deps.json'));

        foreach ($dependencies as $dependency) {
            if (! wp_script_is($dependency)) {
                wp_enqueue_script($dependency);
            }
        }
    }
    echo Vite::withEntryPoints([
        'resources/js/editor.js',
    ])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);

/**
 * Disable on-demand block asset loading.
 *
 * @link https://core.trac.wordpress.org/ticket/61965
 */
add_filter('should_load_separate_core_block_assets', '__return_false');

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'im-sons'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Hide the default WordPress content editor on pages.
 */
add_action('init', function () {
    remove_post_type_support('page', 'editor');
});
/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});



/**
 * Add shared navigation link classes.
 */
add_filter(
    'nav_menu_link_attributes',
    function ($attributes, $menuItem, $args, $depth) {
        $attributes['class'] = trim(
            ($attributes['class'] ?? '') . ' primary-menu-link'
        );

        $itemClasses = is_array($menuItem->classes)
            ? $menuItem->classes
            : [];

        $hasChildren = in_array(
            'menu-item-has-children',
            $itemClasses,
            true
        );

        if ($depth === 0 && $hasChildren) {
            $attributes['href'] = '#';
            $attributes['role'] = 'button';
            $attributes['aria-expanded'] = 'false';
            $attributes['data-menu-parent'] = 'true';
        }

        return $attributes;
    },
    10,
    4
);

/**
 * Default navigation used until a menu is assigned in WordPress.
 */
function im_sons_default_primary_menu(array $args = []): string
{
    $menuClass = $args['menu_class']
        ?? 'primary-menu flex items-center gap-10';

    $services = [
        [
            'label' => 'House Extension',
            'url' => home_url('/services/house-extension/'),
        ],
        [
            'label' => 'Roof Construction',
            'url' => home_url('/services/roof-construction/'),
        ],
        [
            'label' => 'Summer House',
            'url' => home_url('/services/summer-house/'),
        ],
        [
            'label' => 'Masonry & Bricklaying',
            'url' => home_url('/services/masonry-bricklaying/'),
        ],
        [
            'label' => 'Loft Conversion',
            'url' => home_url('/services/loft-conversion/'),
        ],
        [
            'label' => 'House Refurbishment',
            'url' => home_url('/services/house-refurbishment/'),
        ],
    ];

    $html = '<ul class="' . esc_attr($menuClass) . '">';

    $html .= sprintf(
        '<li class="menu-item">
            <a class="primary-menu-link" href="%s">Home</a>
        </li>',
        esc_url(home_url('/'))
    );

    $html .= sprintf(
        '<li class="menu-item">
            <a class="primary-menu-link" href="%s">About</a>
        </li>',
        esc_url(home_url('/about/'))
    );

    $html .= '
    <li class="menu-item menu-item-has-children">
        <a
            href="#"
            class="primary-menu-link"
            role="button"
            aria-expanded="false"
            data-menu-parent="true"
        >
            Services
        </a>

        <ul class="sub-menu">
';

    foreach ($services as $service) {
        $html .= sprintf(
            '<li class="menu-item">
                <a href="%s">%s</a>
            </li>',
            esc_url($service['url']),
            esc_html($service['label'])
        );
    }

    $html .= '</ul></li>';

    $html .= sprintf(
        '<li class="menu-item">
            <a class="primary-menu-link" href="%s">Gallery</a>
        </li>',
        esc_url(home_url('/gallery/'))
    );

    $html .= sprintf(
        '<li class="menu-item">
            <a class="primary-menu-link" href="%s">Contact</a>
        </li>',
        esc_url(home_url('/contact/'))
    );

    $html .= '</ul>';

    return $html;
}
