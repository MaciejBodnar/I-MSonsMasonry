@php
    $phone = get_field('contact_phone', 'option') ?: '0700 0000 000';

    $email = get_field('contact_email', 'option') ?: 'info@yourdomain.com';

    $facebookUrl = get_field('facebook_url', 'option') ?: '#';
    $tiktokUrl = get_field('tiktok_url', 'option') ?: '#';
    $googleUrl = get_field('google_url', 'option') ?: '#';

    $footerServices = [
        [
            'title' => 'House Extension',
            'url' => home_url('/services/house-extension/'),
        ],
        [
            'title' => 'Roof Construction',
            'url' => home_url('/services/roof-construction/'),
        ],
        [
            'title' => 'Summer House',
            'url' => home_url('/services/summer-house/'),
        ],
        [
            'title' => 'Masonry & Bricklaying',
            'url' => home_url('/services/masonry-bricklaying/'),
        ],
        [
            'title' => 'Loft Conversion',
            'url' => home_url('/services/loft-conversion/'),
        ],
        [
            'title' => 'House Refurbishment',
            'url' => home_url('/services/house-refurbishment/'),
        ],
        [
            'title' => 'Garden Construction',
            'url' => home_url('/services/garden-construction/'),
        ],
        [
            'title' => 'Joinery',
            'url' => home_url('/services/joinery/'),
        ],
        [
            'title' => 'New Homes',
            'url' => home_url('/services/new-homes/'),
        ],
        [
            'title' => 'Painting & Decorating',
            'url' => home_url('/services/painting-decorating/'),
        ],
        [
            'title' => 'Driveways',
            'url' => home_url('/services/driveways/'),
        ],
        [
            'title' => 'Bathrooms',
            'url' => home_url('/services/bathrooms/'),
        ],
    ];
@endphp

<footer class="bg-black text-white">
    <div
        class="max-w-288 py-18 mx-auto grid gap-14 px-6 sm:px-8 sm:py-20 lg:grid-cols-[280px_80px_minmax(0,1fr)] lg:items-center lg:gap-16 lg:px-12 xl:px-0">
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
                            I&amp;M Sons
                        </div>

                        <div class="text-accent mt-1 text-xl uppercase">
                            Masonry
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

                <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                    class="bg-primary hover:bg-accent flex size-11 items-center justify-center rounded-full font-semibold text-black transition hover:text-white">
                    f
                </a>

                <span class="w-0.75 bg-primary h-3"></span>

                <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"
                    class="bg-primary hover:bg-accent flex size-11 items-center justify-center rounded-full font-semibold text-black transition hover:text-white">
                    ♪
                </a>

                <span class="w-0.75 bg-primary h-3"></span>

                <a href="{{ $googleUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Google"
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
            class="max-w-288 mx-auto flex flex-col gap-4 px-6 py-6 text-sm text-white sm:px-8 lg:flex-row lg:items-center lg:justify-between lg:px-12 xl:px-0">
            <p>
                Contact us:

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
                    ©{{ date('Y') }} I&amp;M Sons Masonry
                </span>

                <span>- D&amp;C with</span>

                <a href="#" class="inline-flex items-center gap-1 transition-colors hover:text-black">
                    <span
                        class="border-primary text-primary inline-flex size-4 items-center justify-center border text-[10px]">
                        ?
                    </span>

                    SLT Media
                </a>
            </p>
        </div>
    </div>
</footer>
