@props([
    'brand' => 'PT Gumarang Indo Express',
    'tagline' => 'Solusi Pengiriman Anda',
    'links' => [],
    'contactBlocks' => [],
    'ctaLabel' => 'Cek Tarif',
    'ctaHref' => url('/#pricing')
])

@php
    $defaultLinks = [
        ['label' => 'Home', 'href' => url('/#hero')],
        ['label' => 'Tentang Kami', 'href' => url('/#why-us')],
        ['label' => 'Layanan', 'href' => url('/#services')],
        ['label' => 'Tarif', 'href' => url('/#pricing')],
        ['label' => 'Kontak', 'href' => url('/#contact')],
    ];

    $defaultContacts = [
        [
            'label' => 'Jam Operasional',
            'value' => "Senin - Jumat\n08.00 - 17.00",
            'icon' => asset('images/home/clock.svg'),
        ],
        [
            'label' => 'Alamat Kami',
            'value' => 'Ruko Cendana, Blok A Jl. Benteng Betawi No.26, RT.001/RW.015, Poris Plawad, Kec. Tangerang, Kota Tangerang, Banten 15119',
            'icon' => asset('images/home/location-marker.svg'),
        ],
        [
            'label' => 'Kontak Kami',
            'value' => 'Customer Service 0812-1882-9872',
            'icon' => asset('images/home/phone.svg'),
        ],
    ];

    $navLinks = filled($links) ? $links : $defaultLinks;
    $contacts = filled($contactBlocks) ? $contactBlocks : $defaultContacts;
@endphp

<header x-data="{ open: false }" x-on:keydown.escape.window="open = false" class="relative sticky top-0 z-30 border-b border-gray-100 bg-white/90 backdrop-blur">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-4">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-[#CD2028]">Cargo</p>
                <p class="text-lg font-bold text-gray-900">{{ $brand }}</p>
                <p class="text-sm text-gray-500">{{ $tagline }}</p>
            </div>
            <div class="hidden flex-1 items-center justify-end gap-6 text-left text-sm text-gray-600 md:flex">
                @foreach ($contacts as $contact)
                    <div class="flex max-w-xs items-start gap-2">
                        @if ($contact['icon'] ?? false)
                            <img src="{{ $contact['icon'] }}" alt="{{ $contact['label'] }}" class="h-6 w-6 flex-shrink-0">
                        @endif
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $contact['label'] }}</p>
                            <p class="text-sm font-semibold text-gray-900 leading-relaxed">
                                {!! nl2br(e($contact['value'])) !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ $ctaHref }}" class="hidden rounded-full bg-[#CD2028] px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b81c22] md:inline-flex">{{ $ctaLabel }}</a>
                <button type="button" class="inline-flex items-center justify-center rounded-full border border-gray-200 p-2 text-gray-900 transition hover:border-[#CD2028] hover:text-[#CD2028] md:hidden" aria-label="Toggle menu" x-on:click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <nav class="hidden border-t border-gray-100 bg-white md:block">
        <div class="mx-auto max-w-6xl px-4">
            <ul class="flex items-center gap-6 py-3 text-sm font-semibold text-gray-700">
                @foreach ($navLinks as $link)
                    <li>
                        <a href="{{ $link['href'] }}" class="transition hover:text-[#CD2028]">{{ $link['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-20 bg-gray-900/30 backdrop-blur-sm md:hidden" x-on:click="open = false"></div>

    <div x-cloak x-show="open" x-transition x-on:click.outside="open = false" class="absolute inset-x-0 top-full z-30 mt-3 px-4 md:hidden">
        <nav class="rounded-3xl border border-[#CD2028]/20 bg-white px-6 py-5 shadow-2xl shadow-gray-900/10">
            <ul class="space-y-3 text-base font-semibold text-gray-900">
                @foreach ($navLinks as $link)
                    <li>
                        <a href="{{ $link['href'] }}" class="flex items-center justify-between rounded-2xl border border-transparent px-3 py-2 transition hover:border-gray-200 hover:bg-gray-50" x-on:click="open = false">
                            <span>{{ $link['label'] }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ $ctaHref }}" class="mt-5 inline-flex w-full items-center justify-center rounded-2xl bg-[#CD2028] px-4 py-3 text-base font-semibold text-white shadow-lg shadow-[#cd2028]/20" x-on:click="open = false">{{ $ctaLabel }}</a>
        </nav>
    </div>
</header>
