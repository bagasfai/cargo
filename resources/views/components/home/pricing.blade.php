@props(['rows' => []])

<x-section id="pricing" eyebrow="Tarif Ekspedisi" title="Tarif dari Tangerang ke Seluruh Indonesia" description="Lihat estimasi biaya per kilogram lengkap dengan minimum pengiriman dan estimasi tiba." align="center">
    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white">
        <div class="overflow-x-auto">
            <x-table :columns="[
                ['label' => 'Kota Tujuan', 'field' => 'city.name'],
                ['label' => 'Provinsi', 'field' => 'province.name'],
                ['label' => 'Biaya/kg', 'field' => 'price_per_kg', 'format' => fn($row) => 'Rp ' . number_format($row->price_per_kg, 0, ',', '.')],
                ['label' => 'Min. Kirim', 'field' => 'min_weight', 'format' => fn($row) => $row->min_weight . ' kg'],
                ['label' => 'Estimasi', 'field' => 'estimated_delivery_time'],
            ]" :rows="$rows" route="{{ url('/') }}" />
        </div>
    </div>
</x-section>
