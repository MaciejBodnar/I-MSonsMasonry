@extends('layouts.app')

@section('content')
    @php
        $privacyTitle = get_field('privacy_title') ?: get_the_title() ?: 'Privacy Policy';

        $privacyContent = get_field('privacy_content') ?: apply_filters('the_content', get_the_content());

        $lastUpdated = get_field('privacy_last_updated') ?: get_the_modified_date('j F Y');

        /*
        |--------------------------------------------------------------------------
        | Fallback content
        |--------------------------------------------------------------------------
        |
        | This appears only when the WordPress page editor and ACF field are empty.
        |
        */

        if (trim(wp_strip_all_tags($privacyContent)) === '') {
            $privacyContent = '
                <h2>Who we are</h2>

                <p>
                    I&M Sons Masonry Ltd provides residential building and
                    construction services. This privacy policy explains how we
                    collect, use and protect personal information submitted through
                    this website.
                </p>

                <h2>Information we collect</h2>

                <p>
                    We may collect personal information when you contact us,
                    request a quotation or submit an enquiry through our website.
                    This may include:
                </p>

                <ul>
                    <li>Your name</li>
                    <li>Your email address</li>
                    <li>Your telephone number</li>
                    <li>Your address or project location</li>
                    <li>Information about your proposed building project</li>
                    <li>Any other details you choose to provide</li>
                </ul>

                <h2>How we use your information</h2>

                <p>
                    We use your personal information to respond to enquiries,
                    prepare quotations, arrange consultations, manage projects
                    and communicate with you about our services.
                </p>

                <p>
                    We will not sell your personal information or use it for
                    unrelated marketing purposes without your permission.
                </p>

                <h2>Contact forms</h2>

                <p>
                    When you submit a contact form, the information you provide
                    may be stored in our website system and sent to us by email.
                    We use this information only to respond to your enquiry and
                    establish contact with you.
                </p>

                <h2>Cookies</h2>

                <p>
                    This website may use essential cookies required for the
                    website to function correctly. Additional cookies may be used
                    for analytics or embedded third-party services where enabled.
                </p>

                <h2>How long we retain your information</h2>

                <p>
                    We retain personal information only for as long as reasonably
                    necessary to respond to enquiries, provide our services,
                    maintain business records and meet legal obligations.
                </p>

                <h2>Sharing your information</h2>

                <p>
                    We may share information with trusted service providers where
                    necessary to operate our website or deliver our services.
                    We may also disclose information where required by law.
                </p>

                <h2>Keeping your information secure</h2>

                <p>
                    We take reasonable technical and organisational measures to
                    protect personal information against unauthorised access,
                    loss, misuse or disclosure.
                </p>

                <h2>Your rights</h2>

                <p>
                    Depending on the applicable data protection law, you may have
                    the right to request access to your personal information,
                    ask for inaccurate information to be corrected, request
                    deletion, restrict processing or object to certain uses.
                </p>

                <h2>Third-party links</h2>

                <p>
                    Our website may contain links to third-party websites. We are
                    not responsible for the privacy practices or content of those
                    websites.
                </p>

                <h2>Changes to this policy</h2>

                <p>
                    We may update this privacy policy occasionally. Any changes
                    will be published on this page together with an updated
                    revision date.
                </p>

                <h2>Contact us</h2>

                <p>
                    For questions about this privacy policy or the personal
                    information we hold, please contact us using the details shown
                    on our contact page.
                </p>
            ';
        }
    @endphp

    <section
        class="
            relative
            overflow-hidden
            bg-white
            py-20

            sm:py-24
            lg:py-28
        ">
        {{-- Yellow line from the viewport edge --}}
        <div class="
                pointer-events-none
                absolute
                top-42
                left-0
                z-10
                hidden
                w-[calc(50%-24rem)]
                items-center

                lg:flex
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
                mx-auto
                grid
                max-w-250
                gap-12
                px-6

                sm:px-8

                lg:grid-cols-[220px_minmax(0,1fr)]
                lg:gap-18
                lg:px-12

                xl:px-0
            ">
            {{-- Page heading --}}
            <header>
                <h1
                    class="
                        text-4xl
                        leading-[1.05]
                        font-light
                        tracking-[-0.045em]
                        text-ink
                        uppercase

                        sm:text-5xl
                    ">
                    {{ $privacyTitle }}
                </h1>

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

                @if ($lastUpdated)
                    <p
                        class="
                            mt-6
                            text-xs
                            tracking-[0.04em]
                            text-accent
                            uppercase
                        ">
                        Last updated: {{ $lastUpdated }}
                    </p>
                @endif
            </header>

            {{-- Privacy content --}}
            <article
                class="
                    max-w-170
                    text-sm/7
                    text-stone

                    [&_a]:text-accent
                    [&_a]:underline
                    [&_a]:underline-offset-4
                    [&_a]:transition-colors
                    hover:[&_a]:text-primary

                    [&_h2]:mt-12
                    [&_h2]:mb-4
                    [&_h2]:text-2xl
                    [&_h2]:leading-tight
                    [&_h2]:font-light
                    [&_h2]:tracking-[-0.03em]
                    [&_h2]:text-ink
                    [&_h2]:uppercase

                    [&_h2:first-child]:mt-0

                    [&_h3]:mt-8
                    [&_h3]:mb-3
                    [&_h3]:text-lg
                    [&_h3]:font-medium
                    [&_h3]:text-ink

                    [&_p]:mb-5

                    [&_ul]:mb-6
                    [&_ul]:list-disc
                    [&_ul]:space-y-2
                    [&_ul]:pl-5

                    [&_ol]:mb-6
                    [&_ol]:list-decimal
                    [&_ol]:space-y-2
                    [&_ol]:pl-5

                    sm:text-base/7
                ">
                {!! wp_kses_post($privacyContent) !!}
            </article>
        </div>
    </section>
@endsection
