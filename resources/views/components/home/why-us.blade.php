@php
    $highlights = [
        [
            'title' => 'Kemitraan Strategis',
            'description' => 'Berkolaborasi dengan maskapai nasional untuk memastikan ketepatan waktu dan keamanan kargo.',
            'icon' => asset('images/home/kemitraan-strategis.svg'),
        ],
        [
            'title' => 'Layanan Terintegrasi',
            'description' => 'Dokumen, kepabeanan, hingga pengantaran akhir berada dalam satu rantai layanan.',
            'icon' => asset('images/home/layanan-terintegrasi.svg'),
        ],
        [
            'title' => 'Tarif Kompetitif',
            'description' => 'Penawaran harga yang transparan dan menyesuaikan kebutuhan volume pengiriman.',
            'icon' => asset('images/home/tarif-kompetitif.svg'),
        ],
        [
            'title' => 'Customer Care Profesional',
            'description' => 'Tim support responsif yang mendampingi setiap tahap perjalanan paket.',
            'icon' => asset('images/home/professional-icon.svg'),
        ],
    ];

    $gallery = [
        asset('images/home/why-us-1.svg'),
        asset('images/home/why-us-2.svg'),
    ];
@endphp

<x-section id="why-us" eyebrow="Kenapa Harus Kami" title="PT Gumarang Indo Express" description="Lebih dari 10 tahun pengalaman mengantarkan kargo dari Tangerang ke seluruh Indonesia.">
    <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ($gallery as $image)
                <figure class="overflow-hidden rounded-3xl">
                    <img src="{{ $image }}" alt="Armada Gumarang" class="h-full w-full object-cover">
                </figure>
            @endforeach
        </div>
        <div class="space-y-5">
            @foreach ($highlights as $highlight)
                <x-card :title="$highlight['title']" :description="$highlight['description']" :icon="$highlight['icon']" orientation="horizontal" variant="plain" title-class="text-[#CD2028]" class="rounded-2xl border border-gray-100 bg-white text-left">
                </x-card>
            @endforeach
        </div>
    </div>
</x-section>
