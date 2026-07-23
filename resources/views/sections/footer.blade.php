@php
    $brandPrimary = im_sons_header_footer_setting('footer_brand_primary', 'I&M Sons');
    $brandSecondary = im_sons_header_footer_setting('footer_brand_secondary', 'Masonry');
    $contactLabel = im_sons_header_footer_setting('footer_contact_label', __('Contact us:', 'im-sons'));
    $phone = im_sons_header_footer_setting('footer_phone', '0700 0000 000');
    $email = im_sons_header_footer_setting('footer_email', 'info@yourdomain.com');
    $socialLinks = im_sons_footer_social_links();
    $footerLinks = im_sons_footer_page_links();
    $copyrightName = im_sons_header_footer_setting('footer_copyright_name', 'I&M Sons Masonry');
    $creditPrefix = im_sons_header_footer_setting('footer_credit_text', 'D&C with');
    $creditLinkText = im_sons_header_footer_setting('footer_credit_link_text', 'SLT Media');
    $creditUrl = im_sons_header_footer_setting('footer_credit_url', '#');
@endphp

<footer class="bg-black text-white">
    <div
        class="py-18 mx-auto grid max-w-6xl gap-14 px-6 sm:px-8 sm:py-20 lg:grid-cols-[280px_80px_minmax(0,1fr)] lg:items-center lg:gap-16 lg:px-12 xl:px-0">
        {{-- Logo --}}
        <div class="flex justify-center lg:justify-start">
            <a href="{{ home_url('/') }}" class="block" aria-label="{{ get_bloginfo('name') }} home">
                <img src="{{ get_template_directory_uri() }}/resources/images/footer-logo.svg" alt="logo"
                    class="h-50 w-auto" />
            </a>
        </div>

        {{-- Social line --}}
        <div class="flex justify-center">
            {{-- Mobile horizontal socials --}}
            <div class="max-w-88 relative mx-auto flex w-full items-center justify-center py-4 lg:hidden">
                {{-- Line with endpoint dots --}}
                <div class="bg-primary pointer-events-none absolute left-0 top-1/2 h-1 w-full -translate-y-1/2"
                    aria-hidden="true">
                    <span
                        class="bg-primary absolute left-0 top-1/2 size-6 -translate-x-1/2 -translate-y-1/2 rounded-full"></span>

                    <span
                        class="bg-primary absolute right-0 top-1/2 size-6 -translate-y-1/2 translate-x-1/2 rounded-full"></span>
                </div>

                {{-- Social icons --}}
                <div class="relative z-10 flex items-center gap-4">
                    @foreach ($socialLinks as $socialLink)
                        <a href="{{ $socialLink['url'] }}" target="_blank" rel="noopener noreferrer"
                            aria-label="{{ $socialLink['label'] }}"
                            class="bg-primary hover:bg-accent flex size-16 items-center justify-center rounded-full text-3xl text-black transition hover:text-white">
                            {!! $socialLink['icon_class'] !!}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="hidden flex-col items-center lg:flex">
                <span class="bg-primary size-3 rounded-full"></span>

                <span class="w-0.75 bg-primary h-8"></span>

                @foreach ($socialLinks as $socialLink)
                    <a href="{{ $socialLink['url'] }}" target="_blank" rel="noopener noreferrer"
                        aria-label="{{ $socialLink['label'] }}"
                        class="bg-primary hover:bg-accent flex size-11 items-center justify-center rounded-full text-lg text-black transition hover:text-white">
                        {!! $socialLink['icon_class'] !!}
                    </a>

                    @if (!$loop->last)
                        <span class="w-0.75 bg-primary h-3"></span>
                    @endif
                @endforeach

                <span class="w-0.75 bg-primary h-8"></span>

                <span class="bg-primary size-3 rounded-full"></span>
            </div>
        </div>

        {{-- Page links --}}
        <nav aria-label="{{ __('Footer links', 'im-sons') }}">
            <ul class="grid gap-x-8 sm:grid-cols-2">
                @foreach ($footerLinks as $link)
                    <li class="border-b border-white/20">
                        <a href="{{ $link['url'] }}"
                            class="hover:text-primary focus-visible:outline-offset-3 focus-visible:outline-primary block py-3 text-lg text-white/65 transition-colors focus-visible:outline-2">
                            {{ $link['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    {{-- Bottom bar --}}
    <div class="bg-accent">
        <div
            class="mx-auto flex max-w-6xl flex-col items-center gap-4 px-6 py-6 text-lg text-white sm:px-8 lg:flex-row lg:justify-between lg:px-12 xl:px-0">
            <p>
                {{ $contactLabel }}

                <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-primary font-semibold">
                    {{ $phone }}
                </a>

                <span>or</span>

                <a href="mailto:{{ $email }}" class="text-primary font-semibold">
                    {{ $email }}
                </a>
            </p>

            <p class="text-white/90">
                <a href="{{ get_privacy_policy_url() ?: home_url('/privacy-policy/') }}"
                    class="transition-colors hover:text-black">
                    Privacy Policy
                </a>

                <span>|</span>

                <span>
                    ©{{ date('Y') }} {{ $copyrightName }}
                </span>

                <span>- {{ $creditPrefix }}</span>

                <a href="{{ $creditUrl }} " target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-1 transition-colors hover:text-black">
                    <span class="text-primary">
                        <i class="fa-solid fa-heart" aria-hidden="true"></i>
                    </span>

                    {{ $creditLinkText }}
                </a>
            </p>
        </div>
    </div>
</footer>
