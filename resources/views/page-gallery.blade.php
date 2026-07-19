{{--
  Template Name: Gallery
--}}

@extends('layouts.app')

@section('content')
    @php
        $galleryTitle = get_field('gallery_title') ?: 'Gallery';

        $galleryCategories = [
            [
                'slug' => 'house-extensions',
                'title' => 'House Extensions',
                'cover_image' => get_theme_file_uri('/resources/images/service4.png'),
                'images' => [
                    get_theme_file_uri('/resources/images/service4.png'),
                    get_theme_file_uri('/resources/images/service3.png'),
                    get_theme_file_uri('/resources/images/service2.png'),
                ],
            ],
            [
                'slug' => 'roof-construction',
                'title' => 'Roof Construction',
                'cover_image' => get_theme_file_uri('/resources/images/service5.png'),
                'images' => [
                    get_theme_file_uri('/resources/images/gallery/house-extension1.jpg'),
                    get_theme_file_uri('/resources/images/service2.png'),
                    get_theme_file_uri('/resources/images/gallery/house-extension3.jpg'),
                ],
            ],
            [
                'slug' => 'summer-houses',
                'title' => 'Summer Houses',
                'cover_image' => get_theme_file_uri('/resources/images/service6.png'),
                'images' => [
                    get_theme_file_uri('/resources/images/gallery/summer-house1.jpg'),
                    get_theme_file_uri('/resources/images/gallery/summer-house2.jpg'),
                    get_theme_file_uri('/resources/images/service3.png'),
                ],
            ],
            [
                'slug' => 'masonry-bricklaying',
                'title' => 'Masonry & Bricklaying',
                'cover_image' => get_theme_file_uri('/resources/images/service7.png'),
                'images' => [
                    get_theme_file_uri('/resources/images/gallery/masonry1.jpg'),
                    get_theme_file_uri('/resources/images/gallery/masonry2.jpg'),
                    get_theme_file_uri('/resources/images/gallery/masonry3.jpg'),
                ],
            ],
            [
                'slug' => 'loft-conversions',
                'title' => 'Loft Conversions',
                'cover_image' => get_theme_file_uri('/resources/images/service8.png'),
                'images' => [
                    get_theme_file_uri('/resources/images/gallery/loft-conversion1.jpg'),
                    get_theme_file_uri('/resources/images/gallery/loft-conversion2.jpg'),
                    get_theme_file_uri('/resources/images/gallery/loft-conversion3.jpg'),
                ],
            ],
            [
                'slug' => 'house-refurbishments',
                'title' => 'House Refurbishments',
                'cover_image' => get_theme_file_uri('/resources/images/service9.png'),
                'images' => [
                    get_theme_file_uri('/resources/images/gallery/refurbishment1.jpg'),
                    get_theme_file_uri('/resources/images/gallery/refurbishment2.jpg'),
                    get_theme_file_uri('/resources/images/gallery/refurbishment3.jpg'),
                ],
            ],
        ];

        $galleryData = collect($galleryCategories)
            ->map(function ($category) {
                return [
                    'slug' => $category['slug'],
                    'title' => $category['title'],
                    'images' => collect($category['images'])
                        ->map(
                            fn($image) => [
                                'url' => $image,
                                'thumbnail' => $image,
                                'alt' => $category['title'],
                            ],
                        )
                        ->values()
                        ->all(),
                ];
            })
            ->values()
            ->all();
    @endphp


    <section class="min-h-screen bg-white py-20 sm:py-24 lg:py-28" data-gallery-page>
        <div class="max-w-250 mx-auto w-full px-6 sm:px-8 lg:px-12 xl:px-0">
            <header class="text-center">
                <h1 class="text-ink text-4xl font-light uppercase leading-none tracking-[-0.04em] sm:text-5xl">
                    Gallery
                </h1>
            </header>

            {{--
        |--------------------------------------------------------------------------
        | Selected gallery slider
        |--------------------------------------------------------------------------
        --}}

            <div class="mt-14 hidden lg:mt-16" data-gallery-viewer>
                <div class="mb-7 flex flex-wrap items-center justify-between gap-5">
                    <h2 aria-hidden="true"
                        class="text-ink hidden text-2xl font-light uppercase tracking-[-0.03em] sm:text-3xl"
                        data-gallery-title>
                    </h2>
                </div>

                <div class="aspect-16/10 bg-off-white relative overflow-hidden lg:aspect-video">
                    <img src="" alt=""
                        class="absolute inset-0 size-full object-cover transition-opacity duration-300"
                        data-gallery-main-image>

                    <button type="button"
                        class="bg-primary text-ink hover:bg-accent absolute bottom-0 left-0 z-10 flex size-12 items-center justify-center transition-colors hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
                        aria-label="Previous image" data-gallery-prev>
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" aria-hidden="true">
                            <path d="M15 4L7 12L15 20" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </button>

                    <button type="button"
                        class="bg-primary text-ink hover:bg-accent absolute bottom-0 right-0 z-10 flex size-12 items-center justify-center transition-colors hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
                        aria-label="Next image" data-gallery-next>
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" aria-hidden="true">
                            <path d="M9 4L17 12L9 20" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </button>

                </div>
            </div>

            {{--
        |--------------------------------------------------------------------------
        | Six category cards — always stay visible
        |--------------------------------------------------------------------------
        --}}

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:mt-16 lg:grid-cols-3" data-gallery-categories>
                @foreach ($galleryCategories as $index => $category)
                    <button type="button" class="min-h-105 bg-charcoal group relative overflow-hidden text-left"
                        data-gallery-category="{{ $index }}" data-gallery-slug="{{ $category['slug'] }}">
                        <img src="{{ $category['cover_image'] }}" alt="{{ $category['title'] }}"
                            class="absolute inset-0 size-full object-cover grayscale transition duration-700 group-hover:scale-105 group-hover:grayscale-0">

                        <span class="bg-linear-to-b absolute inset-0 from-black/20 via-black/20 to-black/80"></span>

                    </button>
                @endforeach
            </div>
        </div>

        <script type="application/json" data-gallery-data>
        {!! wp_json_encode(
            $galleryData,
            JSON_HEX_TAG
            | JSON_HEX_AMP
            | JSON_HEX_APOS
            | JSON_HEX_QUOT
        ) !!}
    </script>
    </section>
@endsection
