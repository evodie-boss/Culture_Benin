{{-- Ce fichier est inclus dans welcome.blade.php. Il affiche 6 cartes d'exemple. --}}
@php
    $cards = [
        ['title' => "Les Palais Royaux d'Abomey", 'region' => 'Abomey', 'langue' => 'Français', 'type' => 'Histoire', 'img' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?fit=crop&w=600&q=80', 'snippet' => "Découvrez l'histoire fascinante des rois d'Abomey, un site classé au patrimoine mondial de l'UNESCO."],
        ['title' => "Comprendre le Vodun", 'region' => 'Sud Bénin', 'langue' => 'Fon', 'type' => 'Tradition', 'img' => 'https://images.unsplash.com/photo-1580136607986-855c56ae0ff1?fit=crop&w=600&q=80', 'snippet' => "Le Vodun (Vaudou) est bien plus qu'une religion; c'est un système philosophique et culturel profondément enraciné."],
        ['title' => "La Fête de la Gaani", 'region' => 'Nord Bénin', 'langue' => 'Dendi', 'type' => 'Événement', 'img' => 'https://images.unsplash.com/photo-1551966775-a4ddc8df052b?fit=crop&w=600&q=80', 'snippet' => "Célébrée dans le Nord, la Gaani est un moment fort de l'année, marquant le début de la nouvelle année et l'union des peuples."],
        ['title' => "Ganvié, la Venise de l'Afrique", 'region' => 'Lac Nokoué', 'langue' => 'Français', 'type' => 'Architecture', 'img' => 'https://images.unsplash.com/photo-1545342084-d03fe58ea513?fit=crop&w=600&q=80', 'snippet' => "Découvrez la cité lacustre de Ganvié, construite sur pilotis, un site unique classé au patrimoine mondial de l'UNESCO."],
        ['title' => "L'Art du Tissage de Pagne", 'region' => 'Bohicon', 'langue' => 'Yoruba', 'type' => 'Artisanat', 'img' => 'https://images.unsplash.com/photo-1596383525733-6d5fbb0d852e?fit=crop&w=600&q=80', 'snippet' => "Explorez les techniques ancestrales de tissage des pagnes béninois, symboles d'identité et de statut social."],
        ['title' => "Saveurs du Bénin", 'region' => 'Tout le Bénin', 'langue' => 'Français', 'type' => 'Gastronomie', 'img' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?fit=crop&w=600&q=80', 'snippet' => "Découvrez la richesse de la cuisine béninoise, du poulet bicyclette à l'akassa, en passant par les délicieux plats de maïs."],
    ];
@endphp

@foreach($cards as $card)
<a href="#" class="block bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl group transform hover:-translate-y-1 duration-300">
    <div class="relative overflow-hidden">
        <img src="{{ $card['img'] }}" 
             alt="{{ $card['title'] }}" 
             class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500">
        <div class="absolute top-4 left-4 bg-savane-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
            {{ $card['type'] }}
        </div>
    </div>
    <div class="p-6">
        <div class="text-xs font-semibold text-lagune-700 uppercase mb-1">{{ $card['region'] }}</div>
        <h3 class="font-title text-xl font-bold text-gray-900 mb-2 group-hover:text-savane-500 transition-colors">{{ $card['title'] }}</h3>
        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
            {{ $card['snippet'] }}
        </p>
        <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-4">
            <span class="flex items-center space-x-1">
                <i data-lucide="calendar" class="w-4 h-4 text-lagune-700"></i>
                <span class="text-gray-600">Publié récemment</span>
            </span>
            <span class="font-semibold text-gray-700 bg-ocre-100 px-3 py-1 rounded-full text-xs border border-gray-300">{{ $card['langue'] }}</span>
        </div>
    </div>
</a>
@endforeach