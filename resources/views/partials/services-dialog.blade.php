@php
    $services = [
        [
            'title' => 'House Extensions',
            'description' => 'Create more space for your family.',
            'url' => home_url('/services/house-extensions/'),
        ],
        [
            'title' => 'Roof Construction',
            'description' => 'New roofs, repairs and full replacements.',
            'url' => home_url('/services/roof-construction/'),
        ],
        [
            'title' => 'Summer Houses',
            'description' => 'Garden offices and additional living spaces.',
            'url' => home_url('/services/summer-houses/'),
        ],
        [
            'title' => 'Masonry & Bricklaying',
            'description' => 'Specialist brickwork and structural construction.',
            'url' => home_url('/services/masonry-bricklaying/'),
        ],
        [
            'title' => 'Loft Conversions',
            'description' => 'Transform unused roof space.',
            'url' => home_url('/services/loft-conversions/'),
        ],
        [
            'title' => 'House Refurbishments',
            'description' => 'Individual rooms and complete renovations.',
            'url' => home_url('/services/house-refurbishments/'),
        ],
    ];
@endphp

<dialog id="services-dialog"
    class="
        m-auto
        max-h-[calc(100dvh-2rem)]
        w-[calc(100%-2rem)]
        max-w-300
        overflow-y-auto
        bg-white
        p-0
        text-ink
        shadow-2xl

        backdrop:bg-black/60
        backdrop:backdrop-blur-xs
    "
    data-services-dialog>
    <div>
        <div
            class="
                flex
                items-center
                justify-between
                border-b
                border-black/10
                px-6
                py-5

                sm:px-8
                lg:px-12
            ">
            <div>
                <p
                    class="
                        text-xs
                        font-medium
                        tracking-[0.08em]
                        text-primary
                        uppercase
                    ">
                    I&amp;M Sons Masonry
                </p>

                <h2
                    class="
                        mt-1
                        text-3xl
                        font-light
                        tracking-[-0.04em]
                        uppercase
                    ">
                    Our Services
                </h2>
            </div>

            <button type="button"
                class="
                    flex
                    size-11
                    items-center
                    justify-center
                    border
                    border-black/10
                    transition-colors

                    hover:border-primary
                    hover:bg-primary
                "
                aria-label="Close services" data-services-dialog-close>
                <svg viewBox="0 0 24 24" class="size-6" fill="none" aria-hidden="true">
                    <path d="M5 5L19 19M19 5L5 19" stroke="currentColor" stroke-width="1.75" />
                </svg>
            </button>
        </div>

        <div
            class="
                grid
                gap-px
                bg-black/10

                sm:grid-cols-2
                lg:grid-cols-3
            ">
            @foreach ($services as $service)
                <a href="{{ $service['url'] }}"
                    class="
                        group
                        flex
                        min-h-48
                        flex-col
                        justify-between
                        bg-white
                        p-7
                        transition-colors

                        hover:bg-primary

                        focus-visible:relative
                        focus-visible:z-10
                        focus-visible:outline-2
                        focus-visible:outline-primary
                        focus-visible:outline-offset-[-2px]
                    ">
                    <h3
                        class="
                            max-w-48
                            text-xl/[1.15]
                            font-normal
                            uppercase
                        ">
                        {{ $service['title'] }}
                    </h3>

                    <div>
                        <p
                            class="
                                max-w-60
                                text-sm/6
                                text-black/55
                            ">
                            {{ $service['description'] }}
                        </p>

                        <span
                            class="
                                mt-5
                                inline-flex
                                items-center
                                gap-2
                                text-xs
                                font-medium
                                uppercase
                            ">
                            View service

                            <span
                                class="
                                    transition-transform
                                    group-hover:translate-x-1
                                ">
                                →
                            </span>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</dialog>
