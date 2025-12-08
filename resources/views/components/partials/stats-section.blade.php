{{-- resources/views/components/partials/stats-section.blade.php --}}
<section class="py-16 {{ $attributes->get('class') }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-lg border border-stone-100 p-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <x-ui.stat-card number="{{ $regionsCount ?? '12' }}">
                    Régions culturelles
                </x-ui.stat-card>

                <x-ui.stat-card number="{{ $languagesCount ?? '50+' }}">
                    Langues parlées
                </x-ui.stat-card>

                <x-ui.stat-card number="{{ $contentsCount ?? '200+' }}">
                    Contenus disponibles
                </x-ui.stat-card>

                <x-ui.stat-card number="{{ $unescoCount ?? '5' }}">
                    Sites UNESCO
                </x-ui.stat-card>
            </div>
        </div>
    </div>
</section>