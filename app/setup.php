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



add_filter(
    'nav_menu_link_attributes',
    function ($attributes, $menuItem, $args) {
        $classes = is_array($menuItem->classes)
            ? $menuItem->classes
            : [];

        if (in_array('opens-services-dialog', $classes, true)) {
            $attributes['href'] = '#services-dialog';
            $attributes['data-services-dialog-open'] = '';
            $attributes['aria-haspopup'] = 'dialog';
            $attributes['aria-controls'] = 'services-dialog';
        }

        return $attributes;
    },
    10,
    3
);

function im_sons_default_primary_menu(array $args = []): string
{
    $menuClass = $args['menu_class']
        ?? 'primary-menu flex items-center gap-10';

    $items = [
        [
            'label' => 'Home',
            'url' => home_url('/'),
        ],
        [
            'label' => 'About',
            'url' => home_url('/about/'),
        ],
        [
            'label' => 'Services',
            'url' => '#services-dialog',
            'dialog' => true,
        ],
        [
            'label' => 'Gallery',
            'url' => home_url('/gallery/'),
        ],
        [
            'label' => 'Contact',
            'url' => home_url('/contact/'),
        ],
    ];

    $html = '<ul class="' . esc_attr($menuClass) . '">';

    foreach ($items as $item) {
        $isDialogTrigger = $item['dialog'] ?? false;

        $html .= '<li class="menu-item'
            . ($isDialogTrigger ? ' opens-services-dialog' : '')
            . '">';

        $html .= '<a'
            . ' href="' . esc_url($item['url']) . '"'
            . ' class="primary-menu-link"';

        if ($isDialogTrigger) {
            $html .= ' data-services-dialog-open'
                . ' aria-haspopup="dialog"'
                . ' aria-controls="services-dialog"';
        }

        $html .= '>';

        $html .= esc_html($item['label']);
        $html .= '</a>';
        $html .= '</li>';
    }

    $html .= '</ul>';

    return $html;
}
