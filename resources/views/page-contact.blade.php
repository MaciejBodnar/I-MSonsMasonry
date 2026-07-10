{{--
  Template Name: Contact
--}}

@extends('layouts.app')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | Contact content
        |--------------------------------------------------------------------------
        */

        $contactTitle = get_field('contact_title') ?: 'Contact';

        $contactPhone = get_field('contact_phone') ?: '07000 0000 000';
        $contactEmail = get_field('contact_email') ?: 'info@yourdomain.com';
        $contactAddress = get_field('contact_address') ?: '123 Street Road, City,';
        $contactPostcode = get_field('contact_postcode') ?: 'POST CODE';

        $facebookUrl = get_field('facebook_url') ?: '#';
        $tiktokUrl = get_field('tiktok_url') ?: '#';
        $googleUrl = get_field('google_url') ?: '#';

        /*
        |--------------------------------------------------------------------------
        | Contact Form 7
        |--------------------------------------------------------------------------
        |
        | Replace 123 with your actual CF7 form ID.
        |
        */

        $contactFormShortcode = get_field('contact_form_shortcode') ?: '[contact-form-7 id="98d3aa4" title="Contact"]';
    @endphp


    <section
        class="
            relative
            overflow-hidden
            bg-white
            py-20

            sm:py-24
            lg:min-h-180
            lg:py-28
        ">
        <div
            class="
                mx-auto
                w-full
                max-w-250
                px-6

                sm:px-10
                lg:px-12
                xl:px-0
            ">
            <h1
                class="
                    text-5xl
                    leading-none
                    font-light
                    tracking-[-0.04em]
                    text-ink
                    uppercase

                    sm:text-6xl
                ">
                {{ $contactTitle }}
            </h1>


            <div
                class="
                    mt-16
                    grid
                    gap-16

                    lg:grid-cols-[250px_minmax(0,1fr)]
                    lg:gap-20

                    xl:grid-cols-[270px_minmax(0,1fr)]
                    xl:gap-24
                ">
                {{--
                |--------------------------------------------------------------------------
                | Contact details
                |--------------------------------------------------------------------------
                --}}

                <aside class="relative">
                    <div
                        class="
                            text-lg/8
                            text-stone
                        ">
                        <a href="tel:{{ preg_replace('/\s+/', '', $contactPhone) }}"
                            class="
                                block
                                transition-colors
                                duration-300

                                hover:text-accent
                            ">
                            {{ $contactPhone }}
                        </a>

                        <a href="mailto:{{ $contactEmail }}"
                            class="
                                block
                                transition-colors
                                duration-300

                                hover:text-accent
                            ">
                            {{ $contactEmail }}
                        </a>

                        <address class="mt-1 not-italic">
                            {{ $contactAddress }}<br>
                            {{ $contactPostcode }}
                        </address>
                    </div>


                    {{--
                    |--------------------------------------------------------------------------
                    | Social line
                    |--------------------------------------------------------------------------
                    --}}

                    <div
                        class="
                            relative
                            mt-14
                            flex
                            items-center

                            lg:mt-18
                        ">
                        <span
                            class="
                                absolute
                                top-1/2
                                right-full
                                h-0.75
                                w-screen
                                -translate-y-1/2
                                bg-primary
                            "
                            aria-hidden="true"></span>

                        <span
                            class="
                                absolute
                                top-1/2
                                left-0
                                h-0.75
                                w-full
                                -translate-y-1/2
                                bg-primary
                            "
                            aria-hidden="true"></span>

                        <div
                            class="
                                relative
                                z-10
                                flex
                                items-center
                                gap-2
                            ">
                            <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                                class="
                                    flex
                                    size-9
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-primary
                                    text-base
                                    font-semibold
                                    text-ink
                                    transition
                                    duration-300

                                    hover:scale-110
                                    hover:bg-accent
                                    hover:text-white

                                    focus-visible:outline-2
                                    focus-visible:outline-offset-3
                                    focus-visible:outline-primary
                                ">
                                f
                            </a>

                            <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"
                                class="
                                    flex
                                    size-9
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-primary
                                    text-base
                                    font-semibold
                                    text-ink
                                    transition
                                    duration-300

                                    hover:scale-110
                                    hover:bg-accent
                                    hover:text-white

                                    focus-visible:outline-2
                                    focus-visible:outline-offset-3
                                    focus-visible:outline-primary
                                ">
                                ♪
                            </a>

                            <a href="{{ $googleUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Google"
                                class="
                                    flex
                                    size-9
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-primary
                                    text-sm
                                    font-semibold
                                    text-ink
                                    transition
                                    duration-300

                                    hover:scale-110
                                    hover:bg-accent
                                    hover:text-white

                                    focus-visible:outline-2
                                    focus-visible:outline-offset-3
                                    focus-visible:outline-primary
                                ">
                                G
                            </a>
                        </div>

                        <span
                            class="
                                relative
                                z-10
                                ml-auto
                                size-3
                                shrink-0
                                rounded-full
                                bg-primary
                            "
                            aria-hidden="true"></span>
                    </div>
                </aside>


                {{--
                |--------------------------------------------------------------------------
                | Contact Form 7
                |--------------------------------------------------------------------------
                --}}

                <div class="contact-form-wrap min-w-0">
                    {!! do_shortcode($contactFormShortcode) !!}
                </div>
            </div>
        </div>
    </section>
@endsection
