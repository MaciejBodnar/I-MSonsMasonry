{{--
  Template Name: Service
--}}

@extends('layouts.app')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | Service content
        |--------------------------------------------------------------------------
        */

        $serviceTitle = get_field('service_title') ?: get_the_title();

        $serviceContent = get_field('service_content') ?: apply_filters('the_content', get_the_content());

        $serviceImage = get_field('service_image');

        $galleryLink = get_field('gallery_link');

        $galleryUrl = is_array($galleryLink) ? $galleryLink['url'] ?? '#' : ($galleryLink ?: '#');

        $galleryText = is_array($galleryLink) ? $galleryLink['title'] ?? 'Gallery' : 'Gallery';

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
    | SERVICE INTRODUCTION
    |--------------------------------------------------------------------------
    --}}

    <section class="relative overflow-hidden bg-white">
        {{-- Yellow line from viewport edge --}}
        <div class="
                pointer-events-none
                absolute
                top-42
                left-0
                z-20
                hidden
                w-[calc(50%-22rem)]
                items-center

                lg:flex
                xl:w-[calc(50%-24rem)]
            "
            aria-hidden="true">
            <span class="h-0.5 flex-1 bg-primary"></span>

            <span
                class="
                    size-2.5
                    shrink-0
                    rounded-full
                    bg-primary
                "></span>
        </div>


        <div
            class="
                grid
                min-h-172
                w-full

                lg:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]
            ">
            {{--
            |--------------------------------------------------------------------------
            | Service copy
            |--------------------------------------------------------------------------
            --}}

            <div
                class="
                    relative
                    flex
                    items-center
                    px-6
                    py-20

                    sm:px-10
                    sm:py-24

                    lg:justify-end
                    lg:px-16
                    lg:py-28

                    xl:pr-24
                ">
                <div
                    class="
                        w-full
                        max-w-96

                        lg:mr-10
                        xl:mr-16
                    ">
                    <h1
                        class="
                            max-w-76
                            text-4xl
                            leading-[1.05]
                            font-light
                            tracking-[-0.045em]
                            text-ink
                            uppercase

                            sm:text-5xl
                            lg:text-[3.25rem]
                        ">
                        {{ $serviceTitle }}
                    </h1>


                    {{-- Mobile line --}}
                    <div class="
                            mt-8
                            flex
                            items-center

                            lg:hidden
                        "
                        aria-hidden="true">
                        <span class="h-0.5 flex-1 bg-primary"></span>

                        <span
                            class="
                                size-2.5
                                shrink-0
                                rounded-full
                                bg-primary
                            "></span>
                    </div>


                    <div
                        class="
                            prose
                            prose-sm
                            mt-10
                            max-w-none
                            text-stone

                            prose-headings:text-ink
                            prose-p:my-0
                            prose-p:mb-7
                            prose-p:text-sm
                            prose-p:leading-6
                            prose-p:text-stone

                            sm:prose-p:text-base
                            sm:prose-p:leading-7
                        ">
                        {!! wp_kses_post($serviceContent) !!}
                    </div>
                </div>
            </div>


            {{--
            |--------------------------------------------------------------------------
            | Service image
            |--------------------------------------------------------------------------
            --}}

            <div
                class="
                    relative
                    min-h-105
                    overflow-hidden
                    bg-off-white

                    lg:min-h-172
                ">
                @if ($serviceImage)
                    <img src="{{ is_array($serviceImage) ? $serviceImage['url'] : $serviceImage }}"
                        alt="{{ is_array($serviceImage) ? $serviceImage['alt'] ?? $serviceTitle : $serviceTitle }}"
                        class="
                            absolute
                            inset-0
                            size-full
                            object-cover
                        ">
                @endif


                {{-- Optional soft image overlay --}}
                <div class="
                        absolute
                        inset-0
                        bg-black/5
                    "
                    aria-hidden="true"></div>


                {{-- Gallery button --}}
                <a href="{{ $galleryUrl }}"
                    class="
                        absolute
                        top-1/2
                        left-1/2
                        z-10
                        inline-flex
                        h-14
                        min-w-36
                        -translate-x-1/2
                        -translate-y-1/2
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

                        hover:bg-primary
                        hover:text-ink

                        focus-visible:outline-2
                        focus-visible:outline-offset-4
                        focus-visible:outline-primary
                    ">
                    {{ $galleryText }}
                </a>
            </div>
        </div>
    </section>



    {{--
    |--------------------------------------------------------------------------
    | FAQ
    |--------------------------------------------------------------------------
    --}}

    <section class="bg-white py-20 sm:py-24 lg:py-28">
        <div
            class="
                mx-auto
                grid
                max-w-196
                gap-10
                px-6

                sm:px-8

                lg:grid-cols-[150px_minmax(0,1fr)]
                lg:gap-14
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


            {{-- FAQ accordion --}}
            <div class="space-y-4" data-faq-accordion>
                @foreach ($faqs as $index => $faq)
                    @php
                        $panelId = 'service-faq-panel-' . $index;
                        $buttonId = 'service-faq-button-' . $index;
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
