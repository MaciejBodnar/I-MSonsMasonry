@extends('layouts.app')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | Hero
        |--------------------------------------------------------------------------
        */

        $heroEyebrow = get_field('hero_eyebrow') ?: 'I&M Sons Masonry';

        $heroTitleLineOne = get_field('hero_title_line_1') ?: 'Your Home,';

        $heroTitleLineTwo = get_field('hero_title_line_2') ?: 'Your Way';

        $heroText =
            get_field('hero_text') ?:
            'For over 20 years, we have been building, extending and improving homes across London. Every project is approached with the same focus on quality workmanship, reliability and attention to detail from start to finish.';

        $heroImage = get_field('hero_image') ?: get_theme_file_uri('/resources/images/first-bg.png');

        $logo = get_theme_file_uri('/resources/images/logo.svg');

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        $servicesBrandPrimary = get_field('services_brand_primary') ?: 'I&M Sons';

        $servicesBrandSecondary = get_field('services_brand_secondary') ?: 'Masonry';

        $servicesMobileTitle = get_field('services_mobile_title') ?: 'Services';

        $servicesMobileNote = get_field('services_mobile_note') ?: 'Over 20 Years of Building Experience';

        $servicesVerticalLabel = get_field('services_vertical_label') ?: 'Services';

        $servicesExperienceNote = get_field('services_experience_note') ?: 'Over 20 Years of Building Experience';

        $services = get_field('services') ?: [
            [
                'title' => 'House Extension',
                'description' => 'Create more space for your family with a house extension.',
                'image' => get_theme_file_uri('/resources/images/service1.png'),
                'url' => home_url('/services/house-extensions/'),
            ],
            [
                'title' => 'Roof Construction',
                'description' => 'From new roofs to complete roof replacements.',
                'image' => get_theme_file_uri('/resources/images/service2.png'),
                'url' => home_url('/services/roof-construction/'),
            ],
            [
                'title' => 'Summer House',
                'description' => 'Whether you need a garden office, gym or additional living space.',
                'image' => get_theme_file_uri('/resources/images/service3.png'),
                'url' => home_url('/services/summer-houses/'),
            ],
            [
                'title' => 'Masonry & Bricklaying',
                'description' => 'Brickwork is where our journey began.',
                'image' => get_theme_file_uri('/resources/images/service4.png'),
                'url' => home_url('/services/masonry-bricklaying/'),
            ],
            [
                'title' => 'Loft Conversion',
                'description' => 'Transform unused roof space into a practical part of your home.',
                'image' => get_theme_file_uri('/resources/images/service5.png'),
                'url' => home_url('/services/loft-conversions/'),
            ],
            [
                'title' => 'House Refurbishment',
                'description' => 'From individual rooms to complete property renovations.',
                'image' => get_theme_file_uri('/resources/images/service6.png'),
                'url' => home_url('/services/house-refurbishments/'),
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | About
        |--------------------------------------------------------------------------
        */

        $aboutTitle = get_field('about_title') ?: 'About Us';

        $aboutText =
            get_field('about_text') ?:
            'I&M Sons Masonry Ltd was established in 2017, but our experience in the building industry goes back more than 20 years. We started by specialising in masonry, bricklaying and structural construction work before expanding into house extensions, loft conversions, roofing, refurbishments and a wide range of residential building services.';

        $aboutImage = get_field('about_image') ?: get_theme_file_uri('/resources/images/about-front.svg');

        $aboutLink = get_field('about_link');

        $aboutButtonText =
            get_field('about_button_text') ?: (is_array($aboutLink) ? $aboutLink['title'] ?? 'Read More' : 'Read More');

        $aboutButtonUrl = im_sons_normalize_link_value(get_field('about_button_url') ?: $aboutLink);

        /*
        |--------------------------------------------------------------------------
        | Reviews
        |--------------------------------------------------------------------------
        */

        $reviewsBackground = get_field('reviews_background');

        $reviewsTitle = get_field('reviews_title') ?: 'Reviews';

        $reviewsIntro =
            get_field('reviews_intro') ?:
            'Our reputation has been built on hard work, quality workmanship and the trust of our clients.';

        $reviews = get_field('reviews') ?: [
            [
                'review' => 'I&M Sons worked on my extension in March ’26. The work went so smoothly and so quickly.',
                'name' => 'John Smith',
            ],
            [
                'review' => 'I was recommended I&M Sons by a friend. Best recommendation!',
                'name' => 'Fred Brown',
            ],
            [
                'review' => 'The team were professional, reliable and completed everything to a very high standard.',
                'name' => 'Sarah Taylor',
            ],
            [
                'review' => 'Excellent workmanship from start to finish. We are very pleased with the result.',
                'name' => 'Michael James',
            ],
        ];

        /*
|--------------------------------------------------------------------------
| Gallery
|--------------------------------------------------------------------------
*/

        $galleryTitle = get_field('gallery_title') ?: 'Gallery';

        $galleryLink = get_field('gallery_link');

        $galleryButtonText =
            get_field('gallery_button_text') ?:
            (is_array($galleryLink)
                ? $galleryLink['title'] ?? 'View More'
                : 'View More');

        $galleryButtonUrl = im_sons_normalize_link_value(get_field('gallery_button_url') ?: $galleryLink);

        $galleryImages = get_field('gallery_images') ?: [
            [
                'image' => get_field('gallery_image_1') ?: get_theme_file_uri('/resources/images/service1.png'),
                'title' => 'Masonry and bricklaying',
            ],
            [
                'image' => get_field('gallery_image_2') ?: get_theme_file_uri('/resources/images/service2.png'),
                'title' => 'Kitchen refurbishment',
            ],
            [
                'image' => get_field('gallery_image_3'),
                'title' => 'Loft conversion',
            ],
            [
                'image' => get_field('gallery_image_4'),
                'title' => 'Garden construction',
            ],
            [
                'image' => get_field('gallery_image_5'),
                'title' => 'Interior refurbishment',
            ],
        ];

        /*
|--------------------------------------------------------------------------
| FAQ
|--------------------------------------------------------------------------
*/

        $faqTitle = get_field('faq_title') ?: 'FAQ';

        $faqIntro =
            get_field('faq_intro') ?:
            'Find answers to some of the most common questions about our construction and building services.';

        $faqs = get_field('faq_items') ?: [
            [
                'question' => 'Do you provide free quotations?',
                'answer' =>
                    'Yes. We offer free, no-obligation quotations and consultations for all residential construction projects.',
            ],
            [
                'question' => 'What areas do you cover?',
                'answer' =>
                    'We work across London and surrounding areas. Contact us with your postcode and we will confirm availability.',
            ],
            [
                'question' => 'Can you manage the entire project?',
                'answer' =>
                    'Yes. We can manage the full project from initial planning and structural work through to the final finishes.',
            ],
            [
                'question' => 'Are your projects compliant with building regulations?',
                'answer' =>
                    'Yes. Our work is completed in accordance with the relevant building regulations and approved project requirements.',
            ],
            [
                'question' => 'How long will my project take?',
                'answer' =>
                    'Timescales depend on the size and complexity of the project. We provide an estimated schedule before work begins.',
            ],
        ];
    @endphp




    {{--
    |--------------------------------------------------------------------------
    | HERO
    |--------------------------------------------------------------------------
    --}}

    <section class="min-h-155 bg-charcoal lg:min-h-170 xl:min-h-180 relative">
        {{-- Background image --}}
        @if ($heroImage)
            <img src="{{ is_array($heroImage) ? $heroImage['url'] : $heroImage }}"
                alt="{{ is_array($heroImage) ? $heroImage['alt'] ?? '' : '' }}"
                class="absolute inset-0 size-full object-cover">
        @endif


        {{-- Main dark overlay --}}
        <div class="bg-linear-to-r absolute inset-0 from-black/80 via-black/55 to-black/35" aria-hidden="true"></div>


        {{-- Secondary depth overlay --}}
        <div class="bg-linear-to-b absolute inset-0 from-[#182035]/25 via-transparent to-black/40" aria-hidden="true"></div>


        {{-- Hero content --}}
        <div
            class="min-h-155 max-w-site lg:min-h-170 xl:min-h-180 relative z-10 mx-auto flex items-center px-6 py-24 sm:px-8 lg:px-12 xl:px-16">
            <div class="relative w-full lg:flex lg:items-end lg:justify-between lg:gap-8 xl:gap-10">
                {{-- Hero title block --}}
                <div class="max-w-185 shrink-0">
                    <p class="text-primary relative mb-6 text-xs font-medium uppercase tracking-[0.03em] sm:text-lg">
                        {{ $heroEyebrow }}
                    </p>

                    <h1
                        class="max-w-185 relative text-[clamp(3.5rem,7vw,7.25rem)] font-light uppercase leading-[0.9] tracking-[-0.055em] text-white">
                        {{ $heroTitleLineOne }}<br>
                        {{ $heroTitleLineTwo }}<span class="dots text-primary"></span>
                    </h1>
                </div>


                {{-- Connector + intro --}}
                <div class="mt-8 lg:mt-0 lg:flex lg:min-w-0 lg:flex-1 lg:items-center lg:justify-end lg:gap-5 xl:gap-7">

                    {{-- Desktop line --}}
                    <span
                        class="bg-primary xl:w-105 h-1.25 bottom-3.5 right-[40%] hidden w-60 shrink-0 lg:absolute lg:block xl:right-[32%]"
                        aria-hidden="true"></span>

                    {{-- Intro text --}}
                    <p class="max-w-95 text-lg/7 text-white/80 lg:text-[15px]/7">
                        {{ $heroText }}
                    </p>
                </div>
            </div>
        </div>


        {{-- Bottom centre masonry mark --}}
        <div class="absolute bottom-4 left-1/2 z-20 -translate-x-1/2 translate-y-1/2" aria-hidden="true">
            <div class="flex size-20 items-center justify-center">
                <img src="{{ $logo }}" alt="I&M Sons Masonry" class="size-20">
            </div>
        </div>
    </section>



    {{--
    |--------------------------------------------------------------------------
    | SERVICES
    |--------------------------------------------------------------------------
    --}}

    <section class="relative overflow-hidden bg-white py-10 sm:py-24 lg:py-28">
        <div class="max-w-site mx-auto px-6 sm:px-8 lg:px-0">

            {{--
        |--------------------------------------------------------------------------
        | Services brand heading
        |--------------------------------------------------------------------------
        --}}

            <div class="mb-16 text-center lg:mb-20">
                <div
                    class="text-primary text-[clamp(3.7rem,3.2vw,3.7rem)] font-light uppercase leading-none tracking-[-0.045em]">
                    {{ $servicesBrandPrimary }}
                </div>

                <div class="text-accent mt-1 text-[clamp(1.7rem,1.65vw,1.7rem)] font-normal uppercase leading-none">
                    {{ $servicesBrandSecondary }}
                </div>
            </div>


            {{--
        |--------------------------------------------------------------------------
        | Mobile heading
        |--------------------------------------------------------------------------
        --}}

            <div class="mb-10 lg:hidden">
                <div class="mt-5 flex flex-col items-center justify-center gap-5">
                    <h2 class="text-ink text-4xl font-light uppercase tracking-[-0.045em]">
                        {{ $servicesMobileTitle }}
                    </h2>

                    <p class="text-stone text-center text-xs/5">
                        {{ $servicesMobileNote }}
                    </p>
                </div>
            </div>


            {{--
        |--------------------------------------------------------------------------
        | Main services layout
        |--------------------------------------------------------------------------
        --}}

            <div
                class="relative grid gap-10 lg:grid-cols-[130px_minmax(0,1fr)_190px] xl:grid-cols-[170px_minmax(0,1fr)_230px] xl:gap-12">
                {{--
            |--------------------------------------------------------------------------
            | Left line
            |
            | Starts at the viewport edge and overlaps the first service card.
            |--------------------------------------------------------------------------
            --}}

                <div class="top-30 pointer-events-none absolute left-[calc(18%-18vw+40px)] z-30 hidden items-center lg:flex lg:w-[calc(50vw-50%+140px+70px)]"
                    aria-hidden="true">
                    <span class="bg-primary size-3 shrink-0 rounded-full"></span>

                    <span class="h-0.75 bg-primary flex-1"></span>
                </div>


                {{-- Right arrow and line --}}
                <div class="pointer-events-none absolute right-[calc(50%-50vw)] top-1/3 z-30 hidden -translate-y-1/2 items-center lg:flex lg:w-[calc(50vw-50%+120px)] xl:w-[calc(50vw-50%+150px)]"
                    aria-hidden="true">
                    <span class="border-b-3 border-l-3 border-primary relative z-10 size-4 shrink-0 rotate-45"></span>

                    <span class="h-0.75 bg-primary -ml-4 flex-1"></span>
                </div>


                {{--
            |--------------------------------------------------------------------------
            | Left vertical services label
            |--------------------------------------------------------------------------
            --}}

                <aside class="relative hidden lg:ml-6 lg:flex lg:min-h-full lg:items-start lg:justify-start">
                    <div class="sticky top-60 pt-20">
                        <div
                            class="text-ink rotate-180 text-[42px] font-light uppercase leading-none tracking-[-0.04em] [writing-mode:vertical-rl]">
                            {{ $servicesVerticalLabel }}
                        </div>
                    </div>
                </aside>


                {{--
            |--------------------------------------------------------------------------
            | Service cards
            |--------------------------------------------------------------------------
            --}}

                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($services as $service)
                        @php
                            $serviceUrl = is_array($service['url'] ?? null)
                                ? $service['url']['url'] ?? '#'
                                : $service['url'] ?? '#';

                            $serviceImage = $service['image'] ?? null;

                            $serviceImageUrl = is_array($serviceImage) ? $serviceImage['url'] ?? '' : $serviceImage;

                            $serviceImageAlt = is_array($serviceImage)
                                ? $serviceImage['alt'] ?? ($service['title'] ?? '')
                                : $service['title'] ?? '';
                        @endphp

                        <a href="{{ $serviceUrl }}"
                            class="min-h-55 bg-charcoal sm:min-h-110 xl:min-h-117.5 focus-visible:outline-primary group relative isolate overflow-hidden focus-visible:outline-2 focus-visible:outline-offset-4">
                            {{-- Image --}}
                            @if ($serviceImageUrl)
                                <img src="{{ $serviceImageUrl }}" alt="{{ $serviceImageAlt }}"
                                    class="absolute inset-0 size-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 group-focus-visible:scale-105">
                            @endif


                            {{-- Default overlay --}}
                            <div class="absolute inset-0 bg-black/70 transition-colors duration-500 group-hover:bg-black/20 group-focus-visible:bg-black/20"
                                aria-hidden="true"></div>


                            {{-- Content --}}
                            <div
                                class="min-h-55 sm:min-h-110 xl:min-h-117.5 p-15 relative z-10 flex flex-col justify-between xl:p-8">
                                {{-- Title --}}
                                <h3 class="max-w-45 text-lg/[1.15] font-normal uppercase text-white">
                                    {{ $service['title'] }}
                                </h3>


                                {{-- Bottom area --}}
                                <div>
                                    <div
                                        class="block text-lg/6 text-white/80 transition-all duration-500 group-hover:pointer-events-none group-hover:-translate-y-3 group-hover:opacity-0 group-focus-visible:pointer-events-none group-focus-visible:-translate-y-3 group-focus-visible:opacity-0">
                                        {!! $service['description'] !!}
                                    </div>


                                    {{-- Hover state CTA --}}
                                    <span
                                        class="pointer-events-none mt-0 hidden h-11 max-w-full translate-y-3 items-center justify-center border border-white bg-black/50 text-[11px] uppercase tracking-[0.06em] text-white opacity-0 transition-all duration-500 group-hover:mt-5 group-hover:flex group-hover:translate-y-0 group-hover:opacity-100 group-focus-visible:mt-5 group-focus-visible:translate-y-0 group-focus-visible:opacity-100">
                                        Read More
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>


                {{--
            |--------------------------------------------------------------------------
            | Right experience note
            |--------------------------------------------------------------------------
            --}}

                <aside class="mb-50 hidden lg:flex lg:items-center lg:justify-end">
                    <p class="max-w-37.5 text-stone text-lg/6">
                        {{ $servicesExperienceNote }}
                    </p>
                </aside>
            </div>
        </div>
    </section>
    <section
        class="bg-linear-to-b lg:bg-linear-to-r from-primary to-accent relative overflow-hidden py-20 sm:py-24 lg:py-28 xl:py-32">
        <div
            class="max-w-site relative mx-auto grid items-center gap-12 px-6 sm:px-8 lg:grid-cols-[minmax(0,1fr)_minmax(360px,0.8fr)] lg:gap-16 lg:px-12 xl:grid-cols-[minmax(0,1.05fr)_minmax(420px,0.75fr)] xl:gap-24 xl:px-16">
            {{-- White line that overlaps the image --}}
            <div class="pointer-events-none absolute left-[30%] top-20 z-20 hidden items-center lg:flex lg:w-[58%] xl:left-[25%] xl:w-[40%]"
                aria-hidden="true">
                <span class="size-3 shrink-0 rounded-full bg-white"></span>

                <span class="h-1.5 flex-1 bg-white"></span>
            </div>


            {{-- About content --}}
            <div
                class="relative z-10 grid gap-8 lg:grid-cols-[220px_minmax(0,1fr)] lg:gap-12 xl:grid-cols-[240px_minmax(0,1fr)] xl:gap-16">
                <h2
                    class="text-4xl font-light uppercase leading-none tracking-[-0.04em] text-white sm:text-5xl lg:text-[44px] xl:text-5xl">
                    {{ $aboutTitle }}
                </h2>

                <div class="relative lg:pt-14">
                    {{-- Mobile line escaping the inner padding --}}
                    <div class="pointer-events-none absolute left-0 top-0 z-20 flex w-screen items-center lg:hidden"
                        aria-hidden="true">
                        <span class="size-3 shrink-0 rounded-full bg-white"></span>

                        <span class="h-1.5 flex-1 bg-white"></span>
                    </div>

                    {{-- Push content below the absolute line --}}
                    <div class="pt-12">
                        <div class="max-w-96 text-lg/7 text-white sm:text-base/7">
                            {!! wp_kses_post(wpautop($aboutText)) !!}
                        </div>

                        <a href="{{ $aboutButtonUrl }}"
                            class="h-13 text-ink hover:bg-ink mt-25 inline-flex min-w-36 items-center justify-center bg-white px-8 text-xs font-medium uppercase tracking-[0.02em] transition duration-300 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white">
                            {{ $aboutButtonText }}
                        </a>
                    </div>
                </div>
            </div>


            {{-- About image --}}
            <div class="relative z-10 mx-auto w-full">
                <div class="bg-charcoal relative aspect-[1.05/1] overflow-hidden">
                    @if ($aboutImage)
                        <img src="{{ is_array($aboutImage) ? $aboutImage['url'] : $aboutImage }}"
                            alt="{{ is_array($aboutImage) ? $aboutImage['alt'] ?? $aboutTitle : $aboutTitle }}"
                            class="absolute inset-0 size-full object-cover">
                    @endif

                    <div class="absolute inset-0 bg-black/10" aria-hidden="true"></div>

                    {{-- Centre logo --}}
                    <div class="absolute left-1/2 top-1/2 z-10 -translate-x-1/2 -translate-y-1/2" aria-hidden="true">
                        {{-- Your logo SVG/image --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--
|--------------------------------------------------------------------------
| REVIEWS
|--------------------------------------------------------------------------
--}}

    <section class="reviews-slider bg-charcoal relative isolate overflow-hidden py-16 sm:py-20 lg:py-24 xl:py-28"
        data-reviews-slider>
        {{-- Background image --}}
        @if ($reviewsBackground)
            <img src="{{ is_array($reviewsBackground) ? $reviewsBackground['url'] : $reviewsBackground }}" alt=""
                class="absolute inset-0 -z-20 size-full object-cover">
        @endif

        {{-- Dark overlay --}}
        <div class="bg-black/72 absolute inset-0 -z-10" aria-hidden="true"></div>

        <div class="max-w-site mx-auto px-6 sm:px-8 lg:px-12 xl:px-16">
            <div
                class="grid gap-10 lg:grid-cols-[180px_minmax(0,1fr)] lg:items-center lg:gap-12 xl:grid-cols-[220px_minmax(0,1fr)] xl:gap-16">
                {{--
            |--------------------------------------------------------------------------
            | Left intro
            |--------------------------------------------------------------------------
            --}}

                <div class="relative z-10">
                    {{-- Mobile title --}}
                    <h2 class="text-primary text-5xl font-light uppercase leading-none tracking-[-0.04em] lg:hidden">
                        {{ $reviewsTitle }}
                    </h2>

                    {{-- Desktop vertical title --}}
                    <div class="lg:min-h-95 hidden lg:flex lg:items-end lg:gap-8">
                        <h2
                            class="text-primary rotate-180 text-[60px] font-light uppercase leading-none tracking-[-0.04em] [writing-mode:vertical-rl]">
                            {{ $reviewsTitle }}
                        </h2>

                        <p class="max-w-34 text-sm/7 text-white/90">
                            {{ $reviewsIntro }}
                        </p>
                    </div>

                    {{-- Mobile intro --}}
                    <p class="mt-4 max-w-80 text-base/8 text-white/90 lg:hidden">
                        {{ $reviewsIntro }}
                    </p>
                </div>


                {{-- Slider area --}}
                <div class="relative min-w-0">
                    <div class="flex items-end gap-5 xl:gap-6">
                        {{-- Previous arrow --}}
                        <button type="button"
                            class="text-primary hidden size-11 shrink-0 items-center justify-center transition hover:-translate-x-1 hover:text-white disabled:opacity-30 lg:flex"
                            aria-label="Previous review" data-reviews-prev>
                            <svg viewBox="0 0 24 24" class="size-8" fill="none" aria-hidden="true">
                                <path d="M15 4L7 12L15 20" stroke="currentColor" stroke-width="2.5" />
                            </svg>
                        </button>

                        {{-- Cards viewport --}}
                        <div class="max-w-374 min-w-0 flex-1 overflow-hidden">
                            <div class="flex transition-transform duration-500 ease-out" data-reviews-track>
                                @foreach ($reviews as $review)
                                    <article class="w-full shrink-0 px-2 lg:w-1/2 lg:px-2.5" data-review-slide>
                                        <div
                                            class="h-115 w-115 mx-auto flex flex-col justify-between bg-white p-8 sm:p-10 lg:p-10 xl:p-12">
                                            <blockquote
                                                class="max-w-70 text-ink text-3xl/[1.2] font-light tracking-[-0.035em] lg:text-2xl/tight xl:text-[27px]/[1.22]">
                                                {{ $review['review'] ?? '' }}
                                            </blockquote>

                                            <p class="text-accent mt-8 text-xs font-medium uppercase">
                                                {{ $review['name'] ?? '' }}
                                            </p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>

                        {{-- Next arrow --}}
                        <button type="button"
                            class="text-primary hidden size-11 shrink-0 items-center justify-center transition hover:translate-x-1 hover:text-white disabled:opacity-30 lg:flex"
                            aria-label="Next review" data-reviews-next>
                            <svg viewBox="0 0 24 24" class="size-8" fill="none" aria-hidden="true">
                                <path d="M9 4L17 12L9 20" stroke="currentColor" stroke-width="2.5" />
                            </svg>
                        </button>
                    </div>

                    {{-- Right dot and line reaching viewport edge --}}
                    <div class="pointer-events-none absolute bottom-3 left-full hidden items-center lg:flex xl:translate-x-12"
                        aria-hidden="true">
                        <span class="size-3 shrink-0 rounded-full bg-white"></span>

                        <span
                            class="h-0.75 w-[calc(50vw+5rem)] bg-white xl:w-[calc(50vw+7rem)] 2xl:w-[calc(50vw+9rem)]"></span>
                    </div>

                    {{-- Mobile controls --}}
                    <div class="mt-8 flex items-center justify-between lg:hidden">
                        <button type="button"
                            class="text-primary flex size-12 items-center justify-center disabled:opacity-30"
                            aria-label="Previous review" data-reviews-prev-mobile>
                            <svg viewBox="0 0 24 24" class="size-8" fill="none" aria-hidden="true">
                                <path d="M15 4L7 12L15 20" stroke="currentColor" stroke-width="2.5" />
                            </svg>
                        </button>

                        <button type="button"
                            class="text-primary flex size-12 items-center justify-center disabled:opacity-30"
                            aria-label="Next review" data-reviews-next-mobile>
                            <svg viewBox="0 0 24 24" class="size-8" fill="none" aria-hidden="true">
                                <path d="M9 4L17 12L9 20" stroke="currentColor" stroke-width="2.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--
|--------------------------------------------------------------------------
| GALLERY
|--------------------------------------------------------------------------
--}}

    <section class="bg-white py-20 sm:py-24 lg:py-28">
        <div class="px-6">
            <div class="mb-14 text-center lg:mb-16">
                <h2 class="text-ink text-5xl font-light uppercase leading-none tracking-[-0.04em] sm:text-6xl lg:text-5xl">
                    {{ $galleryTitle }}
                </h2>
            </div>


            {{--
        |--------------------------------------------------------------------------
        | Mobile gallery slider
        |--------------------------------------------------------------------------
        --}}

            <div class="lg:hidden" data-home-gallery-slider>
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-out" data-home-gallery-track>
                        @foreach ($galleryImages as $item)
                            @php
                                $image = $item['image'] ?? null;

                                $imageUrl = is_array($image) ? $image['url'] ?? '' : $image;

                                $imageAlt = is_array($image)
                                    ? $image['alt'] ?? ($item['title'] ?? '')
                                    : $item['title'] ?? '';
                            @endphp

                            <figure class="group w-full shrink-0" data-home-gallery-slide>
                                <div class="bg-off-white relative aspect-[3/4.45] overflow-hidden">
                                    @if ($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $imageAlt }}"
                                            class="absolute inset-0 size-full object-cover grayscale group-hover:grayscale-0">
                                    @endif

                                    <div class="pointer-events-none absolute inset-0 bg-white/20" aria-hidden="true">
                                    </div>
                                </div>
                            </figure>
                        @endforeach
                    </div>
                </div>


                {{-- Mobile controls --}}
                <div class="mt-8 grid grid-cols-[48px_minmax(0,1fr)_48px] items-center gap-5">
                    <button type="button"
                        class="text-primary hover:text-accent flex size-12 items-center justify-center transition hover:-translate-x-1 disabled:opacity-30"
                        aria-label="Previous gallery image" data-home-gallery-prev>
                        <svg viewBox="0 0 24 24" class="size-9" fill="none" aria-hidden="true">
                            <path d="M15 4L7 12L15 20" stroke="currentColor" stroke-width="2.5" stroke-linecap="square"
                                stroke-linejoin="miter" />
                        </svg>
                    </button>


                    <a href="{{ $galleryButtonUrl }}"
                        class="min-h-18 border-3 border-primary text-accent hover:bg-primary hover:text-ink focus-visible:outline-primary flex items-center justify-center px-6 text-xl font-normal uppercase transition-colors focus-visible:outline-2 focus-visible:outline-offset-4">
                        {{ $galleryButtonText }}
                    </a>


                    <button type="button"
                        class="text-primary hover:text-accent flex size-12 items-center justify-center transition hover:translate-x-1 disabled:opacity-30"
                        aria-label="Next gallery image" data-home-gallery-next>
                        <svg viewBox="0 0 24 24" class="size-9" fill="none" aria-hidden="true">
                            <path d="M9 4L17 12L9 20" stroke="currentColor" stroke-width="2.5" stroke-linecap="square"
                                stroke-linejoin="miter" />
                        </svg>
                    </button>
                </div>
            </div>


            {{--
        |--------------------------------------------------------------------------
        | Desktop gallery grid
        |--------------------------------------------------------------------------
        --}}

            <div class="hidden gap-4 lg:grid lg:grid-cols-5 lg:gap-5">
                @foreach ($galleryImages as $item)
                    @php
                        $image = $item['image'] ?? null;

                        $imageUrl = is_array($image) ? $image['url'] ?? '' : $image;

                        $imageAlt = is_array($image) ? $image['alt'] ?? ($item['title'] ?? '') : $item['title'] ?? '';
                    @endphp

                    <figure class="aspect-3/4 bg-off-white group relative overflow-hidden">
                        @if ($imageUrl)
                            <img src="{{ $imageUrl }}" alt="{{ $imageAlt }}"
                                class="absolute inset-0 size-full object-cover grayscale transition duration-700 ease-out group-hover:scale-105 group-hover:grayscale-0">
                        @endif

                        <div class="pointer-events-none absolute inset-0 bg-white/20 transition-opacity duration-500 group-hover:opacity-0"
                            aria-hidden="true"></div>
                    </figure>
                @endforeach
            </div>


            {{-- Desktop view-more line --}}
            <div class="max-w-270 mx-auto mt-14 hidden items-center lg:flex">
                <span class="bg-primary size-4 shrink-0 rounded-full"></span>
                <span class="bg-primary h-1.5 flex-1"></span>

                <a href="{{ $galleryButtonUrl }}"
                    class="text-accent hover:text-ink shrink-0 px-6 text-sm font-medium uppercase tracking-[0.02em] transition-colors">
                    {{ $galleryButtonText }}
                </a>

                <span class="bg-primary h-1.5 flex-1"></span>
                <span class="bg-primary size-4 shrink-0 rounded-full"></span>
            </div>
        </div>
    </section>



    {{--
|--------------------------------------------------------------------------
| FAQ
|--------------------------------------------------------------------------
--}}

    <section class="bg-white pb-24 sm:pb-28 lg:pb-32">
        <div class="max-w-250 mx-auto grid gap-10 px-6 sm:px-8 lg:grid-cols-[200px_minmax(0,1fr)] lg:gap-12 lg:px-0">
            {{-- FAQ introduction --}}
            <div>
                <h2 class="text-ink text-4xl font-light uppercase leading-none tracking-[-0.04em] sm:text-5xl">
                    {{ $faqTitle }}
                </h2>

                <p class="max-w-45 text-accent mt-5 text-lg/6 font-light">
                    {{ $faqIntro }}
                </p>
            </div>


            {{-- Accordion --}}
            <div class="space-y-4" data-faq-accordion>
                @foreach ($faqs as $index => $faq)
                    @php
                        $panelId = 'faq-panel-' . $index;
                        $buttonId = 'faq-button-' . $index;
                        $isOpen = $index === 0;
                    @endphp

                    <article data-faq-item>
                        <h3>
                            <button id="{{ $buttonId }}" type="button"
                                class="text-ink hover:text-accent focus-visible:outline-primary flex min-h-12 w-full items-center justify-between gap-6 bg-white px-7 py-4 text-left text-lg font-normal shadow-[0_2px_12px_rgba(0,0,0,0.08)] transition-colors duration-300 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2"
                                aria-expanded="{{ $isOpen ? 'true' : 'false' }}" aria-controls="{{ $panelId }}"
                                data-faq-trigger>
                                <span>
                                    {{ $faq['question'] ?? '' }}
                                </span>
                            </button>
                        </h3>

                        <div id="{{ $panelId }}" role="region" aria-labelledby="{{ $buttonId }}"
                            class="{{ $isOpen ? '' : 'hidden' }}" data-faq-panel>
                            <div class="text-stone px-7 py-5 text-lg/6">
                                {!! wp_kses_post(wpautop($faq['answer'] ?? '')) !!}
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
