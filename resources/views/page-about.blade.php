{{--
  Template Name: About Us
--}}

@extends('layouts.app')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | About page
        |--------------------------------------------------------------------------
        */

        $aboutTitle = get_field('about_title') ?: 'About Us';

        $aboutContent =
            get_field('about_content') ?:
            '
            <p>
                I&M Sons Masonry Ltd was established in 2017, but our experience
                in the building industry goes back more than 20 years. We started
                by specialising in masonry, bricklaying and structural construction
                work before expanding into house extensions, loft conversions,
                roofing, refurbishments and a wide range of residential building
                services.
            </p>

            <p>
                As our client base continued to grow, so did our team. Today, we
                work with skilled tradespeople across different areas of construction,
                allowing us to deliver complete building projects for homeowners
                throughout London.
            </p>

            <p>
                Many of our projects come through recommendations from previous
                clients, their friends and family. We believe this is the best
                reflection of the quality of our work and the trust we have earned
                over the years.
            </p>
        ';

        $aboutImage = get_field('about_image');

        /*
        |--------------------------------------------------------------------------
        | Reviews
        |--------------------------------------------------------------------------
        */

        $reviewsTitle = get_field('reviews_title') ?: 'Reviews';

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
                'review' => 'I&M Sons worked on my extension in March ’26. The work went so smoothly and so quickly.',
                'name' => 'John Smith',
            ],
            [
                'review' => 'I was recommended I&M Sons by a friend. Best recommendation!',
                'name' => 'Fred Brown',
            ],
        ];
    @endphp


    {{--
    |--------------------------------------------------------------------------
    | ABOUT INTRODUCTION
    |--------------------------------------------------------------------------
    --}}

    <section class="relative overflow-hidden bg-white">
        {{-- Yellow line from viewport edge --}}
        <div class="pointer-events-none absolute left-0 top-40 z-10 hidden w-[calc(50%-24rem)] items-center lg:flex xl:w-[calc(50%-26rem)]"
            aria-hidden="true">
            <span class="bg-primary h-0.5 flex-1"></span>
            <span class="bg-primary size-2.5 shrink-0 rounded-full"></span>
        </div>

        <div class="min-h-149 grid w-full lg:grid-cols-2">
            {{-- Text column --}}
            <div class="relative flex items-center px-6 py-20 sm:px-10 sm:py-24 lg:justify-end lg:px-16 lg:py-28 xl:pr-24">
                <div class="max-w-100 w-full lg:mr-10 xl:mr-14">
                    <h1 class="text-ink text-4xl font-light uppercase leading-none tracking-[-0.04em] sm:text-5xl">
                        {{ $aboutTitle }}
                    </h1>

                    {{-- Mobile line --}}
                    <div class="mt-8 flex items-center lg:hidden" aria-hidden="true">
                        <span class="bg-primary h-0.5 flex-1"></span>
                        <span class="bg-primary size-2.5 shrink-0 rounded-full"></span>
                    </div>

                    <div
                        class="prose prose-sm text-stone prose-p:my-0 prose-p:mb-6 prose-p:text-sm prose-p:leading-6 prose-p:text-stone sm:prose-p:text-base sm:prose-p:leading-7 mt-10 max-w-none">
                        {!! wp_kses_post($aboutContent) !!}
                    </div>
                </div>
            </div>

            {{-- Image column — flush to viewport right --}}
            <div class="min-h-105 bg-off-white lg:min-h-149 relative overflow-hidden">
                @if ($aboutImage)
                    <img src="{{ is_array($aboutImage) ? $aboutImage['url'] : $aboutImage }}"
                        alt="{{ is_array($aboutImage) ? $aboutImage['alt'] ?? $aboutTitle : $aboutTitle }}"
                        class="absolute inset-0 size-full object-cover">
                @endif
            </div>
        </div>
    </section>



    {{--
|--------------------------------------------------------------------------
| REVIEWS
|--------------------------------------------------------------------------
--}}

    <section class="bg-off-white relative overflow-hidden py-20 sm:py-24 lg:py-28">
        <div
            class="max-w-288 mx-auto grid gap-12 px-6 sm:px-10 lg:grid-cols-[180px_minmax(0,1fr)] lg:gap-12 lg:px-16 xl:grid-cols-[210px_minmax(0,1fr)] xl:px-20">
            {{-- Reviews heading --}}
            <aside class="relative">
                <div class="flex items-center gap-0 lg:absolute lg:left-0 lg:top-0 lg:w-[calc(100%+11rem)] xl:w-[calc(100%+14rem)]"
                    aria-hidden="true">
                    <span class="bg-primary size-2.5 shrink-0 rounded-full"></span>

                    <span class="bg-primary h-0.5 flex-1"></span>
                </div>

                <h2
                    class="text-ink mt-10 text-4xl font-light uppercase leading-none tracking-[-0.04em] sm:text-5xl lg:mt-14 lg:rotate-180 lg:text-5xl lg:[writing-mode:vertical-rl]">
                    {{ $reviewsTitle }}
                </h2>
            </aside>

            {{-- Staggered cards --}}
            <div class="relative min-w-0">
                <div class="grid gap-5 md:grid-cols-2 lg:gap-6">
                    @foreach ($reviews as $index => $review)
                        <article
                            class="min-h-67 lg:min-h-67 {{ $index === 0 ? 'lg:translate-x-12 xl:translate-x-16' : '' }} {{ $index === 1 ? 'lg:translate-x-12 xl:translate-x-16' : '' }} {{ $index === 2 ? 'lg:-translate-x-4 xl:-translate-x-8' : '' }} {{ $index === 3 ? 'lg:-translate-x-4 xl:-translate-x-8' : '' }} flex flex-col justify-between border border-black/25 bg-white p-8 sm:min-h-72 sm:p-10">
                            <blockquote class="text-ink max-w-60 text-2xl/[1.25] font-light tracking-[-0.025em]">
                                {{ $review['review'] ?? '' }}
                            </blockquote>

                            <p class="text-accent mt-10 text-xs font-medium uppercase">
                                {{ $review['name'] ?? '' }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
