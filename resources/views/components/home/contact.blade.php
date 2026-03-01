@php
    $contacts = [
        [
            'title' => 'Head Office',
            'subtitle' => 'Jam Operasional',
            'details' => 'Senin - Jumat 08.00 - 17.00 | Sabtu - Minggu tutup',
            'icon' => asset('images/clock-logo.svg'),
        ],
        [
            'title' => 'Warehouse Tangerang',
            'subtitle' => 'Alamat',
            'details' => 'Ruko Smart Market Blok F-02 Jl. Daan Mogot KM.19 Batu Ceper Tangerang',
            'icon' => asset('images/home/location-marker.svg'),
        ],
        [
            'title' => 'Customer Service',
            'subtitle' => 'Telepon',
            'details' => '081 1152 4260 | 021-5578-3388',
            'icon' => asset('images/home/phone.svg'),
        ],
        [
            'title' => 'Email',
            'subtitle' => 'Support',
            'details' => 'support@gumarangcargo.co.id',
            'icon' => asset('images/home/clock.svg'),
        ],
    ];
@endphp

<x-section id="contact" eyebrow="Hubungi Kami" title="Informasi & Konsultasi" description="Tim kami siap membantu kebutuhan ekspedisi Anda." align="left">
    <div class="grid gap-10 md:grid-cols-2">
        <div class="space-y-6 rounded-3xl bg-gray-50 p-6">
            <p class="text-base text-gray-600">Diskusikan kebutuhan logistik, cek tarif khusus proyek, atau jadwalkan kunjungan tim kami.</p>
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="tel:08111524260" class="inline-flex flex-1 items-center justify-center rounded-2xl bg-[#CD2028] px-4 py-3 text-base font-semibold text-white shadow-lg shadow-[#cd2028]/20">Telepon Sekarang</a>
                <a href="https://wa.me/628111524260" target="_blank" rel="noopener" class="inline-flex flex-1 items-center justify-center rounded-2xl border border-gray-200 px-4 py-3 text-base font-semibold text-gray-900">WhatsApp</a>
            </div>
        </div>
        <div class="space-y-4">
            @foreach ($contacts as $contact)
                <x-card :title="$contact['title']" :description="$contact['details']" :icon="$contact['icon']" orientation="horizontal" variant="muted" class="text-left">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $contact['subtitle'] }}</p>
                </x-card>
            @endforeach
        </div>
    </div>
</x-section>
