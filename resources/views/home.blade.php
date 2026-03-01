<x-layouts.public title="Home">
    <x-navbar />

    <main class="flex-1 space-y-16">
        <x-hero />
        <x-home.why-us />
        <x-home.services />
        <x-home.pricing :rows="$blogs" />
        <x-home.contact />
        <x-home.blogs />
    </main>

    <x-footer />
</x-layouts.public>
