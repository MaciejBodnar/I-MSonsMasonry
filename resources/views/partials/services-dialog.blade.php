@php
    $dialog = im_sons_primary_navigation_dialog_context();

    if (empty($dialog['items'])) {
        $dialog = [
            'id' => 'services-dialog',
            'title' => 'Services',
            'items' => [
                [
                    'title' => 'House Extension',
                    'url' => home_url('/services/house-extension/'),
                    'description' => 'Create more space for your family.',
                ],
                [
                    'title' => 'Roof Construction',
                    'url' => home_url('/services/roof-construction/'),
                    'description' => 'New roofs, repairs and replacements.',
                ],
                [
                    'title' => 'Summer House',
                    'url' => home_url('/services/summer-house/'),
                    'description' => 'Garden offices and additional living spaces.',
                ],
                [
                    'title' => 'Masonry & Bricklaying',
                    'url' => home_url('/services/masonry-bricklaying/'),
                    'description' => 'Specialist brickwork and structural services.',
                ],
                [
                    'title' => 'Loft Conversion',
                    'url' => home_url('/services/loft-conversion/'),
                    'description' => 'Transform unused roof space.',
                ],
                [
                    'title' => 'House Refurbishment',
                    'url' => home_url('/services/house-refurbishment/'),
                    'description' => 'Room and complete property renovations.',
                ],
            ],
        ];
    }
@endphp

@if (!empty($dialog['items']))
    <dialog id="{{ $dialog['id'] }}"
        class="max-w-300 text-ink backdrop:backdrop-blur-xs m-auto max-h-[calc(100dvh-2rem)] w-[calc(100%-2rem)] overflow-y-auto bg-white p-0 shadow-2xl backdrop:bg-black/60"
        data-services-dialog>
        <div>
            <div class="flex items-center justify-between border-b border-black/10 px-6 py-5 sm:px-8 lg:px-12">
                <div>
                    <p class="text-primary font1-medium text-xs uppercase tracking-[0.08em]">
                        {{ __('Our Services', 'im-sons') }}
                    </p>

                    <h2 class="font1-light mt-1 text-3xl uppercase tracking-[-0.04em]">
                        {{ $dialog['title'] }}
                    </h2>
                </div>

                <button type="button"
                    class="hover:border-primary hover:bg-primary flex size-11 items-center justify-center border border-black/10 transition-colors"
                    aria-label="Close services" data-services-dialog-close>
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" aria-hidden="true">
                        <path d="M5 5L19 19M19 5L5 19" stroke="currentColor" stroke-width="1.75" />
                    </svg>
                </button>
            </div>

            <div class="grid gap-px bg-black/10 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($dialog['items'] as $service)
                    <a href="{{ $service['url'] }}"
                        class="hover:bg-primary focus-visible:outline-primary group flex min-h-48 flex-col justify-between bg-white p-7 transition-colors focus-visible:relative focus-visible:z-10 focus-visible:outline-2 focus-visible:-outline-offset-2">
                        <h3 class="font1-normal max-w-48 text-xl/[1.15] uppercase">
                            {{ $service['title'] }}
                        </h3>

                        <div>
                            @if (!empty($service['description']))
                                <p class="max-w-60 text-lg/6 text-black/55">
                                    {{ $service['description'] }}
                                </p>
                            @endif

                            <span class="font1-medium mt-5 inline-flex items-center gap-2 text-xs uppercase">
                                View service

                                <span class="transition-transform group-hover:translate-x-1">
                                    →
                                </span>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </dialog>
@endif
