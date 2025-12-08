{{-- resources/views/components/gallery/gallery-grid.blade.php --}}
<div class="columns-2 sm:columns-3 lg:columns-4 gap-4 space-y-4">
    @foreach($photos as $photo)
        <a href="{{ $photo->url }}"           {{-- ← ici on utilise l'accesseur $photo->url --}}
           data-lightbox="gallery" 
           data-title="{{ $photo->description ?? 'Galerie Culture Bénin' }}"
           class="block break-inside-avoid overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow group">
            <img src="{{ $photo->url }}"      {{-- ← et ici aussi --}}
                 alt="{{ $photo->description }}"
                 class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-300">
        </a>
    @endforeach
</div>