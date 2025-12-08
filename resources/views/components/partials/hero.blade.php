{{-- resources/views/components/partials/hero.blade.php --}}
<section class="relative bg-gradient-to-r from-stone-800 to-stone-900 rounded-3xl overflow-hidden shadow-2xl {{ $attributes->get('class') }}">

    {{-- Image de fond --}}
    <div class="absolute inset-0">
        <img src="{{ $image ?? 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80' }}"
             alt="{{ $title ?? 'Culture Bénin' }}"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/70 to-transparent"></div>
    </div>

    {{-- Contenu --}}
    <div class="relative max-w-7xl mx-auto px-6 py-24 sm:py-32 lg:px-8 text-center">
        @if(isset($subtitle))
            <p class="text-taupe-400 font-semibold text-lg mb-4 tracking-wider uppercase">
                {{ $subtitle }}
            </p>
        @endif

        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-tight mb-6">
            {{ $title ?? 'Culture Bénin' }}
        </h1>

        @if(isset($description))
            <p class="text-xl sm:text-2xl text-stone-200 max-w-4xl mx-auto leading-relaxed">
                {{ $description }}
            </p>
        @endif

        @if($slot->isNotEmpty())
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                {{ $slot }}
            </div>
        @endif
    </div>
</section>