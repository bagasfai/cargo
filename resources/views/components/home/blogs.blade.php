@php
    $posts = [
        [
            'title' => 'Jasa Ekspedisi Jakarta Banda Aceh dengan Ongkir Termurah',
            'excerpt' => 'PT. Paket Insan Kargo melayani ekspedisi Jakarta ke Banda Aceh dengan biaya hemat dan layanan door to door.',
            'image' => 'https://placehold.co/600x300',
        ],
        [
            'title' => 'Paket Kilat ke Kalimantan',
            'excerpt' => 'Solusi kargo udara untuk memenuhi kebutuhan distribusi cepat menuju kota-kota besar di Kalimantan.',
            'image' => 'https://placehold.co/600x300',
        ],
        [
            'title' => 'Tips Packing Aman Untuk Barang Pecah Belah',
            'excerpt' => 'Kenali material packing terbaik agar barang berharga Anda tiba dengan selamat.',
            'image' => 'https://placehold.co/600x300',
        ],
        [
            'title' => 'Ekspedisi Proyek Industri',
            'excerpt' => 'Dukungan armada alat berat untuk pengiriman komponen industri secara terpadu.',
            'image' => 'https://placehold.co/600x300',
        ],
    ];
@endphp

<x-section id="blog" eyebrow="Jangan Tertinggal" title="Informasi Terbaru dari Kami" description="Update rutin seputar layanan, tips logistik, dan cerita pelanggan." align="left">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        @foreach ($posts as $post)
            <x-card variant="accent" class="items-start text-left">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="h-32 w-full rounded-2xl object-cover">
                <div class="space-y-2 text-left">
                    <h3 class="text-lg font-semibold text-white">{{ $post['title'] }}</h3>
                    <p class="text-sm text-white/80">{{ $post['excerpt'] }}</p>
                </div>
            </x-card>
        @endforeach
    </div>
</x-section>
