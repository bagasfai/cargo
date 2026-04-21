@props(['rows' => []])

<x-section id="pricing" eyebrow="Tarif Ekspedisi" title="Tarif dari Tangerang ke Seluruh Indonesia" description="Lihat estimasi biaya per kilogram lengkap dengan minimum pengiriman dan estimasi tiba." align="center">
    <form method="GET" action="{{ url('/') }}" class="mb-6 mx-auto w-full">
        <div class="flex flex-col gap-3 sm:flex-row justify-end">
            <x-form.input
                name="search"
                type="text"
                :value="request('search')"
                placeholder="Cari kota, provinsi, atau estimasi..."
                class="w-full"
            />

            <input type="hidden" name="sort" value="{{ request('sort') }}">
            <input type="hidden" name="direction" value="{{ request('direction') }}">

            <x-ui.button type="submit" variant="primary" class="whitespace-nowrap">
                Cari
            </x-ui.button>

            @if (request()->filled('search'))
                <x-ui.button href="{{ url('/') }}" variant="outline" class="whitespace-nowrap">
                    Reset
                </x-ui.button>
            @endif
        </div>
    </form>

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

@push('scripts')
    <script>
        (function ($) {
            if (!$) {
                return;
            }

            const sectionSelector = '#pricing';

            function buildUrlWithFormData(action, formData) {
                const url = new URL(action, window.location.origin);

                formData.forEach(({ name, value }) => {
                    if (value !== null && value !== '') {
                        url.searchParams.set(name, value);
                    }
                });

                return url;
            }

            function swapPricingSection(url, pushState = true) {
                $.get(url)
                    .done(function (html) {
                        const $parsed = $('<div>').append($.parseHTML(html, document, true));
                        const $newSection = $parsed.find(sectionSelector).first();

                        if (!$newSection.length) {
                            window.location.href = url;
                            return;
                        }

                        $(sectionSelector).replaceWith($newSection);

                        if (pushState) {
                            window.history.pushState({ pricingAjax: true }, '', url);
                        }

                        const offsetTop = $(sectionSelector).offset()?.top;
                        if (typeof offsetTop === 'number') {
                            $('html, body').stop().animate({ scrollTop: offsetTop - 24 }, 250);
                        }
                    })
                    .fail(function () {
                        window.location.href = url;
                    });
            }

            $(function () {
                if (!$(sectionSelector).length) {
                    return;
                }

                $(document).on('click', '#pricing a[href]', function (event) {
                    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                        return;
                    }

                    const href = $(this).attr('href');
                    if (!href || href.startsWith('#') || href.startsWith('javascript:') || this.target === '_blank') {
                        return;
                    }

                    const url = new URL(href, window.location.origin);
                    if (url.origin !== window.location.origin || url.pathname !== window.location.pathname) {
                        return;
                    }

                    event.preventDefault();
                    swapPricingSection(url.toString());
                });

                $(document).on('submit', '#pricing form', function (event) {
                    event.preventDefault();

                    const $form = $(this);
                    const action = $form.attr('action') || window.location.pathname;
                    const url = buildUrlWithFormData(action, $form.serializeArray());

                    swapPricingSection(url.toString());
                });

                window.addEventListener('popstate', function () {
                    if (!$(sectionSelector).length) {
                        return;
                    }

                    swapPricingSection(window.location.href, false);
                });
            });
        })(window.jQuery);
    </script>
@endpush
