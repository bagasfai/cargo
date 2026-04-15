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
            'details' => 'Ruko Cendana, Blok A Jl. Benteng Betawi No.26, RT.001/RW.015, Poris Plawad, Kec. Tangerang, Kota Tangerang, Banten 15119',
            'icon' => asset('images/home/location-marker.svg'),
        ],
        [
            'title' => 'Customer Service',
            'subtitle' => 'Telepon',
            'details' => '0812-1882-9872',
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
                <a href="tel:081218829872" class="inline-flex flex-1 items-center justify-center rounded-2xl bg-[#CD2028] px-4 py-3 text-base font-semibold text-white shadow-lg shadow-[#cd2028]/20">Telepon Sekarang</a>
                <a href="https://wa.me/6281218829872" target="_blank" rel="noopener" class="inline-flex flex-1 items-center justify-center rounded-2xl border border-gray-200 px-4 py-3 text-base font-semibold text-gray-900">WhatsApp</a>
            </div>
            <div class="relative w-full overflow-hidden rounded-3xl shadow-sm shadow-gray-200/60" style="padding-top: 62.5%;">
                <iframe class="absolute inset-0 h-full w-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4787.898635345804!2d106.65561149999999!3d-6.174474399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f8e701faaaab%3A0x9b5179e9d3709c3f!2sPT%20GUMARANG%20INDO%20EXPRESS!5e1!3m2!1sen!2sid!4v1773068238284!5m2!1sen!2sid" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border:0;"></iframe>
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
