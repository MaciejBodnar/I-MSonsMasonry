@php
    $phone = get_field('contact_phone', 'option') ?: '0700 0000 000';

    $email = get_field('contact_email', 'option') ?: 'info@yourdomain.com';
@endphp

<header class="
        relative
        z-40
        border-b
        border-black/5
        bg-white
    ">
    <div
        class="
            mx-auto
            flex
            h-22
            max-w-384
            items-center
            justify-between
            gap-8
            px-6

            sm:px-8
            lg:px-12
            xl:px-16
        ">
        {{-- Logo --}}
        <a href="{{ home_url('/') }}" class="shrink-0" aria-label="{{ get_bloginfo('name') }} home">
            @if (has_custom_logo())
                <div class="[&_img]:h-auto [&_img]:w-42">
                    {!! get_custom_logo() !!}
                </div>
            @else
                <span class="text-2xl font-semibold text-primary uppercase">
                    I&amp;M Sons
                </span>

                <span class="block text-center text-sm text-accent uppercase">
                    Masonry
                </span>
            @endif
        </a>

        {{-- Contact text --}}
        <div class="hidden min-w-0 flex-1 text-sm text-black/40 lg:block">
            Contact us:

            <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}"
                class="font-semibold text-primary transition-colors hover:text-accent">
                {{ $phone }}
            </a>

            <span>or</span>

            <a href="mailto:{{ $email }}" class="font-semibold text-primary transition-colors hover:text-accent">
                {{ $email }}
            </a>
        </div>

        {{-- Desktop menu --}}
        <nav class="hidden lg:block" aria-label="{{ __('Primary navigation', 'im-sons') }}">
            {!! wp_nav_menu([
                'theme_location' => 'primary_navigation',
                'container' => false,
                'menu_class' => 'primary-menu flex items-center gap-10',
                'fallback_cb' => 'im_sons_default_primary_menu',
                'echo' => false,
                'depth' => 1,
            ]) !!}
        </nav>

        {{-- Mobile menu button --}}
        <button type="button"
            class="
                flex
                size-11
                items-center
                justify-center
                text-ink
                lg:hidden
            "
            aria-label="Open navigation" aria-expanded="false" aria-controls="mobile-navigation"
            data-mobile-menu-button>
            <svg viewBox="0 0 24 24" class="size-7" fill="none" aria-hidden="true">
                <path d="M4 7H20M4 12H20M4 17H20" stroke="currentColor" stroke-width="1.75" />
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-navigation"
        class="
            hidden
            border-t
            border-black/5
            bg-white
            px-6
            py-6
            lg:hidden
        "
        data-mobile-menu>
        <nav aria-label="{{ __('Mobile navigation', 'im-sons') }}">
            {!! wp_nav_menu([
                'theme_location' => 'primary_navigation',
                'container' => false,
                'menu_class' => 'mobile-menu flex flex-col',
                'fallback_cb' => 'im_sons_default_primary_menu',
                'echo' => false,
                'depth' => 1,
            ]) !!}
        </nav>
    </div>
</header>
