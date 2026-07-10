@extends('layouts.app')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | Hero
        |--------------------------------------------------------------------------
        */

        $heroEyebrow = get_field('hero_eyebrow') ?: 'I&M Sons Masonry';

        $heroText =
            get_field('hero_text') ?:
            'For over 20 years, we have been building, extending and improving homes across London. Every project is approached with the same focus on quality workmanship, reliability and attention to detail from start to finish.';

        $heroImage = get_field('hero_image');

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        $services = [
            [
                'title' => 'House Extension',
                'description' => 'Create more space for your family with a house extension.',
                'image' =>
                    get_field('service_house_extension_image') ?: get_theme_file_uri('/resources/images/service1.png'),
                'url' => '#',
            ],
            [
                'title' => 'Roof Construction',
                'description' => 'From new roofs to complete roof replacements.',
                'image' =>
                    get_field('service_roof_construction_image') ?:
                    get_theme_file_uri('/resources/images/service2.png'),
                'url' => '#',
            ],
            [
                'title' => 'Summer House',
                'description' => 'Whether you need a garden office, gym or additional living space.',
                'image' =>
                    get_field('service_summer_house_image') ?: get_theme_file_uri('/resources/images/service3.png'),
                'url' => '#',
            ],
            [
                'title' => 'Masonry & Bricklaying',
                'description' => 'Brickwork is where our journey began.',
                'image' => get_field('service_masonry_image') ?: get_theme_file_uri('/resources/images/service4.png'),
                'url' => '#',
            ],
            [
                'title' => 'Loft Conversion',
                'description' => 'Transform unused roof space into a practical part of your home.',
                'image' =>
                    get_field('service_loft_conversion_image') ?: get_theme_file_uri('/resources/images/service5.png'),
                'url' => '#',
            ],
            [
                'title' => 'House Refurbishment',
                'description' => 'From individual rooms to complete property renovations.',
                'image' =>
                    get_field('service_refurbishment_image') ?: get_theme_file_uri('/resources/images/service6.png'),
                'url' => '#',
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
            'I&M Sons Masonry Ltd was established in 2017, but our experience in the building industry goes back more than 20
        years. We started by specialising in masonry, bricklaying and structural construction work before expanding into
        house extensions, loft conversions, roofing, refurbishments and a wide range of residential building services.';

        $aboutImage = get_field('about_image');

        $aboutLink = get_field('about_link');

        $aboutUrl = is_array($aboutLink) ? $aboutLink['url'] ?? '#' : ($aboutLink ?: '#');

        $aboutLinkText = is_array($aboutLink) ? $aboutLink['title'] ?? 'Read More' : 'Read More';

        /*
        |--------------------------------------------------------------------------
        | Reviews
        |--------------------------------------------------------------------------
        */

        $reviewsBackground = get_field('reviews_background');

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

        $galleryUrl = is_array($galleryLink) ? $galleryLink['url'] ?? '#' : ($galleryLink ?: '#');

        $galleryLinkText = is_array($galleryLink) ? $galleryLink['title'] ?? 'View More' : 'View More';

        $galleryImages = get_field('gallery_images') ?: [
            [
                'image' => get_field('gallery_image_1'),
                'title' => 'Masonry and bricklaying',
            ],
            [
                'image' => get_field('gallery_image_2'),
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

    <section
        class="
            relative
            min-h-155
            overflow-hidden
            bg-charcoal

            lg:min-h-170
            xl:min-h-180
        ">
        {{-- Background image --}}
        @if ($heroImage)
            <img src="{{ is_array($heroImage) ? $heroImage['url'] : $heroImage }}"
                alt="{{ is_array($heroImage) ? $heroImage['alt'] ?? '' : '' }}"
                class="
                    absolute
                    inset-0
                    size-full
                    object-cover
                ">
        @endif


        {{-- Main dark overlay --}}
        <div class="
                absolute
                inset-0
                bg-linear-to-r
                from-black/80
                via-black/55
                to-black/35
            "
            aria-hidden="true"></div>


        {{-- Secondary depth overlay --}}
        <div class="
                absolute
                inset-0
                bg-linear-to-b
                from-[#182035]/25
                via-transparent
                to-black/40
            "
            aria-hidden="true"></div>


        {{-- Hero content --}}
        <div
            class="
                relative
                z-10
                mx-auto
                flex
                min-h-155
                max-w-site
                items-center
                px-6
                py-24

                sm:px-8

                lg:min-h-170
                lg:px-12

                xl:min-h-180
                xl:px-16
            ">
            <div
                class="
                    grid
                    w-full
                    items-end
                    gap-12

                    lg:grid-cols-[minmax(0,1.15fr)_minmax(340px,0.85fr)]
                    lg:gap-16
                ">

                {{-- Hero left --}}
                <div class="max-w-190">
                    <p
                        class="
                            mb-6
                            text-xs
                            font-medium
                            uppercase
                            tracking-[0.03em]
                            text-primary

                            sm:text-sm
                        ">
                        {{ $heroEyebrow }}
                    </p>


                    <h1
                        class="
                            max-w-185
                            text-[clamp(3.5rem,7vw,7.25rem)]
                            leading-[0.9]
                            font-light
                            tracking-[-0.055em]
                            text-white
                            uppercase
                        ">
                        Your Home,<br>
                        Your Way<span class="text-primary">.</span>
                    </h1>
                </div>


                {{-- Hero right --}}
                <div
                    class="
                        pb-2

                        lg:flex
                        lg:items-start
                        lg:gap-5

                        xl:gap-7
                    ">
                    {{-- Yellow line --}}
                    <div class="
                            mt-2.5
                            hidden
                            h-0.75
                            flex-1
                            bg-primary

                            lg:block
                        "
                        aria-hidden="true"></div>


                    {{-- Intro --}}
                    <p
                        class="
                            max-w-90
                            text-sm/7
                            text-white/80

                            lg:text-[15px]/7
                        ">
                        {{ $heroText }}
                    </p>
                </div>

            </div>
        </div>


        {{-- Bottom centre masonry mark --}}
        <div class="
                absolute
                bottom-0
                left-1/2
                z-20
                -translate-x-1/2
                translate-y-1/2
            "
            aria-hidden="true">
            <div
                class="
                    flex
                    size-14.5
                    items-center
                    justify-center
                    rounded-full
                    bg-primary
                    shadow-[0_8px_24px_rgba(0,0,0,0.2)]
                ">
                <svg viewBox="0 0 40 40" class="size-8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 8H25L29 30H11L15 8Z" fill="currentColor" class="text-charcoal" />

                    <path d="M18 30V37" stroke="currentColor" stroke-width="4" stroke-linecap="round" class="text-accent" />

                    <path d="M22 30V37" stroke="currentColor" stroke-width="4" stroke-linecap="round" class="text-accent" />
                </svg>
            </div>
        </div>
    </section>



    {{--
    |--------------------------------------------------------------------------
    | SERVICES
    |--------------------------------------------------------------------------
    --}}

    <section
        class="
            relative
            overflow-hidden
            bg-white
            py-20
            sm:py-24
            lg:py-28
        ">
        <div
            class="
                mx-auto
                max-w-site
                px-6
                sm:px-8
                lg:px-12
                xl:px-16
            ">

            {{--
            |--------------------------------------------------------------------------
            | Services brand heading
            |--------------------------------------------------------------------------
            --}}

            <div
                class="
                    mb-16
                    text-center

                    lg:mb-20
                ">
                <div
                    class="
                        text-[clamp(2rem,3.2vw,3.7rem)]
                        leading-none
                        font-light
                        tracking-[-0.045em]
                        text-primary
                        uppercase
                    ">
                    I&amp;M Sons
                </div>

                <div
                    class="
                        mt-1
                        text-[clamp(1rem,1.65vw,1.7rem)]
                        leading-none
                        font-normal
                        text-accent
                        uppercase
                    ">
                    Masonry
                </div>
            </div>



            {{--
            |--------------------------------------------------------------------------
            | Mobile heading
            |--------------------------------------------------------------------------
            --}}

            <div class="mb-10 lg:hidden">
                <div class="flex items-center gap-4">
                    <span
                        class="
                            size-2.5
                            shrink-0
                            rounded-full
                            bg-primary
                        "></span>

                    <span
                        class="
                            h-0.5
                            flex-1
                            bg-primary
                        "></span>
                </div>


                <div
                    class="
                        mt-5
                        flex
                        items-end
                        justify-between
                        gap-5
                    ">
                    <h2
                        class="
                            text-4xl
                            font-light
                            tracking-[-0.045em]
                            text-ink
                            uppercase
                        ">
                        Services
                    </h2>

                    <p
                        class="
                            max-w-36.25
                            text-right
                            text-xs/5
                            text-stone
                        ">
                        Over 20 Years of Building Experience
                    </p>
                </div>
            </div>



            {{--
            |--------------------------------------------------------------------------
            | Main services layout
            |--------------------------------------------------------------------------
            --}}

            <div
                class="
                    grid
                    gap-10

                    lg:grid-cols-[130px_minmax(0,1fr)_190px]

                    xl:grid-cols-[170px_minmax(0,1fr)_230px]
                    xl:gap-12
                ">

                {{--
                |--------------------------------------------------------------------------
                | Left vertical services label
                |--------------------------------------------------------------------------
                --}}

                <aside
                    class="
                        relative
                        hidden

                        lg:flex
                        lg:min-h-full
                        lg:items-start
                        lg:justify-center
                    ">
                    <div class="sticky top-28 pt-20">

                        {{-- Dot + line --}}
                        <div
                            class="
                                absolute
                                top-10
                                left-1/2
                                flex
                                -translate-x-1/2
                                items-center
                            ">
                            <span
                                class="
                                    size-3
                                    shrink-0
                                    rounded-full
                                    bg-primary
                                "></span>

                            <span
                                class="
                                    h-0.75
                                    w-31.25
                                    bg-primary

                                    xl:w-41.25
                                "></span>
                        </div>


                        {{-- Vertical text --}}
                        <div
                            class="
                                rotate-180
                                text-[42px]
                                leading-none
                                font-light
                                tracking-[-0.04em]
                                text-ink
                                uppercase
                                [writing-mode:vertical-rl]
                            ">
                            Services
                        </div>

                    </div>
                </aside>



                {{--
                |--------------------------------------------------------------------------
                | Service cards
                |--------------------------------------------------------------------------
                |
                | Every card starts in the normal state.
                | Every card gets the reference "fifth card" treatment on hover.
                |
                |--------------------------------------------------------------------------
                --}}

                <div
                    class="
                        grid
                        gap-5

                        sm:grid-cols-2
                        xl:grid-cols-3
                    ">
                    @foreach ($services as $service)
                        <a href="{{ $service['url'] }}"
                            class="
                                group
                                relative
                                isolate
                                min-h-100
                                overflow-hidden
                                bg-charcoal

                                sm:min-h-110
                                xl:min-h-117.5

                                focus-visible:outline-2
                                focus-visible:outline-offset-4
                                focus-visible:outline-primary
                            ">

                            {{-- Image --}}
                            @if ($service['image'])
                                <img src="{{ is_array($service['image']) ? $service['image']['url'] : $service['image'] }}"
                                    alt="{{ is_array($service['image']) ? $service['image']['alt'] ?? $service['title'] : $service['title'] }}"
                                    class="
                                        absolute
                                        inset-0
                                        size-full
                                        object-cover
                                        transition-transform
                                        duration-700
                                        ease-out

                                        group-hover:scale-105
                                        group-focus-visible:scale-105
                                    ">
                            @endif


                            {{-- Default overlay --}}
                            <div class="
                                    absolute
                                    inset-0
                                    bg-linear-to-b
                                    from-black/40
                                    via-black/20
                                    to-black/70
                                    transition-all
                                    duration-500

                                    group-hover:from-black/50
                                    group-hover:via-black/30
                                    group-hover:to-black/85

                                    group-focus-visible:from-black/50
                                    group-focus-visible:via-black/30
                                    group-focus-visible:to-black/85
                                "
                                aria-hidden="true"></div>


                            {{-- Content --}}
                            <div
                                class="
                                    relative
                                    z-10
                                    flex
                                    min-h-100
                                    flex-col
                                    justify-between
                                    p-7

                                    sm:min-h-110

                                    xl:min-h-117.5
                                    xl:p-8
                                ">
                                {{-- Title --}}
                                <h3
                                    class="
                                        max-w-45
                                        text-lg/[1.15]
                                        font-normal
                                        text-white
                                        uppercase
                                    ">
                                    {{ $service['title'] }}
                                </h3>


                                {{-- Bottom area --}}
                                <div>
                                    <p
                                        class="
                                            max-w-55
                                            text-sm/6
                                            text-white/80
                                            transition-transform
                                            duration-500

                                            group-hover:-translate-y-3
                                            group-focus-visible:-translate-y-3
                                        ">
                                        {{ $service['description'] }}
                                    </p>


                                    {{-- Hover state CTA --}}
                                    <span
                                        class="
                                            pointer-events-none
                                            mt-0
                                            flex
                                            h-11
                                            max-w-45
                                            translate-y-3
                                            items-center
                                            justify-center
                                            border
                                            border-white
                                            text-[11px]
                                            tracking-[0.06em]
                                            text-white
                                            uppercase
                                            opacity-0
                                            transition-all
                                            duration-500

                                            group-hover:mt-5
                                            group-hover:translate-y-0
                                            group-hover:opacity-100

                                            group-focus-visible:mt-5
                                            group-focus-visible:translate-y-0
                                            group-focus-visible:opacity-100
                                        ">
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

                <aside
                    class="
                        hidden

                        lg:flex
                        lg:items-center
                    ">
                    <div class="w-full">

                        {{-- Arrow line --}}
                        <div
                            class="
                                relative
                                h-0.75
                                bg-primary
                            ">
                            <span
                                class="
                                    absolute
                                    top-1/2
                                    left-0
                                    size-4
                                    -translate-x-0.5
                                    -translate-y-1/2
                                    rotate-45
                                    border-b-3
                                    border-l-3
                                    border-primary
                                "></span>
                        </div>


                        {{-- Experience text --}}
                        <p
                            class="
                                mt-12
                                max-w-37.5
                                text-sm/6
                                text-stone
                            ">
                            Over 20 Years of<br>
                            Building Experience
                        </p>

                    </div>
                </aside>

            </div>
        </div>
    </section>
    <section
        class="
        relative
        overflow-hidden
        bg-linear-to-r
        from-primary
        to-accent
        py-20
        sm:py-24
        lg:py-28
        xl:py-32
    ">
        <div
            class="
            relative
            mx-auto
            grid
            max-w-site
            items-center
            gap-12
            px-6

            sm:px-8

            lg:grid-cols-[minmax(0,1fr)_minmax(360px,0.8fr)]
            lg:gap-16
            lg:px-12

            xl:grid-cols-[minmax(0,1.05fr)_minmax(420px,0.75fr)]
            xl:gap-24
            xl:px-16
        ">
            {{-- White line that overlaps the image --}}
            <div class="
                pointer-events-none
                absolute
                top-20
                left-[30%]
                z-20
                hidden
                items-center

                lg:flex
                lg:w-[58%]

                xl:left-[29%]
                xl:w-[60%]
            "
                aria-hidden="true">
                <span
                    class="
                    size-3
                    shrink-0
                    rounded-full
                    bg-white
                "></span>

                <span
                    class="
                    h-0.5
                    flex-1
                    bg-white
                "></span>
            </div>


            {{-- About content --}}
            <div
                class="
                relative
                z-10
                grid
                gap-8

                lg:grid-cols-[220px_minmax(0,1fr)]
                lg:gap-12

                xl:grid-cols-[240px_minmax(0,1fr)]
                xl:gap-16
            ">
                <h2
                    class="
                    text-4xl
                    leading-none
                    font-light
                    tracking-[-0.04em]
                    text-white
                    uppercase

                    sm:text-5xl
                    lg:text-[44px]
                    xl:text-5xl
                ">
                    {{ $aboutTitle }}
                </h2>

                <div class="lg:pt-14">
                    {{-- Mobile line --}}
                    <div class="
                        mb-8
                        flex
                        items-center

                        lg:hidden
                    "
                        aria-hidden="true">
                        <span
                            class="
                            size-3
                            shrink-0
                            rounded-full
                            bg-white
                        "></span>

                        <span
                            class="
                            h-0.5
                            flex-1
                            bg-white
                        "></span>
                    </div>

                    <div
                        class="
                        max-w-96
                        text-sm/7
                        text-white

                        sm:text-base/7
                    ">
                        {!! wp_kses_post(wpautop($aboutText)) !!}
                    </div>

                    <a href="{{ $aboutUrl }}"
                        class="
                        mt-10
                        inline-flex
                        h-13
                        min-w-36
                        items-center
                        justify-center
                        bg-white
                        px-8
                        text-xs
                        font-medium
                        tracking-[0.02em]
                        text-ink
                        uppercase
                        transition
                        duration-300

                        hover:bg-ink
                        hover:text-white

                        focus-visible:outline-2
                        focus-visible:outline-offset-4
                        focus-visible:outline-white
                    ">
                        {{ $aboutLinkText }}
                    </a>
                </div>
            </div>


            {{-- About image --}}
            <div
                class="
                relative
                z-10
                mx-auto
                w-full
                max-w-96

                lg:max-w-none
            ">
                <div
                    class="
                    relative
                    aspect-[1.05/1]
                    overflow-hidden
                    bg-charcoal
                ">
                    @if ($aboutImage)
                        <img src="{{ is_array($aboutImage) ? $aboutImage['url'] : $aboutImage }}"
                            alt="{{ is_array($aboutImage) ? $aboutImage['alt'] ?? $aboutTitle : $aboutTitle }}"
                            class="
                            absolute
                            inset-0
                            size-full
                            object-cover
                        ">
                    @endif

                    <div class="
                        absolute
                        inset-0
                        bg-black/10
                    "
                        aria-hidden="true"></div>

                    {{-- Centre logo --}}
                    <div class="
                        absolute
                        top-1/2
                        left-1/2
                        z-10
                        -translate-x-1/2
                        -translate-y-1/2
                    "
                        aria-hidden="true">
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

    <section
        class="
        reviews-slider
        relative
        isolate
        overflow-hidden
        bg-charcoal
        py-16

        sm:py-20
        lg:min-h-112
        lg:py-18
        xl:min-h-120
    "
        data-reviews-slider>
        {{-- Background image --}}
        @if ($reviewsBackground)
            <img src="{{ is_array($reviewsBackground) ? $reviewsBackground['url'] : $reviewsBackground }}" alt=""
                class="
                absolute
                inset-0
                -z-20
                size-full
                object-cover
            ">
        @endif


        {{-- Dark overlay --}}
        <div class="
            absolute
            inset-0
            -z-10
            bg-black/75
        "
            aria-hidden="true"></div>


        <div
            class="
            mx-auto
            grid
            max-w-site
            gap-12
            px-6

            sm:px-8

            lg:grid-cols-[280px_minmax(0,1fr)]
            lg:items-end
            lg:gap-16
            lg:px-12

            xl:grid-cols-[320px_minmax(0,1fr)]
            xl:gap-20
            xl:px-16
        ">
            {{--
        |--------------------------------------------------------------------------
        | Reviews intro
        |--------------------------------------------------------------------------
        --}}

            <div class="
                relative

                lg:min-h-80
            ">
                <div
                    class="
                    flex
                    items-end
                    gap-6
                ">
                    <h2
                        class="
                        text-5xl
                        leading-none
                        font-light
                        tracking-[-0.04em]
                        text-primary
                        uppercase

                        lg:absolute
                        lg:bottom-0
                        lg:left-0
                        lg:rotate-180
                        lg:text-6xl
                        lg:[writing-mode:vertical-rl]
                    ">
                        Reviews
                    </h2>


                    <p
                        class="
                        max-w-44
                        text-sm/6
                        text-white/80

                        lg:ml-28
                        lg:max-w-40
                    ">
                        {{ $reviewsIntro }}
                    </p>
                </div>
            </div>


            {{--
        |--------------------------------------------------------------------------
        | Slider area
        |--------------------------------------------------------------------------
        --}}

            <div class="min-w-0">
                <div class="overflow-hidden">
                    <div class="
                        flex
                        transition-transform
                        duration-500
                        ease-out
                    "
                        data-reviews-track>
                        @foreach ($reviews as $review)
                            <article
                                class="
                                w-full
                                shrink-0
                                px-2

                                md:w-1/2
                                md:px-3
                            "
                                data-review-slide>
                                <div
                                    class="
                                    flex
                                    min-h-80
                                    flex-col
                                    justify-between
                                    bg-white
                                    p-8

                                    sm:p-10
                                    lg:min-h-84
                                    xl:p-12
                                ">
                                    <blockquote
                                        class="
                                        max-w-64
                                        text-2xl/tight
                                        font-light
                                        tracking-tight
                                        text-ink

                                        lg:text-[27px]/[1.2]
                                    ">
                                        {{ $review['review'] ?? '' }}
                                    </blockquote>


                                    <p
                                        class="
                                        mt-10
                                        text-xs
                                        font-medium
                                        text-accent
                                        uppercase
                                    ">
                                        {{ $review['name'] ?? '' }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>


                {{--
            |--------------------------------------------------------------------------
            | Controls
            |--------------------------------------------------------------------------
            --}}

                <div
                    class="
                    mt-6
                    flex
                    items-center
                    justify-between
                    gap-6
                ">
                    <button type="button"
                        class="
                        flex
                        size-11
                        shrink-0
                        items-center
                        justify-center
                        text-primary
                        transition
                        duration-300

                        hover:-translate-x-1
                        hover:text-white

                        focus-visible:outline-2
                        focus-visible:outline-offset-4
                        focus-visible:outline-primary
                    "
                        aria-label="Previous review" data-reviews-prev>
                        <svg viewBox="0 0 24 24" class="size-8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 4L7 12L15 20" stroke="currentColor" stroke-width="2.5" stroke-linecap="square"
                                stroke-linejoin="miter" />
                        </svg>
                    </button>


                    <div class="
                        flex
                        min-w-0
                        flex-1
                        items-center
                        gap-0
                    "
                        data-reviews-pagination>
                        @foreach ($reviews as $index => $review)
                            <button type="button"
                                class="
                                group
                                flex
                                h-8
                                min-w-0
                                flex-1
                                items-center
                            "
                                aria-label="Go to review {{ $index + 1 }}" data-reviews-dot="{{ $index }}">
                                <span
                                    class="
                                    relative
                                    block
                                    h-0.5
                                    w-full
                                    bg-white/35
                                    transition
                                    duration-300

                                    group-hover:bg-white/60
                                ">
                                    <span
                                        class="
                                        absolute
                                        top-1/2
                                        left-0
                                        size-3
                                        -translate-y-1/2
                                        rounded-full
                                        bg-white
                                        opacity-0
                                        transition
                                        duration-300
                                    "
                                        data-reviews-dot-marker></span>
                                </span>
                            </button>
                        @endforeach
                    </div>


                    <button type="button"
                        class="
                        flex
                        size-11
                        shrink-0
                        items-center
                        justify-center
                        text-primary
                        transition
                        duration-300

                        hover:translate-x-1
                        hover:text-white

                        focus-visible:outline-2
                        focus-visible:outline-offset-4
                        focus-visible:outline-primary
                    "
                        aria-label="Next review" data-reviews-next>
                        <svg viewBox="0 0 24 24" class="size-8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 4L17 12L9 20" stroke="currentColor" stroke-width="2.5" stroke-linecap="square"
                                stroke-linejoin="miter" />
                        </svg>
                    </button>
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
        <div class="mx-auto max-w-site px-6 sm:px-8 lg:px-12 xl:px-16">

            {{-- Heading --}}
            <div class="mb-14 text-center lg:mb-16">
                <h2
                    class="
                    text-4xl
                    leading-none
                    font-light
                    tracking-[-0.04em]
                    text-ink
                    uppercase

                    sm:text-5xl
                ">
                    {{ $galleryTitle }}
                </h2>
            </div>


            {{-- Gallery images --}}
            <div
                class="
                grid
                grid-cols-2
                gap-4

                md:grid-cols-3
                md:gap-5

                xl:grid-cols-5
            ">
                @foreach ($galleryImages as $item)
                    @php
                        $image = $item['image'] ?? null;

                        $imageUrl = is_array($image) ? $image['url'] ?? '' : $image;

                        $imageAlt = is_array($image) ? $image['alt'] ?? ($item['title'] ?? '') : $item['title'] ?? '';
                    @endphp

                    <figure
                        class="
                        group
                        relative
                        aspect-3/4
                        overflow-hidden
                        bg-off-white
                    ">
                        @if ($imageUrl)
                            <img src="{{ $imageUrl }}" alt="{{ $imageAlt }}"
                                class="
                                absolute
                                inset-0
                                size-full
                                object-cover
                                grayscale
                                transition
                                duration-700
                                ease-out

                                group-hover:scale-105
                                group-hover:grayscale-0
                                group-focus-within:scale-105
                                group-focus-within:grayscale-0
                            ">
                        @endif

                        {{-- Subtle wash visible in the resting state --}}
                        <div class="
                            pointer-events-none
                            absolute
                            inset-0
                            bg-white/20
                            transition-opacity
                            duration-500

                            group-hover:opacity-0
                            group-focus-within:opacity-0
                        "
                            aria-hidden="true"></div>
                    </figure>
                @endforeach
            </div>


            {{-- View more line --}}
            <div
                class="
                mx-auto
                mt-14
                flex
                max-w-170
                items-center

                sm:mt-16
            ">
                <span class="size-2.5 shrink-0 rounded-full bg-primary" aria-hidden="true"></span>

                <span
                    class="
                    h-0.5
                    min-w-6
                    flex-1
                    bg-primary
                "
                    aria-hidden="true"></span>

                <a href="{{ $galleryUrl }}"
                    class="
                    shrink-0
                    px-6
                    text-xs
                    font-medium
                    tracking-[0.02em]
                    text-accent
                    uppercase
                    transition-colors
                    duration-300

                    hover:text-ink

                    focus-visible:outline-2
                    focus-visible:outline-offset-4
                    focus-visible:outline-primary
                ">
                    {{ $galleryLinkText }}
                </a>

                <span
                    class="
                    h-0.5
                    min-w-6
                    flex-1
                    bg-primary
                "
                    aria-hidden="true"></span>

                <span class="size-2.5 shrink-0 rounded-full bg-primary" aria-hidden="true"></span>
            </div>
        </div>
    </section>



    {{--
|--------------------------------------------------------------------------
| FAQ
|--------------------------------------------------------------------------
--}}

    <section class="bg-white pb-24 sm:pb-28 lg:pb-32">
        <div
            class="
            mx-auto
            grid
            max-w-170
            gap-10
            px-6

            sm:px-8

            lg:grid-cols-[140px_minmax(0,1fr)]
            lg:gap-12
            lg:px-0
        ">
            {{-- FAQ introduction --}}
            <div>
                <h2
                    class="
                    text-4xl
                    leading-none
                    font-light
                    tracking-[-0.04em]
                    text-ink
                    uppercase

                    sm:text-5xl
                ">
                    {{ $faqTitle }}
                </h2>

                <p
                    class="
                    mt-5
                    max-w-34
                    text-sm/6
                    text-accent
                ">
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

                    <article
                        class="
                        bg-white
                        shadow-[0_2px_12px_rgba(0,0,0,0.08)]
                    "
                        data-faq-item>
                        <h3>
                            <button id="{{ $buttonId }}" type="button"
                                class="
                                flex
                                min-h-12
                                w-full
                                items-center
                                justify-between
                                gap-6
                                px-7
                                py-4
                                text-left
                                text-sm
                                font-normal
                                text-ink
                                transition-colors
                                duration-300

                                hover:text-accent

                                focus-visible:outline-2
                                focus-visible:outline-offset-2
                                focus-visible:outline-primary
                            "
                                aria-expanded="{{ $isOpen ? 'true' : 'false' }}" aria-controls="{{ $panelId }}"
                                data-faq-trigger>
                                <span>
                                    {{ $faq['question'] ?? '' }}
                                </span>

                                <span
                                    class="
                                    relative
                                    size-4
                                    shrink-0
                                "
                                    aria-hidden="true">
                                    <span
                                        class="
                                        absolute
                                        top-1/2
                                        left-0
                                        h-0.5
                                        w-full
                                        -translate-y-1/2
                                        bg-primary
                                    "></span>

                                    <span
                                        class="
                                        absolute
                                        top-0
                                        left-1/2
                                        h-full
                                        w-0.5
                                        -translate-x-1/2
                                        bg-primary
                                        transition-transform
                                        duration-300

                                        {{ $isOpen ? 'scale-y-0' : 'scale-y-100' }}
                                    "
                                        data-faq-plus></span>
                                </span>
                            </button>
                        </h3>

                        <div id="{{ $panelId }}" role="region" aria-labelledby="{{ $buttonId }}"
                            class="{{ $isOpen ? '' : 'hidden' }}" data-faq-panel>
                            <div
                                class="
                                border-t
                                border-black/5
                                px-7
                                py-5
                                text-sm/6
                                text-stone
                            ">
                                {!! wp_kses_post(wpautop($faq['answer'] ?? '')) !!}
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
