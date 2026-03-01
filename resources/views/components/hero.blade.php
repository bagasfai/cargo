@props([
    'id' => 'hero',
    'eyebrow' => 'Ekspedisi Nasional',
    'title' => 'Solusi Pengiriman Anda Untuk Sekali Tekan',
    'subtitle' => 'Percayakan pengiriman Anda kepada kami dengan jaringan terpercaya di seluruh Indonesia.',
    'ctaLabel' => 'Cek Tarif',
    'ctaHref' => '#pricing',
    'secondaryCtaLabel' => 'Hubungi Kami',
    'secondaryCtaHref' => '#contact',
    'backgroundImage' => asset('images/home/hero-background.svg')
])

<section id="{{ $id }}" class="relative isolate overflow-hidden bg-gray-900 text-white">
    <div class="absolute inset-0 opacity-70" style="background-image: url('{{ $backgroundImage }}'); background-size: cover; background-position: center;"></div>
    <div class="relative mx-auto flex max-w-6xl flex-col gap-8 px-4 py-20 text-center md:flex-row md:items-center md:text-left">
        <div class="space-y-6">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-white/80">{{ $eyebrow }}</p>
            <h1 class="text-3xl font-bold leading-tight sm:text-4xl md:text-5xl md:leading-[1.15]">{!! nl2br(e($title)) !!}</h1>
            <p class="text-base text-white/80 sm:text-lg md:text-xl">{{ $subtitle }}</p>
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ $ctaHref }}" class="inline-flex items-center justify-center rounded-2xl bg-white px-6 py-3 text-base font-semibold text-[#CD2028] shadow-lg shadow-white/30 transition hover:bg-gray-100">
                    {{ $ctaLabel }}
                </a>
                <a href="{{ $secondaryCtaHref }}" class="inline-flex items-center justify-center rounded-2xl border border-white/40 px-6 py-3 text-base font-semibold text-white transition hover:bg-white/10">
                    {{ $secondaryCtaLabel }}
                </a>
            </div>
        </div>
        <div class="grid w-full max-w-lg grid-cols-2 gap-4 rounded-3xl bg-white/10 p-6 backdrop-blur">
            <div>
                <p class="text-sm text-white/70">Kota Tujuan</p>
                <p class="text-2xl font-bold">200+</p>
            </div>
            <div>
                <p class="text-sm text-white/70">Tim Profesional</p>
                <p class="text-2xl font-bold">50+</p>
            </div>
            <div>
                <p class="text-sm text-white/70">Pengiriman Harian</p>
                <p class="text-2xl font-bold">500+</p>
            </div>
            <div>
                <p class="text-sm text-white/70">Tahun Pengalaman</p>
                <p class="text-2xl font-bold">10+</p>
            </div>
        </div>
    </div>
</section>
