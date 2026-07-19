<?php

if (! function_exists('im_sons_header_footer_setting')) {
    function im_sons_header_footer_setting(string $field, mixed $default = null): mixed
    {
        if (! function_exists('get_field')) {
            return $default;
        }

        $value = get_field($field, 'header_footer_settings');

        return ($value === null || $value === '') ? $default : $value;
    }
}

if (! function_exists('im_sons_normalize_link_value')) {
    function im_sons_normalize_link_value(mixed $value, string $defaultUrl = '#'): string
    {
        if (is_array($value)) {
            return $value['url'] ?? $defaultUrl;
        }

        return $value ?: $defaultUrl;
    }
}

if (! function_exists('im_sons_header_footer_primary_navigation_items')) {
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
}

if (! function_exists('im_sons_header_footer_services')) {
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
}

if (! function_exists('im_sons_header_footer_social_links')) {
    function im_sons_header_footer_social_links(): array
    {
        return [
            'facebook' => im_sons_header_footer_setting('footer_facebook_url', '#'),
            'tiktok' => im_sons_header_footer_setting('footer_tiktok_url', '#'),
            'google' => im_sons_header_footer_setting('footer_google_url', '#'),
        ];
    }
}
