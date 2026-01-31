<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cargo</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {!! SEO::generate() !!}

</head>

<body class="max-w-full h-full flex flex-col gap-2.5 bg-white font-sans antialiased mx-15 my-6">
    <x-common.preloader />

    {{-- Header / Hero --}}
    <div class="flex flex-col gap-7.5">

        {{-- Header --}}
        <div class="flex items-center justify-between bg-gray-50 gap-7.5">
            {{-- Header Logo --}}
            <div class="flex items-center justify-center gap-2.5">
                <img src="{{ asset('images/logo-header.svg') }}" alt="" class="h-13 w-13">
                <span class="w-36 leading-5.5 font-bold">PT GUMARANG INDO EXPRESS</span>
            </div>

            {{-- Header Info --}}
            <div class="flex justify-between items-center gap-2.5">
                <div class="flex gap-2.5">
                    <img src="{{ asset('images/home/clock.svg') }}" alt="clock" class="h-7.5 w-7.5">
                    <div class="flex flex-col gap-0">
                        <p class="font-bold text-[11px]">Jam Operasional</p>
                        <p class="leading-3.5 text-[11px]">Senin - Jumat <br> 08.00 - 17.00</p>
                    </div>
                </div>
                <div class="flex gap-2.5">
                    <img src="{{ asset('images/home/location-marker.svg') }}" alt="location" class="h-7.5 w-7.5">
                    <div class="flex flex-col gap-0">
                        <p class="font-bold text-[11px]">Alamat Kami</p>
                        <p class="leading-3.5 text-[11px]">Ruko Smart Market Blok F-02 <br> Jl. Daan Mogot KM.19 Batu Ceper Tangerang</p>
                    </div>
                </div>
                <div class="flex gap-2.5">
                    <img src="{{ asset('images/home/phone.svg') }}" alt="phone" class="h-7.5 w-7.5">
                    <div class="flex flex-col gap-0">
                        <p class="font-bold text-[11px]">Kontak Kami</p>
                        <p class="leading-3.5 text-[11px]">Customer Service <br> 081 1152 4260</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hero --}}
        <div class="flex flex-col bg-gray-100 gap-11.25">
            <div class="bg-[#CD2028] flex px-11.25 justify-start items-center h-10 gap-7">
                <h4 class="text-[16px] font-bold text-white">Home</h4>
                <h4 class="text-[16px] font-bold text-white">Tentang Kami</h4>
                <h4 class="text-[16px] font-bold text-white">Ekspedisi Tangerang</h4>
                <h4 class="text-[16px] font-bold text-white">Layanan Kami</h4>
            </div>
        </div>

        <div class="flex flex-col gap-3 bg-no-repeat bg-cover h-138 justify-center items-start text-white px-23.5 py-51.5" style="background-image: url('{{ asset('images/home/hero-background.svg') }}');">
            <h1 class="text-[40px] font-bold leading-12.25">Solusi Pengiriman Anda <br> Untuk Sekali Tekan</h1>
            <h2 class="text-[24px]">Percayakan Pengiriman Anda Kepada Kami</h2>
            <button class="bg-white text-[#CD2028] text-[24px] font-bold px-14 py-2.75 rounded-[14px] hover:bg-gray-200 transition">
                CEK TARIF
            </button>
        </div>
    </div>

    {{-- Why Us --}}
    <div class="flex flex-col gap-4.75 px-64.5 py-9.75 items-center justify-center">
        <h2 class="text-[40px] font-bold text-center leading-12.25 w-201">Kenapa <span class="text-[#CD2028]">Harus <br> PT Gumarang</span> Indo Express?</h2>
        <p class="text-[24.72px] leading-7.5 text-[#9D9D9D] text-center w-201">Gumarang Indo Express  telah berpengalaman lebih dari 10 Tahun dalam hal ekspedisi cargo dari Tangerang ke Seluruh Indonesia hingga ketingkat kecamatan.</p>
        <div class="w-316.75 flex items-center justify-center gap-7.5 py-10.25">
            <img src="{{ asset('images/home/why-us-1.svg') }}" alt="image-1" class="w-79.75 h-92.25">
            <img src="{{ asset('images/home/why-us-2.svg') }}" alt="image-2" class="w-79.75 h-92.25">
            <div class="flex flex-col gap-9 w-104.75">
                <div class="flex gap-3.75 justify-center items-center">
                    <img src="{{ asset('images/home/kemitraan-strategis.svg') }}" alt="kemitraan-strategis" class="w-10.25 h-14.5">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-[#CD2028] text-[20px] font-bold">Kemitraan Stragegis</h3>
                        <p class="text-[11px] leading-3.5">Bekerja sama dengan maskapai penerbangan terkemuka untuk memastikan pengiriman tepat waktu dan aman.</p>
                    </div>
                </div>
                <div class="flex gap-3.75 justify-center items-center">
                    <img src="{{ asset('images/home/layanan-terintegrasi.svg') }}" alt="layanan-terintegrasi" class="w-14.5 h-14.5">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-[#CD2028] text-[20px] font-bold">Layanan Terintegrasi</h3>
                        <p class="text-[11px] leading-3.5">Menyediakan solusi end-to-end, mulai dari pengurusan dokumen dan kepabeanan hingga pengantaran ke alamat tujuan.</p>
                    </div>
                </div>
                <div class="flex gap-3.75 justify-center items-center">
                    <img src="{{ asset('images/home/tarif-kompetitif.svg') }}" alt="tarif-kompetitif" class="w-14.25 h-14.25">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-[#CD2028] text-[20px] font-bold">Tarif Kompetitif</h3>
                        <p class="text-[11px] leading-3.5">Menawarkan harga yang bersaing dan transparan, disesuaikan dengan kebutuhan serta anggaran pelanggan.</p>
                    </div>
                </div>
                <div class="flex gap-3.75 justify-center items-center">
                    <img src="{{ asset('images/home/professional-icon.svg') }}" alt="professional-icon" class="w-12.75 h-16.25">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-[#CD2028] text-[20px] font-bold">Pelayanan Pelanggan Professional</h3>
                        <p class="text-[11px] leading-3.5">Didukung tim berpengalaman yang siap membantu dan memberikan informasi secara responsif untuk memastikan proses pengiriman berjalan lancar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Our Services --}}
    <div class="flex flex-col gap-2.5 justify-center items-center">
        <h2 class="text-[32px] font-bold"><span class="text-[#CD2028]">Layanan</span> Kami</h2>
        <div class="grid grid-cols-3 gap-x-18 gap-y-12.75">
            <div class="flex flex-col gap-2.5 px-4.25 py-5.75 h-60.75 text-center border-3 border-[#CD2028] rounded-[29px] items-center justify-center w-81.5">
                <img src="{{ asset('images/home/pesawat.svg') }}" alt="pesawat" class="w-21.5 h-16">
                <div class="flex flex-col gap-1.75">
                    <h4 class="text-[#CD2028] text-[24px] font-bold">Pengiriman Udara</h4>
                    <p class="text-[15px]">Jasa kargo via udara dengan tarif yang kompetitif dan cepat sampai di lokasi penerima.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5 px-4.25 py-5.75 h-60.75 text-center border-3 border-[#CD2028] rounded-[29px] items-center justify-center w-81.5">
                <img src="{{ asset('images/home/cargo.svg') }}" alt="cargo" class="w-20.5 h-23.25">
                <div class="flex flex-col gap-1.75">
                    <h4 class="text-[#CD2028] text-[24px] font-bold">Pengiriman Kontainer</h4>
                    <p class="text-[15px]">Jasa kargo via udara dengan tarif yang kompetitif dan cepat sampai di lokasi penerima.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5 px-4.25 py-5.75 h-60.75 text-center border-3 border-[#CD2028] rounded-[29px] items-center justify-center w-81.5">
                <img src="{{ asset('images/home/kapal.svg') }}" alt="kapal" class="w-19 h-19.25">
                <div class="flex flex-col gap-1.75">
                    <h4 class="text-[#CD2028] text-[24px] font-bold">Pengiriman Kargo</h4>
                    <p class="text-[15px]">Jasa kargo via udara dengan tarif yang kompetitif dan cepat sampai di lokasi penerima.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5 px-4.25 py-5.75 h-60.75 text-center border-3 border-[#CD2028] rounded-[29px] items-center justify-center w-81.5">
                <img src="{{ asset('images/home/heavy-duty.svg') }}" alt="heavy-duty" class="w-26 h-17">
                <div class="flex flex-col gap-1.75">
                    <h4 class="text-[#CD2028] text-[24px] font-bold">Jasa Sewa Truk</h4>
                    <p class="text-[15px]">Jasa kargo via udara dengan tarif yang kompetitif dan cepat sampai di lokasi penerima.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5 px-4.25 py-5.75 h-60.75 text-center border-3 border-[#CD2028] rounded-[29px] items-center justify-center w-81.5">
                <img src="{{ asset('images/home/heavy-duty.svg') }}" alt="heavy-duty" class="w-26 h-17">
                <div class="flex flex-col gap-1.75">
                    <h4 class="text-[#CD2028] text-[24px] font-bold">Project Alat Berat</h4>
                    <p class="text-[15px]">Jasa kargo via udara dengan tarif yang kompetitif dan cepat sampai di lokasi penerima.</p>
                </div>
            </div>
            <div class="flex flex-col gap-2.5 px-4.25 py-5.75 h-60.75 text-center border-3 border-[#CD2028] rounded-[29px] items-center justify-center w-81.5">
                <img src="{{ asset('images/home/rumah.svg') }}" alt="rumah" class="w-19 h-19.25">
                <div class="flex flex-col gap-1.75">
                    <h4 class="text-[#CD2028] text-[24px] font-bold">Jasa Pindahan Rumah</h4>
                    <p class="text-[15px]">Jasa kargo via udara dengan tarif yang kompetitif dan cepat sampai di lokasi penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="border-4 border-[#CD2028] mb-10">

    {{-- Pricing --}}
    <div class="flex flex-col gap-2.5">
        <h2 class="text-[32px] font-bold text-center"><span class="text-[#CD2028]">Tarif Ekspedisi</span> dari Tangerang ke Seluruh Indonesia</h2>
        <x-table :columns="[
            ['label' => 'Kota Tujuan'],
            ['label' => 'Provinsi'],
            ['label' => 'Biaya/kg'],
            ['label' => 'Min. Kirim'],
            ['label' => 'Estimasi'],
        ]" :rows="$blogs" route="{{ route('blogs.index') }}"/>
    </div>

    <div class="pb-20"></div>


</body>
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

</html>
