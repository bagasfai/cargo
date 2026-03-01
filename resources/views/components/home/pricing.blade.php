@props(['rows' => []])

<x-section id="pricing" eyebrow="Tarif Ekspedisi" title="Tarif dari Tangerang ke Seluruh Indonesia" description="Lihat estimasi biaya per kilogram lengkap dengan minimum pengiriman dan estimasi tiba." align="center">
    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white">
        <div class="overflow-x-auto">
            <x-table :columns="[
                ['label' => 'Kota Tujuan'],
                ['label' => 'Provinsi'],
                ['label' => 'Biaya/kg'],
                ['label' => 'Min. Kirim'],
                ['label' => 'Estimasi'],
            ]" :rows="$rows" route="{{ route('blogs.index') }}" />
        </div>
    </div>
</x-section>
