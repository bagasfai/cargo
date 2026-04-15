@extends('layouts.app')

@section('title', 'Edit Expedition Price')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Edit Expedition Price</x-ui.heading>

            <a href="{{ route('expedition-prices.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Expedition Prices
            </a>
        </div>

        <form action="{{ route('expedition-prices.update', $expeditionPrice) }}" method="POST" class="space-y-6"
              x-data="{
                  province_id: '{{ old('province_id', $expeditionPrice->province_id) }}',
                  city_id: '{{ old('city_id', $expeditionPrice->city_id) }}',
                  district_id: '{{ old('district_id', $expeditionPrice->district_id) }}',
                  village_id: '{{ old('village_id', $expeditionPrice->village_id) }}',
                  cities: @js($cities->map(fn($c) => ['id' => $c->id, 'name' => $c->name])),
                  districts: @js($districts->map(fn($d) => ['id' => $d->id, 'name' => $d->name])),
                  villages: @js($villages->map(fn($v) => ['id' => $v->id, 'name' => $v->name])),
                  async fetchCities() {
                      if (!this.province_id) { this.cities = []; this.city_id = ''; this.districts = []; this.district_id = ''; this.villages = []; this.village_id = ''; return; }
                      const res = await fetch(`/api/provinces/${this.province_id}/cities`);
                      this.cities = await res.json();
                      this.city_id = ''; this.districts = []; this.district_id = ''; this.villages = []; this.village_id = '';
                  },
                  async fetchDistricts() {
                      if (!this.city_id) { this.districts = []; this.district_id = ''; this.villages = []; this.village_id = ''; return; }
                      const res = await fetch(`/api/cities/${this.city_id}/districts`);
                      this.districts = await res.json();
                      this.district_id = ''; this.villages = []; this.village_id = '';
                  },
                  async fetchVillages() {
                      if (!this.district_id) { this.villages = []; this.village_id = ''; return; }
                      const res = await fetch(`/api/districts/${this.district_id}/villages`);
                      this.villages = await res.json();
                  }
              }">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Province --}}
                <div @select-change="province_id = $event.detail.value; fetchCities()">
                    <x-form.select-search name="province_id" label="Province" :options="$provinces->pluck('name', 'id')->toArray()"
                        :value="old('province_id', $expeditionPrice->province_id)" />
                </div>

                {{-- City --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                    <select name="city_id" x-model="city_id" @change="fetchDistricts()"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-700 dark:text-gray-300">
                        <option value="">Select City</option>
                        <template x-for="city in cities" :key="city.id">
                            <option :value="city.id" x-text="city.name" :selected="city.id == city_id"></option>
                        </template>
                    </select>
                    <x-form.error name="city_id" />
                </div>

                {{-- District --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">District (optional)</label>
                    <select name="district_id" x-model="district_id" @change="fetchVillages()"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-700 dark:text-gray-300">
                        <option value="">Select District</option>
                        <template x-for="district in districts" :key="district.id">
                            <option :value="district.id" x-text="district.name" :selected="district.id == district_id"></option>
                        </template>
                    </select>
                    <x-form.error name="district_id" />
                </div>

                {{-- Village --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Village (optional)</label>
                    <select name="village_id" x-model="village_id"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-700 dark:text-gray-300">
                        <option value="">Select Village</option>
                        <template x-for="village in villages" :key="village.id">
                            <option :value="village.id" x-text="village.name" :selected="village.id == village_id"></option>
                        </template>
                    </select>
                    <x-form.error name="village_id" />
                </div>

                {{-- Code --}}
                <div>
                    <x-form.input name="code" label="Code" placeholder="e.g. TNG-BDG"
                        :value="old('code', $expeditionPrice->code)" />
                </div>

                {{-- Price per KG --}}
                <div>
                    <x-form.input name="price_per_kg" label="Price per Kg (Rp)" type="number" placeholder="e.g. 15000"
                        :value="old('price_per_kg', $expeditionPrice->price_per_kg)" />
                </div>

                {{-- Min Weight --}}
                <div>
                    <x-form.input name="min_weight" label="Minimum Weight (kg)" type="number" placeholder="e.g. 10"
                        :value="old('min_weight', $expeditionPrice->min_weight)" />
                </div>

                {{-- Estimated Delivery Time --}}
                <div>
                    <x-form.input name="estimated_delivery_time" label="Estimated Delivery Time" placeholder="e.g. 2-3 hari"
                        :value="old('estimated_delivery_time', $expeditionPrice->estimated_delivery_time)" />
                </div>

                {{-- Is Active --}}
                <div>
                    <x-form.toggle name="is_active" label="Active" :checked="old('is_active', $expeditionPrice->is_active)" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('expedition-prices.index') }}"
                    class="px-4 py-2 rounded-lg border
                      text-gray-700 dark:text-gray-300
                      border-gray-300 dark:border-gray-700">
                    Cancel
                </a>

                <x-ui.button type="submit">
                    Update
                </x-ui.button>
            </div>
        </form>

    </div>
@endsection
