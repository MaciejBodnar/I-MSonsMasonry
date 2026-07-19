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

function im_sons_header_footer_setting(string $field, mixed $default = null): mixed
{
    if (! function_exists('get_field')) {
        return $default;
    }

    $value = get_field($field, 'header_footer_settings');

    return ($value === null || $value === '') ? $default : $value;
}

function im_sons_normalize_link_value(mixed $value, string $defaultUrl = '#'): string
{
    if (is_array($value)) {
        return $value['url'] ?? $defaultUrl;
    }

    return $value ?: $defaultUrl;
}

function im_sons_header_footer_primary_navigation_items(): array
{
    $items = im_sons_header_footer_setting('primary_navigation_items', []);

    if (! is_array($items) || $items === []) {
        return [
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
    }

    return array_values(array_filter(array_map(static function ($item) {
        $label = trim((string) ($item['label'] ?? ''));

        if ($label === '') {
            return null;
        }

        return [
            'label' => $label,
            'url' => im_sons_normalize_link_value($item['url'] ?? null),
            'dialog' => ! empty($item['dialog']),
        ];
    }, $items)));
}

function im_sons_header_footer_services(): array
{
    $services = im_sons_header_footer_setting('services', []);

    if (! is_array($services) || $services === []) {
        return [
            [
                'title' => 'House Extensions',
                'description' => 'Create more space for your family.',
                'url' => home_url('/services/house-extensions/'),
            ],
            [
                'title' => 'Roof Construction',
                'description' => 'New roofs, repairs and full replacements.',
                'url' => home_url('/services/roof-construction/'),
            ],
            [
                'title' => 'Summer Houses',
                'description' => 'Garden offices and additional living spaces.',
                'url' => home_url('/services/summer-houses/'),
            ],
            [
                'title' => 'Masonry & Bricklaying',
                'description' => 'Specialist brickwork and structural construction.',
                'url' => home_url('/services/masonry-bricklaying/'),
            ],
            [
                'title' => 'Loft Conversions',
                'description' => 'Transform unused roof space.',
                'url' => home_url('/services/loft-conversions/'),
            ],
            [
                'title' => 'House Refurbishments',
                'description' => 'Individual rooms and complete renovations.',
                'url' => home_url('/services/house-refurbishments/'),
            ],
        ];
    }

    return array_values(array_filter(array_map(static function ($service) {
        $title = trim((string) ($service['title'] ?? ''));

        if ($title === '') {
            return null;
        }

        return [
            'title' => $title,
            'description' => (string) ($service['description'] ?? ''),
            'url' => im_sons_normalize_link_value($service['url'] ?? null),
        ];
    }, $services)));
}

function im_sons_header_footer_social_links(): array
{
    return [
        'facebook' => im_sons_header_footer_setting('footer_facebook_url', '#'),
        'tiktok' => im_sons_header_footer_setting('footer_tiktok_url', '#'),
        'google' => im_sons_header_footer_setting('footer_google_url', '#'),
    ];
}

function im_sons_default_primary_menu(array $args = []): string
{
    $menuClass = $args['menu_class']
        ?? 'primary-menu flex items-center gap-10';

    $items = im_sons_header_footer_primary_navigation_items();

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
