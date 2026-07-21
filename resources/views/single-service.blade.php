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

        $serviceDescription =
            get_field('service_description') ?:
            get_field('service_content') ?:
            apply_filters('the_content', get_the_content()) ?:
            ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin arcu urna, dapibus pellentesque nibh faucibus, finibus convallis elit. Etiam dignissim libero quis erat finibus, a cursus tellus interdum. Nullam fermentum, ante non gravida lobortis, libero leo faucibus purus, eu blandit dui odio in leo. Suspendisse et enim id lacus malesuada sagittis et vel urna.
              <br><br>Proin at hendrerit ipsum. Phasellus posuere nisl sed arcu faucibus, vel varius neque euismod. Curabitur egestas nisi quis felis condimentum pulvinar. Sed condimentum, leo nec fringilla facilisis, dolor urna lacinia libero, vitae semper lorem felis vel libero. Morbi porttitor purus nec nunc volutpat, in scelerisque felis vulputate.
              <br><br>Etiam ac dignissim nibh. Sed ultrices congue ipsum, ultrices porta magna rutrum vitae. Suspendisse vitae metus ac tellus tempus malesuada vel ac urna. Fusce at sagittis lectus. Integer consectetur urna quis consequat molestie. Proin ac sem eu ante condimentum mattis. Integer lobortis dui in est tempus, at mollis orci pulvinar.';

        $serviceImage = get_field('service_image') ?: get_theme_file_uri('/resources/images/first-bg.png');

        $galleryLink = get_field('gallery_link');

        $galleryUrl = is_array($galleryLink) ? $galleryLink['url'] ?? '#' : ($galleryLink ?: '#');

        $galleryText = get_field('gallery_button_text') ?: 'Gallery';

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
        <div class="top-70 pointer-events-none absolute left-0 z-20 hidden w-[calc(50%-36rem)] items-center lg:flex xl:w-[calc(50%-36rem)]"
            aria-hidden="true">
            <span class="bg-primary h-0.5 flex-1"></span>

            <span class="bg-primary size-2.5 shrink-0 rounded-full"></span>
        </div>


        <div class="min-h-172 grid w-full lg:grid-cols-[minmax(0,1fr)_minmax(0,0.75fr)]">
            {{--
            |--------------------------------------------------------------------------
            | Service copy
            |--------------------------------------------------------------------------
            --}}

            <div class="relative flex items-center px-6 py-20 sm:px-10 sm:py-24 lg:justify-end lg:px-16 lg:py-28 xl:pr-24">
                <div class="max-w-125 w-full lg:mr-10 xl:mr-16">
                    <h1
                        class="text-ink text-4xl font-light uppercase leading-[1.05] tracking-[-0.045em] sm:text-5xl lg:text-[3.25rem]">
                        {!! $serviceTitle !!}
                    </h1>


                    {{-- Mobile line --}}
                    <div class="mt-8 flex items-center lg:hidden" aria-hidden="true">
                        <span class="bg-primary h-0.5 flex-1"></span>

                        <span class="bg-primary size-2.5 shrink-0 rounded-full"></span>
                    </div>


                    <div
                        class="prose prose-sm text-stone prose-headings:text-ink prose-p:my-0 prose-p:mb-7 prose-p:text-sm prose-p:leading-6 prose-p:text-stone sm:prose-p:text-base sm:prose-p:leading-7 mt-10 max-w-none">
                        {!! wp_kses_post($serviceDescription) !!}
                    </div>
                </div>
            </div>


            {{--
            |--------------------------------------------------------------------------
            | Service image
            |--------------------------------------------------------------------------
            --}}

            <div class="min-h-105 bg-off-white lg:min-h-172 relative overflow-hidden">
                @if ($serviceImage)
                    <img src="{{ is_array($serviceImage) ? $serviceImage['url'] : $serviceImage }}"
                        alt="{{ is_array($serviceImage) ? $serviceImage['alt'] ?? $serviceTitle : $serviceTitle }}"
                        class="absolute inset-0 size-full object-cover">
                @endif


                {{-- Optional soft image overlay --}}
                <div class="absolute inset-0 bg-black/5" aria-hidden="true"></div>


                {{-- Gallery button --}}
                <a href="{{ $galleryUrl }}"
                    class="text-ink hover:bg-primary hover:text-ink focus-visible:outline-primary absolute left-1/2 top-1/2 z-10 inline-flex h-14 min-w-36 -translate-x-1/2 -translate-y-1/2 items-center justify-center bg-white px-8 text-xs font-medium uppercase tracking-[0.02em] transition duration-300 focus-visible:outline-2 focus-visible:outline-offset-4">
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
        <div class="max-w-250 mx-auto grid gap-10 px-6 sm:px-8 lg:grid-cols-[200px_minmax(0,1fr)] lg:gap-12 lg:px-0">
            {{-- FAQ introduction --}}
            <div>
                <h2 class="text-ink text-4xl font-light uppercase leading-none tracking-[-0.04em] sm:text-5xl">
                    {{ $faqTitle }}
                </h2>

                <p class="max-w-45 text-accent mt-5 text-sm/6 font-light">
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
                                class="text-ink hover:text-accent focus-visible:outline-primary flex min-h-12 w-full items-center justify-between gap-6 bg-white px-7 py-4 text-left text-sm font-normal shadow-[0_2px_12px_rgba(0,0,0,0.08)] transition-colors duration-300 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2"
                                aria-expanded="{{ $isOpen ? 'true' : 'false' }}" aria-controls="{{ $panelId }}"
                                data-faq-trigger>
                                <span>
                                    {{ $faq['question'] ?? '' }}
                                </span>
                            </button>
                        </h3>

                        <div id="{{ $panelId }}" role="region" aria-labelledby="{{ $buttonId }}"
                            class="{{ $isOpen ? '' : 'hidden' }}" data-faq-panel>
                            <div class="text-stone px-7 py-5 text-sm/6">
                                {!! wp_kses_post(wpautop($faq['answer'] ?? '')) !!}
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
