@php
    $services = [
        [
            'title' => 'Pengiriman Udara',
            'description' => 'Pengiriman prioritas dengan jaringan cargo udara nasional.',
            'icon' => asset('images/home/pesawat.svg'),
        ],
        [
            'title' => 'Pengiriman Kontainer',
            'description' => 'Full container load dengan jadwal fleksibel ke berbagai pelabuhan.',
            'icon' => asset('images/home/cargo.svg'),
        ],
        [
            'title' => 'Pengiriman Laut',
            'description' => 'Solusi ekonomis untuk volume besar antar pulau.',
            'icon' => asset('images/home/kapal.svg'),
        ],
        [
            'title' => 'Sewa Truk',
            'description' => 'Armada truk berbagai tipe untuk kebutuhan distribusi darat.',
            'icon' => asset('images/home/heavy-duty.svg'),
        ],
        [
            'title' => 'Project Alat Berat',
            'description' => 'Penanganan khusus untuk pengerjaan proyek dan logistik alat berat.',
            'icon' => asset('images/home/heavy-duty.svg'),
        ],
        [
            'title' => 'Pindahan Rumah',
            'description' => 'Tim khusus untuk memastikan proses relokasi aman dan rapi.',
            'icon' => asset('images/home/rumah.svg'),
        ],
    ];
@endphp

<x-section id="services" eyebrow="Layanan Kami" title="Jaringan Layanan yang Fleksibel" description="Semua kebutuhan logistik terpenuhi dengan pendekatan end-to-end." align="center">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
            <x-card :title="$service['title']" :description="$service['description']" :icon="$service['icon']" variant="outline" class="text-left !border-[#CD2028] ring-1 ring-[#CD2028]/10">
            </x-card>
        @endforeach
    </div>
</x-section>
