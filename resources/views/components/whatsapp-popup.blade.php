@php
    $phone = '0812-1882-9872';
    $waNumber = preg_replace('/[^0-9]/', '', $phone);
    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }
    $waLink = 'https://wa.me/' . $waNumber;
@endphp

<div class="fixed bottom-5 right-4 z-40 flex flex-col items-end gap-3 text-left">
    <div class="hidden rounded-2xl border border-[#CD2028]/20 bg-white px-4 py-3 text-sm font-semibold text-gray-800 shadow-lg shadow-gray-900/10 md:block">
        Butuh bantuan cepat? Hubungi kami via WhatsApp.
    </div>
    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="group inline-flex items-center gap-3 rounded-full bg-[#25D366] px-5 py-3 text-sm font-semibold text-white shadow-xl shadow-[#25d366]/40 transition hover:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#25D366]">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor">
                <path d="M12 2a9.94 9.94 0 0 0-8.47 15.51L2 22l4.64-1.53A10 10 0 1 0 12 2Zm5.34 14.29c-.22.62-1.27 1.18-1.78 1.24s-.86.39-2.92-.6a10 10 0 0 1-3.94-3.44 4.5 4.5 0 0 1-.93-2.41 2.63 2.63 0 0 1 .82-2 1.13 1.13 0 0 1 .82-.39c.2 0 .4 0 .58.01s.44-.07.68.52.85 2.09.93 2.24a.55.55 0 0 1 0 .52c-.1.21-.16.34-.32.53s-.34.4-.49.54-.3.28-.12.57a7.56 7.56 0 0 0 1.4 1.72 6.73 6.73 0 0 0 2.1 1.37c.26.13.41.12.57-.08s.66-.78.84-1.05.35-.22.58-.13 1.5.71 1.76.84.43.19.49.3a1.76 1.76 0 0 1-.13.99Z"/>
            </svg>
        </span>
        <div class="flex flex-col">
            <span class="text-xs uppercase tracking-wide text-white/70">WhatsApp</span>
            <span>{{ $phone }}</span>
        </div>
    </a>
</div>
