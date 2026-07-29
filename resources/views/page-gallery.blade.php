{{--
  Template Name: Gallery
--}}

@extends('layouts.app')

@section('content')
    @php
        $galleryTitle = get_field('gallery_title') ?: 'Gallery';

        /*
        |--------------------------------------------------------------------------
        | Single ACF gallery field
        |--------------------------------------------------------------------------
        */

        $gallerySource = get_field('gallery_images') ?: [
            get_theme_file_uri('/resources/images/gallery-large.png'),
            get_theme_file_uri('/resources/images/gallery-1.png'),
            get_theme_file_uri('/resources/images/gallery2.png'),
            get_theme_file_uri('/resources/images/gallery3.png'),
            get_theme_file_uri('/resources/images/gallery4.png'),
            get_theme_file_uri('/resources/images/gallery5.png'),
        ];

        /*
        |--------------------------------------------------------------------------
        | Normalise gallery images
        |--------------------------------------------------------------------------
        |
        | Supports:
        | - ACF image arrays
        | - WordPress attachment IDs
        | - direct URL strings
        |
        */

        $galleryImages = collect($gallerySource)
            ->map(function ($image) {
                /*
                 * Direct image URL.
                 */
                if (is_string($image)) {
                    return [
                        'url' => $image,
                        'thumbnail' => $image,
                        'alt' => '',
                    ];
                }

                /*
                 * WordPress attachment ID.
                 */
                if (is_int($image) || is_numeric($image)) {
                    $attachmentId = (int) $image;

                    $url = wp_get_attachment_image_url($attachmentId, 'full') ?: '';

                    $thumbnail = wp_get_attachment_image_url($attachmentId, 'large') ?: $url;

                    $alt = get_post_meta($attachmentId, '_wp_attachment_image_alt', true);

                    return [
                        'url' => $url,
                        'thumbnail' => $thumbnail,
                        'alt' => $alt,
                    ];
                }

                /*
                 * ACF image array.
                 */
                if (is_array($image)) {
                    $url = $image['url'] ?? '';

                    $thumbnail = $image['sizes']['large'] ?? ($image['sizes']['medium_large'] ?? $url);

                    return [
                        'url' => $url,
                        'thumbnail' => $thumbnail,
                        'alt' => $image['alt'] ?? '',
                    ];
                }

                return null;
            })
            ->filter(fn($image) => !empty($image['url']))
            ->values()
            ->all();

        $firstImage = $galleryImages[0] ?? null;
    @endphp


    <section class="min-h-screen bg-white py-20 sm:py-24 lg:py-28" data-gallery-page>
        <div class="max-w-250 mx-auto w-full px-6 sm:px-8 lg:px-12 xl:px-0">
            <header class="text-center">
                <h1 class="text-ink font1-light text-4xl uppercase leading-none tracking-[-0.04em] sm:text-5xl">
                    {{ $galleryTitle }}
                </h1>
            </header>


            @if ($firstImage)
                {{--
                |--------------------------------------------------------------------------
                | Main slider image
                |--------------------------------------------------------------------------
                --}}

                <div class="mt-14 lg:mt-16" data-gallery-slider>
                    <div class="aspect-16/10 bg-off-white relative cursor-grab select-none overflow-hidden active:cursor-grabbing lg:aspect-video"
                        data-gallery-swipe-area>
                        <img src="{{ $firstImage['url'] }}" alt="{{ $firstImage['alt'] }}" draggable="false"
                            class="absolute inset-0 size-full object-cover transition-opacity duration-300"
                            data-gallery-main-image>

                        {{-- Previous --}}
                        <button type="button"
                            class="bg-primary text-ink hover:bg-accent absolute bottom-0 left-0 z-10 flex size-12 items-center justify-center transition-colors hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
                            aria-label="Previous gallery image" data-gallery-prev>
                            <svg viewBox="0 0 24 24" class="size-6" fill="none" aria-hidden="true">
                                <path d="M15 4L7 12L15 20" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </button>

                        {{-- Next --}}
                        <button type="button"
                            class="bg-primary text-ink hover:bg-accent absolute bottom-0 right-0 z-10 flex size-12 items-center justify-center transition-colors hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
                            aria-label="Next gallery image" data-gallery-next>
                            <svg viewBox="0 0 24 24" class="size-6" fill="none" aria-hidden="true">
                                <path d="M9 4L17 12L9 20" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </button>
                    </div>


                    {{--
                    |--------------------------------------------------------------------------
                    | All gallery images
                    |--------------------------------------------------------------------------
                    --}}

                    <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:gap-5" data-gallery-thumbnails>
                        @foreach ($galleryImages as $index => $image)
                            <button type="button"
                                class="aspect-3/4 bg-off-white focus-visible:outline-primary {{ $index === 0 ? 'ring-2 ring-primary grayscale-0' : '' }} group relative overflow-hidden grayscale transition duration-500 hover:grayscale-0 focus-visible:outline-2 focus-visible:outline-offset-4"
                                aria-label="View gallery image {{ $index + 1 }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                data-gallery-thumbnail="{{ $index }}">
                                <img src="{{ $image['thumbnail'] }}" alt="{{ $image['alt'] }}" loading="lazy"
                                    draggable="false"
                                    class="absolute inset-0 size-full object-cover transition-transform duration-700 group-hover:scale-105">

                                <span
                                    class="{{ $index === 0 ? 'opacity-0' : '' }} pointer-events-none absolute inset-0 bg-white/20 transition-opacity duration-300 group-hover:opacity-0"
                                    data-gallery-thumbnail-overlay aria-hidden="true"></span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-stone mt-14 text-center">
                    No gallery images have been added yet.
                </p>
            @endif
        </div>


        <script type="application/json" data-gallery-data>
            {!! wp_json_encode(
                $galleryImages,
                JSON_HEX_TAG
                | JSON_HEX_AMP
                | JSON_HEX_APOS
                | JSON_HEX_QUOT
            ) !!}
        </script>
    </section>
@endsection
