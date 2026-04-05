<x-layouts.public title="Home">
    <x-navbar />

    <main class="flex-1 space-y-16">
        <x-hero />
        <x-home.why-us />
        <x-home.services />
        <x-home.pricing :rows="$expeditionPrices" />
        <x-home.contact />
        <x-home.blogs :posts="$featuredPosts" />
    </main>

    <x-footer />
</x-layouts.public>
