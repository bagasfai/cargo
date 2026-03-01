@props([
    'brand' => 'PT Gumarang Indo Express',
    'tagline' => 'Pengiriman terpercaya ke seluruh Indonesia',
    'contactItems' => [],
    'links' => []
])

@php
    $defaultContact = [
        [
            'label' => 'Head Office',
            'value' => 'Ruko Smart Market Blok F-02 Jl. Daan Mogot KM.19 Batu Ceper Tangerang',
        ],
        [
            'label' => 'Jam Operasional',
            'value' => 'Senin - Jumat 08.00 - 17.00',
        ],
        [
            'label' => 'Kontak',
            'value' => 'Customer Service 081 1152 4260',
        ],
    ];

    $defaultLinks = [
        ['label' => 'Tentang Kami', 'href' => '#why-us'],
        ['label' => 'Layanan', 'href' => '#services'],
        ['label' => 'Tarif', 'href' => '#pricing'],
        ['label' => 'Kontak', 'href' => '#contact'],
    ];

    $contacts = filled($contactItems) ? $contactItems : $defaultContact;
    $footerLinks = filled($links) ? $links : $defaultLinks;
@endphp

<footer class="bg-gray-900 text-gray-200">
    <div class="mx-auto max-w-6xl px-4 py-12">
        <div class="grid gap-10 md:grid-cols-2">
            <div class="space-y-4">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#CD2028]">Cargo</p>
                <p class="text-2xl font-bold text-white">{{ $brand }}</p>
                <p class="text-base text-gray-400">{{ $tagline }}</p>
            </div>
            <div class="space-y-4">
                @foreach ($contacts as $item)
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $item['label'] }}</p>
                        <p class="text-sm text-gray-400">{{ $item['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-10 flex flex-col gap-4 border-t border-white/10 pt-6 text-sm text-gray-400 md:flex-row md:items-center md:justify-between">
            <nav class="flex flex-wrap gap-4">
                @foreach ($footerLinks as $link)
                    <a href="{{ $link['href'] }}" class="transition hover:text-white">{{ $link['label'] }}</a>
                @endforeach
            </nav>
            <p>© {{ now()->year }} {{ $brand }}. All rights reserved.</p>
        </div>
    </div>
</footer>
