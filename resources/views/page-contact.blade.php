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

        $socialLinks = im_sons_normalize_social_links(get_field('contact_social_links') ?: []);

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


    <section class="lg:min-h-180 relative overflow-hidden bg-white py-20 sm:py-24 lg:py-28">
        <div class="max-w-250 mx-auto w-full px-6 sm:px-10 lg:px-12 xl:px-0">
            <h1 class="text-ink text-5xl font-light uppercase leading-none tracking-[-0.04em] sm:text-6xl">
                {{ $contactTitle }}
            </h1>


            <div
                class="mt-16 grid gap-16 lg:grid-cols-[250px_minmax(0,1fr)] lg:gap-20 xl:grid-cols-[270px_minmax(0,1fr)] xl:gap-24">
                {{--
                |--------------------------------------------------------------------------
                | Contact details
                |--------------------------------------------------------------------------
                --}}

                <aside class="relative">
                    <div class="text-stone text-lg/8">
                        <a href="tel:{{ preg_replace('/\s+/', '', $contactPhone) }}"
                            class="hover:text-accent block transition-colors duration-300">
                            {{ $contactPhone }}
                        </a>

                        <a href="mailto:{{ $contactEmail }}" class="hover:text-accent block transition-colors duration-300">
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

                    <div class="lg:mt-18 relative mt-14 flex items-center">
                        <span class="h-0.75 bg-primary absolute right-full top-1/2 w-screen -translate-y-1/2"
                            aria-hidden="true"></span>

                        <span class="h-0.75 bg-primary absolute left-0 top-1/2 w-full -translate-y-1/2"
                            aria-hidden="true"></span>

                        <div class="relative z-10 flex items-center gap-2">
                            @foreach ($socialLinks as $socialLink)
                                <a href="{{ $socialLink['url'] }}" target="_blank" rel="noopener noreferrer"
                                    aria-label="{{ $socialLink['label'] }}"
                                    class="bg-primary text-ink hover:bg-accent focus-visible:outline-offset-3 focus-visible:outline-primary flex size-9 items-center justify-center rounded-full text-base transition duration-300 hover:scale-110 hover:text-white focus-visible:outline-2">
                                    {!! $socialLink['icon_class'] !!}
                                </a>
                            @endforeach
                        </div>

                        <span class="bg-primary relative z-10 ml-auto size-3 shrink-0 rounded-full"
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
