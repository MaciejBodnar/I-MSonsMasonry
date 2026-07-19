@php
    $brandPrimary = im_sons_header_footer_setting('footer_brand_primary', 'I&M Sons');
    $brandSecondary = im_sons_header_footer_setting('footer_brand_secondary', 'Masonry');
    $contactLabel = im_sons_header_footer_setting('footer_contact_label', __('Contact us:', 'im-sons'));
    $phone = im_sons_header_footer_setting('footer_phone', '0700 0000 000');
    $email = im_sons_header_footer_setting('footer_email', 'info@yourdomain.com');
    $socialLinks = im_sons_header_footer_social_links();
    $footerServices = im_sons_header_footer_services();
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
                @if (has_custom_logo())
                    <div class="[&_img]:h-auto [&_img]:w-64 [&_img]:max-w-full">
                        {!! get_custom_logo() !!}
                    </div>
                @else
                    <div class="text-center">
                        <div class="text-primary text-4xl font-semibold uppercase">
                            {{ $brandPrimary }}
                        </div>

                        <div class="text-accent mt-1 text-xl uppercase">
                            {{ $brandSecondary }}
                        </div>
                    </div>
                @endif
            </a>
        </div>

        {{-- Social line --}}
        <div class="flex justify-center">
            <div class="flex flex-col items-center">
                <span class="bg-primary size-3 rounded-full"></span>

                <span class="w-0.75 bg-primary h-8"></span>

                <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                    class="bg-primary hover:bg-accent flex size-11 items-center justify-center rounded-full font-semibold text-black transition hover:text-white">
                    f
                </a>

                <span class="w-0.75 bg-primary h-3"></span>

                <a href="{{ $socialLinks['tiktok'] }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"
                    class="bg-primary hover:bg-accent flex size-11 items-center justify-center rounded-full font-semibold text-black transition hover:text-white">
                    ♪
                </a>

                <span class="w-0.75 bg-primary h-3"></span>

                <a href="{{ $socialLinks['google'] }}" target="_blank" rel="noopener noreferrer" aria-label="Google"
                    class="bg-primary hover:bg-accent flex size-11 items-center justify-center rounded-full font-semibold text-black transition hover:text-white">
                    G
                </a>

                <span class="w-0.75 bg-primary h-8"></span>

                <span class="bg-primary size-3 rounded-full"></span>
            </div>
        </div>

        {{-- Service links --}}
        <nav aria-label="{{ __('Footer services', 'im-sons') }}">
            <ul class="grid gap-x-8 sm:grid-cols-2">
                @foreach ($footerServices as $service)
                    <li class="border-b border-white/20">
                        <a href="{{ $service['url'] }}"
                            class="hover:text-primary focus-visible:outline-offset-3 focus-visible:outline-primary block py-3 text-sm text-white/65 transition-colors focus-visible:outline-2">
                            {{ $service['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    {{-- Bottom bar --}}
    <div class="bg-linear-to-r from-primary to-accent">
        <div
            class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-6 text-sm text-white sm:px-8 lg:flex-row lg:items-center lg:justify-between lg:px-12 xl:px-0">
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

                <a href="{{ $creditUrl }}"
                    class="inline-flex items-center gap-1 transition-colors hover:text-black">
                    <span
                        class="border-primary text-primary inline-flex size-4 items-center justify-center border text-[10px]">
                        ?
                    </span>

                    {{ $creditLinkText }}
                </a>
            </p>
        </div>
    </div>
</footer>
