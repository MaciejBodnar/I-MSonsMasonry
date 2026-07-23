<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ACFFieldProvider extends SageServiceProvider
{
    public function boot()
    {
        parent::boot();

        if (! function_exists('acf_add_local_field_group')) {
            return;
        }

        if (did_action('acf/init')) {
            $this->registerFields();

            return;
        }

        add_action('acf/init', [$this, 'registerFields']);
    }

    public function registerFields(): void
    {
        $this->registerHeaderFooterSettingsFields();
        $this->registerFrontPageFields();
        $this->registerAboutPageFields();
        $this->registerContactPageFields();
        $this->registerGalleryPageFields();
        $this->registerServiceFields();
        $this->registerPrivacyPolicyFields();
    }

    protected function registerHeaderFooterSettingsFields(): void
    {
        if (! function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => __('Header/Footer', 'im-sons'),
            'menu_title' => __('Header/Footer', 'im-sons'),
            'menu_slug' => 'im-sons-header-footer-settings',
            'post_id' => 'header_footer_settings',
            'capability' => 'edit_posts',
            'redirect' => false,
            'position' => 60,
        ]);

        acf_add_local_field_group([
            'key' => 'group_imsons_header_footer_settings',
            'title' => __('Header/Footer', 'im-sons'),
            'fields' => [
                [
                    'key' => 'field_imsons_header_footer_header_tab',
                    'label' => __('Header', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_header_brand_primary',
                    'label' => __('Brand Primary Line', 'im-sons'),
                    'name' => 'header_brand_primary',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_header_brand_secondary',
                    'label' => __('Brand Secondary Line', 'im-sons'),
                    'name' => 'header_brand_secondary',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_header_contact_label',
                    'label' => __('Contact Label', 'im-sons'),
                    'name' => 'header_contact_label',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_header_phone',
                    'label' => __('Phone', 'im-sons'),
                    'name' => 'header_phone',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_header_email',
                    'label' => __('Email', 'im-sons'),
                    'name' => 'header_email',
                    'type' => 'email',
                ],
                [
                    'key' => 'field_imsons_header_footer_footer_tab',
                    'label' => __('Footer', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_footer_brand_primary',
                    'label' => __('Brand Primary Line', 'im-sons'),
                    'name' => 'footer_brand_primary',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_footer_brand_secondary',
                    'label' => __('Brand Secondary Line', 'im-sons'),
                    'name' => 'footer_brand_secondary',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_footer_contact_label',
                    'label' => __('Contact Label', 'im-sons'),
                    'name' => 'footer_contact_label',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_footer_phone',
                    'label' => __('Phone', 'im-sons'),
                    'name' => 'footer_phone',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_footer_email',
                    'label' => __('Email', 'im-sons'),
                    'name' => 'footer_email',
                    'type' => 'email',
                ],
                [
                    'key' => 'field_imsons_footer_social_links',
                    'label' => __('Social Links', 'im-sons'),
                    'name' => 'footer_social_links',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Social Link', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_footer_social_label',
                            'label' => __('Label', 'im-sons'),
                            'name' => 'label',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_imsons_footer_social_icon_class',
                            'label' => __('Icon Class', 'im-sons'),
                            'name' => 'icon_class',
                            'type' => 'font-awesome',
                        ],
                        [
                            'key' => 'field_imsons_footer_social_url',
                            'label' => __('Link', 'im-sons'),
                            'name' => 'url',
                            'type' => 'link',
                            'return_format' => 'array',
                        ],
                    ],
                ],
                [
                    'key' => 'field_imsons_footer_links',
                    'label' => __('Footer Links', 'im-sons'),
                    'name' => 'footer_links',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Footer Link', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_footer_link_name',
                            'label' => __('Name', 'im-sons'),
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_imsons_footer_link_url',
                            'label' => __('Link', 'im-sons'),
                            'name' => 'link',
                            'type' => 'link',
                            'return_format' => 'array',
                        ],
                    ],
                ],
                [
                    'key' => 'field_imsons_footer_copyright_name',
                    'label' => __('Copyright Name', 'im-sons'),
                    'name' => 'footer_copyright_name',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_footer_credit_text',
                    'label' => __('Credit Text', 'im-sons'),
                    'name' => 'footer_credit_text',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_footer_credit_link_text',
                    'label' => __('Credit Link Text', 'im-sons'),
                    'name' => 'footer_credit_link_text',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_footer_credit_url',
                    'label' => __('Credit Link', 'im-sons'),
                    'name' => 'footer_credit_url',
                    'type' => 'url',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'im-sons-header-footer-settings',
                    ],
                ],
            ],
        ]);
    }

    protected function registerFrontPageFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_imsons_front_page',
            'title' => __('Front Page', 'im-sons'),
            'fields' => [
                [
                    'key' => 'field_imsons_front_page_hero_tab',
                    'label' => __('Hero', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_hero_eyebrow',
                    'label' => __('Eyebrow', 'im-sons'),
                    'name' => 'hero_eyebrow',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_hero_title_line_1',
                    'label' => __('Title Line 1', 'im-sons'),
                    'name' => 'hero_title_line_1',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_hero_title_line_2',
                    'label' => __('Title Line 2', 'im-sons'),
                    'name' => 'hero_title_line_2',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_hero_text',
                    'label' => __('Hero Text', 'im-sons'),
                    'name' => 'hero_text',
                    'type' => 'textarea',
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_imsons_hero_image',
                    'label' => __('Hero Image', 'im-sons'),
                    'name' => 'hero_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_imsons_front_page_services_tab',
                    'label' => __('Services', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_services_brand_primary',
                    'label' => __('Brand Primary Line', 'im-sons'),
                    'name' => 'services_brand_primary',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_services_brand_secondary',
                    'label' => __('Brand Secondary Line', 'im-sons'),
                    'name' => 'services_brand_secondary',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_services_mobile_title',
                    'label' => __('Mobile Title', 'im-sons'),
                    'name' => 'services_mobile_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_services_mobile_note',
                    'label' => __('Mobile Note', 'im-sons'),
                    'name' => 'services_mobile_note',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_services_vertical_label',
                    'label' => __('Vertical Label', 'im-sons'),
                    'name' => 'services_vertical_label',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_services_experience_note',
                    'label' => __('Experience Note', 'im-sons'),
                    'name' => 'services_experience_note',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_front_page_about_button_text',
                    'label' => __('About Button Text', 'im-sons'),
                    'name' => 'about_button_text',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_front_page_about_button_url',
                    'label' => __('About Button Link', 'im-sons'),
                    'name' => 'about_button_url',
                    'type' => 'link',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_imsons_front_page_services',
                    'label' => __('Service Cards', 'im-sons'),
                    'name' => 'services',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Service', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_service_title',
                            'label' => __('Title', 'im-sons'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_imsons_service_description',
                            'label' => __('Description', 'im-sons'),
                            'name' => 'description',
                            'type' => 'textarea',
                            'new_lines' => 'br',
                        ],
                        [
                            'key' => 'field_imsons_service_image',
                            'label' => __('Image', 'im-sons'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_imsons_service_url',
                            'label' => __('Link', 'im-sons'),
                            'name' => 'url',
                            'type' => 'link',
                            'return_format' => 'array',
                        ],
                    ],
                ],
                [
                    'key' => 'field_imsons_front_page_about_tab',
                    'label' => __('About', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_about_title',
                    'label' => __('About Title', 'im-sons'),
                    'name' => 'about_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_about_text',
                    'label' => __('About Text', 'im-sons'),
                    'name' => 'about_text',
                    'type' => 'textarea',
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_imsons_about_image',
                    'label' => __('About Image', 'im-sons'),
                    'name' => 'about_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_imsons_about_link',
                    'label' => __('About Link', 'im-sons'),
                    'name' => 'about_link',
                    'type' => 'link',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_imsons_front_page_reviews_tab',
                    'label' => __('Reviews', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_reviews_background',
                    'label' => __('Background Image', 'im-sons'),
                    'name' => 'reviews_background',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_imsons_reviews_intro',
                    'label' => __('Intro Text', 'im-sons'),
                    'name' => 'reviews_intro',
                    'type' => 'textarea',
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_imsons_front_page_reviews',
                    'label' => __('Review Cards', 'im-sons'),
                    'name' => 'reviews',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Review', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_review_text',
                            'label' => __('Review', 'im-sons'),
                            'name' => 'review',
                            'type' => 'textarea',
                            'new_lines' => 'br',
                        ],
                        [
                            'key' => 'field_imsons_review_name',
                            'label' => __('Name', 'im-sons'),
                            'name' => 'name',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'key' => 'field_imsons_front_page_gallery_tab',
                    'label' => __('Gallery', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_gallery_title',
                    'label' => __('Gallery Title', 'im-sons'),
                    'name' => 'gallery_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_gallery_link',
                    'label' => __('Gallery Link', 'im-sons'),
                    'name' => 'gallery_link',
                    'type' => 'link',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_imsons_front_page_gallery_button_text',
                    'label' => __('Gallery Button Text', 'im-sons'),
                    'name' => 'gallery_button_text',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_front_page_gallery_button_url',
                    'label' => __('Gallery Button Link', 'im-sons'),
                    'name' => 'gallery_button_url',
                    'type' => 'link',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_imsons_front_page_gallery_images',
                    'label' => __('Gallery Images', 'im-sons'),
                    'name' => 'gallery_images',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Gallery Image', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_gallery_image',
                            'label' => __('Image', 'im-sons'),
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_imsons_gallery_image_title',
                            'label' => __('Title', 'im-sons'),
                            'name' => 'title',
                            'type' => 'text',
                        ],
                    ],
                ],
                [
                    'key' => 'field_imsons_front_page_faq_tab',
                    'label' => __('FAQ', 'im-sons'),
                    'type' => 'tab',
                ],
                [
                    'key' => 'field_imsons_faq_title',
                    'label' => __('FAQ Title', 'im-sons'),
                    'name' => 'faq_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_faq_intro',
                    'label' => __('FAQ Intro', 'im-sons'),
                    'name' => 'faq_intro',
                    'type' => 'textarea',
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_imsons_front_page_reviews_title',
                    'label' => __('Reviews Title', 'im-sons'),
                    'name' => 'reviews_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_front_page_faq_items',
                    'label' => __('FAQ Items', 'im-sons'),
                    'name' => 'faq_items',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add FAQ Item', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_faq_question',
                            'label' => __('Question', 'im-sons'),
                            'name' => 'question',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_imsons_faq_answer',
                            'label' => __('Answer', 'im-sons'),
                            'name' => 'answer',
                            'type' => 'textarea',
                            'new_lines' => 'br',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ],
                ],
            ],
        ]);
    }

    protected function registerAboutPageFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_imsons_about_page',
            'title' => __('About Page', 'im-sons'),
            'fields' => [
                [
                    'key' => 'field_imsons_about_page_about_title',
                    'label' => __('About Title', 'im-sons'),
                    'name' => 'about_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_about_content',
                    'label' => __('About Content', 'im-sons'),
                    'name' => 'about_content',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                ],
                [
                    'key' => 'field_imsons_about_page_about_image',
                    'label' => __('About Image', 'im-sons'),
                    'name' => 'about_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_imsons_about_page_reviews_title',
                    'label' => __('Reviews Title', 'im-sons'),
                    'name' => 'reviews_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_about_page_reviews',
                    'label' => __('Reviews', 'im-sons'),
                    'name' => 'reviews',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Review', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_about_page_review_text',
                            'label' => __('Review', 'im-sons'),
                            'name' => 'review',
                            'type' => 'textarea',
                            'new_lines' => 'br',
                        ],
                        [
                            'key' => 'field_imsons_about_page_review_name',
                            'label' => __('Name', 'im-sons'),
                            'name' => 'name',
                            'type' => 'text',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-about.blade.php',
                    ],
                ],
            ],
        ]);
    }

    protected function registerContactPageFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_imsons_contact_page',
            'title' => __('Contact Page', 'im-sons'),
            'fields' => [
                [
                    'key' => 'field_imsons_contact_title',
                    'label' => __('Contact Title', 'im-sons'),
                    'name' => 'contact_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_contact_phone',
                    'label' => __('Phone', 'im-sons'),
                    'name' => 'contact_phone',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_contact_email',
                    'label' => __('Email', 'im-sons'),
                    'name' => 'contact_email',
                    'type' => 'email',
                ],
                [
                    'key' => 'field_imsons_contact_address',
                    'label' => __('Address', 'im-sons'),
                    'name' => 'contact_address',
                    'type' => 'textarea',
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_imsons_contact_postcode',
                    'label' => __('Postcode', 'im-sons'),
                    'name' => 'contact_postcode',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_contact_social_links',
                    'label' => __('Social Links', 'im-sons'),
                    'name' => 'contact_social_links',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Social Link', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_contact_social_label',
                            'label' => __('Label', 'im-sons'),
                            'name' => 'label',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_imsons_contact_social_icon_class',
                            'label' => __('Icon Class', 'im-sons'),
                            'name' => 'icon_class',
                            'type' => 'font-awesome',
                        ],
                        [
                            'key' => 'field_imsons_contact_social_url',
                            'label' => __('Link', 'im-sons'),
                            'name' => 'url',
                            'type' => 'link',
                            'return_format' => 'array',
                        ],
                    ],
                ],
                [
                    'key' => 'field_imsons_contact_form_shortcode',
                    'label' => __('Form Shortcode', 'im-sons'),
                    'name' => 'contact_form_shortcode',
                    'type' => 'text',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-contact.blade.php',
                    ],
                ],
            ],
        ]);
    }

    protected function registerGalleryPageFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_imsons_gallery_page',
            'title' => __('Gallery Page', 'im-sons'),
            'fields' => [
                [
                    'key' => 'field_imsons_gallery_page_title',
                    'label' => __('Gallery Title', 'im-sons'),
                    'name' => 'gallery_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_gallery_albums',
                    'label' => __('Albums', 'im-sons'),
                    'name' => 'gallery_albums',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add Album', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_gallery_album_title',
                            'label' => __('Album Title', 'im-sons'),
                            'name' => 'album_title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_imsons_gallery_album_cover_image',
                            'label' => __('Cover Image', 'im-sons'),
                            'name' => 'cover_image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                        ],
                        [
                            'key' => 'field_imsons_gallery_album_images',
                            'label' => __('Images', 'im-sons'),
                            'name' => 'images',
                            'type' => 'repeater',
                            'layout' => 'row',
                            'button_label' => __('Add Image', 'im-sons'),
                            'sub_fields' => [
                                [
                                    'key' => 'field_imsons_gallery_album_image',
                                    'label' => __('Image', 'im-sons'),
                                    'name' => 'image',
                                    'type' => 'image',
                                    'return_format' => 'array',
                                    'preview_size' => 'medium',
                                    'library' => 'all',
                                ],
                                [
                                    'key' => 'field_imsons_gallery_album_image_alt',
                                    'label' => __('Alt Text', 'im-sons'),
                                    'name' => 'alt',
                                    'type' => 'text',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-gallery.blade.php',
                    ],
                ],
            ],
        ]);
    }

    protected function registerServiceFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_imsons_service_page',
            'title' => __('Service Page', 'im-sons'),
            'fields' => [
                [
                    'key' => 'field_imsons_single_service_title',
                    'label' => __('Service Title', 'im-sons'),
                    'name' => 'service_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_single_service_description',
                    'label' => __('Service Description', 'im-sons'),
                    'name' => 'service_description',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                ],
                [
                    'key' => 'field_imsons_single_service_image',
                    'label' => __('Service Image', 'im-sons'),
                    'name' => 'service_image',
                    'type' => 'image',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'key' => 'field_imsons_single_service_gallery_button_text',
                    'label' => __('Gallery Button Text', 'im-sons'),
                    'name' => 'gallery_button_text',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_single_service_gallery_link',
                    'label' => __('Gallery Link', 'im-sons'),
                    'name' => 'gallery_link',
                    'type' => 'link',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_imsons_single_service_faq_title',
                    'label' => __('FAQ Title', 'im-sons'),
                    'name' => 'faq_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_single_service_faq_intro',
                    'label' => __('FAQ Intro', 'im-sons'),
                    'name' => 'faq_intro',
                    'type' => 'textarea',
                    'new_lines' => 'br',
                ],
                [
                    'key' => 'field_imsons_single_service_faq_items',
                    'label' => __('FAQ Items', 'im-sons'),
                    'name' => 'faq_items',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => __('Add FAQ Item', 'im-sons'),
                    'sub_fields' => [
                        [
                            'key' => 'field_imsons_single_service_faq_question',
                            'label' => __('Question', 'im-sons'),
                            'name' => 'question',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_imsons_single_service_faq_answer',
                            'label' => __('Answer', 'im-sons'),
                            'name' => 'answer',
                            'type' => 'textarea',
                            'new_lines' => 'br',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'single-service.blade.php',
                    ],
                ],
            ],
        ]);
    }

    protected function registerPrivacyPolicyFields(): void
    {
        acf_add_local_field_group([
            'key' => 'group_imsons_privacy_policy_page',
            'title' => __('Privacy Policy Page', 'im-sons'),
            'fields' => [
                [
                    'key' => 'field_imsons_privacy_title',
                    'label' => __('Privacy Title', 'im-sons'),
                    'name' => 'privacy_title',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_imsons_privacy_content',
                    'label' => __('Privacy Content', 'im-sons'),
                    'name' => 'privacy_content',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                ],
                [
                    'key' => 'field_imsons_privacy_last_updated',
                    'label' => __('Last Updated', 'im-sons'),
                    'name' => 'privacy_last_updated',
                    'type' => 'date_picker',
                    'display_format' => 'j F Y',
                    'return_format' => 'j F Y',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-privacy-policy.blade.php',
                    ],
                ],
            ],
        ]);
    }
}
