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

if (! function_exists('im_sons_normalize_social_links')) {
    function im_sons_normalize_social_links(array $items): array
    {
        return array_values(array_filter(array_map(static function ($item) {
            $label = trim((string) ($item['label'] ?? ''));
            $iconClass = trim((string) ($item['icon_class'] ?? ''));
            $url = im_sons_normalize_link_value($item['url'] ?? null, '');

            if ($label === '' || $iconClass === '' || $url === '') {
                return null;
            }

            return [
                'label' => $label,
                'icon_class' => $iconClass,
                'url' => $url,
            ];
        }, $items)));
    }
}

if (! function_exists('im_sons_primary_navigation_dialog_context')) {
    function im_sons_primary_navigation_dialog_context(): array
    {
        if (! function_exists('wp_get_nav_menu_items') || ! function_exists('wp_get_nav_menu_locations')) {
            return [
                'id' => 'services-dialog',
                'parent_id' => 0,
                'title' => __('Services', 'im-sons'),
                'items' => [],
            ];
        }

        $locations = wp_get_nav_menu_locations();
        $menuId = (int) ($locations['primary_navigation'] ?? 0);

        if ($menuId === 0) {
            return [
                'id' => 'services-dialog',
                'parent_id' => 0,
                'title' => __('Services', 'im-sons'),
                'items' => [],
            ];
        }

        $menuItems = wp_get_nav_menu_items($menuId) ?: [];

        if ($menuItems === []) {
            return [
                'id' => 'services-dialog',
                'parent_id' => 0,
                'title' => __('Services', 'im-sons'),
                'items' => [],
            ];
        }

        $groupedItems = [];

        foreach ($menuItems as $menuItem) {
            $parentId = (int) ($menuItem->menu_item_parent ?? 0);
            $groupedItems[$parentId][] = $menuItem;
        }

        $selectedParent = null;

        foreach (($groupedItems[0] ?? []) as $menuItem) {
            $children = $groupedItems[(int) $menuItem->ID] ?? [];

            if ($children === []) {
                continue;
            }

            if (preg_match('/service/i', (string) ($menuItem->title ?? ''))) {
                $selectedParent = $menuItem;
                break;
            }

            if ($selectedParent === null) {
                $selectedParent = $menuItem;
            }
        }

        if (! $selectedParent) {
            return [
                'id' => 'services-dialog',
                'parent_id' => 0,
                'title' => __('Services', 'im-sons'),
                'items' => [],
            ];
        }

        $dialogItems = [];

        foreach (($groupedItems[(int) $selectedParent->ID] ?? []) as $menuItem) {
            $dialogItems[] = [
                'title' => html_entity_decode((string) ($menuItem->title ?? ''), ENT_QUOTES, get_bloginfo('charset') ?: 'UTF-8'),
                'url' => esc_url_raw((string) ($menuItem->url ?? '#')),
                'description' => im_sons_menu_item_description($menuItem),
            ];
        }

        return [
            'id' => 'services-dialog',
            'parent_id' => (int) $selectedParent->ID,
            'title' => html_entity_decode((string) ($selectedParent->title ?? __('Services', 'im-sons')), ENT_QUOTES, get_bloginfo('charset') ?: 'UTF-8'),
            'items' => $dialogItems,
        ];
    }
}

if (! function_exists('im_sons_menu_item_description')) {
    function im_sons_menu_item_description(object $menuItem): string
    {
        $objectId = (int) ($menuItem->object_id ?? 0);

        if ($objectId === 0 || ! function_exists('get_post')) {
            return '';
        }

        $post = get_post($objectId);

        if (! $post) {
            return '';
        }

        if ($post->post_type === 'service' && function_exists('get_field')) {
            $description = get_field('service_description', $objectId) ?: get_field('service_content', $objectId);

            if (is_string($description) && trim(wp_strip_all_tags($description)) !== '') {
                return wp_trim_words(wp_strip_all_tags($description), 22);
            }
        }

        $excerpt = get_the_excerpt($objectId);

        if (is_string($excerpt) && trim($excerpt) !== '') {
            return wp_trim_words(wp_strip_all_tags($excerpt), 22);
        }

        return '';
    }
}

if (! function_exists('im_sons_footer_social_links')) {
    function im_sons_footer_social_links(): array
    {
        $socialLinks = im_sons_header_footer_setting('footer_social_links', []);

        if (! is_array($socialLinks) || $socialLinks === []) {
            return [];
        }

        return im_sons_normalize_social_links($socialLinks);
    }
}

if (! function_exists('im_sons_footer_page_links')) {
    function im_sons_footer_page_links(): array
    {
        $footerLinks = im_sons_header_footer_setting('footer_links', []);

        if (! is_array($footerLinks) || $footerLinks === []) {
            return [];
        }

        return array_values(array_filter(array_map(static function ($item) {
            $name = trim((string) ($item['name'] ?? ''));

            if ($name === '') {
                return null;
            }

            return [
                'name' => $name,
                'url' => im_sons_normalize_link_value($item['link'] ?? null),
            ];
        }, $footerLinks)));
    }
}
