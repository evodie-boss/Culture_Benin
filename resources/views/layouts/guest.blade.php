<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Culture Bénin | @yield('title', 'Portail de Découverte')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lightbox pour les galeries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    
    <style>
        :root {
            --primary-green: #16a34a;
            --primary-dark: #15803d;
            --secondary-teal: #0d9488;
            --accent-amber: #d97706;
            --earth-brown: '#92400e';
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); 
            color: #1e293b; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content {
            flex: 1;
        }
        
        .heading-font {
            font-family: 'Playfair Display', serif;
        }
        
        .hover-lift { 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        
        .hover-lift:hover { 
            transform: translateY(-6px); 
            box-shadow: 0 20px 40px rgba(22, 163, 74, 0.1); 
        }
        
        .nav-link { 
            position: relative; 
            transition: color 0.3s ease;
        }
        
        .nav-link::after { 
            content: ''; 
            position: absolute; 
            width: 0; 
            height: 3px; 
            bottom: -6px; 
            left: 0; 
            background: linear-gradient(90deg, var(--primary-green), var(--secondary-teal));
            border-radius: 2px;
            transition: width .4s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        
        .nav-link:hover::after { 
            width: 100%; 
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-dark));
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(22, 163, 74, 0.25);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(22, 163, 74, 0.35);
            background: linear-gradient(135deg, var(--primary-dark), #166534);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-teal), #0f766e);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 148, 136, 0.3);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .animate-slide-up {
            animation: slideUp 0.6s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, var(--primary-green), var(--primary-dark));
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, var(--primary-dark), #166534);
        }
        
        /* Selection color */
        ::selection {
            background-color: rgba(22, 163, 74, 0.2);
            color: #1e293b;
        }
        
        .language-selector:hover .language-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .language-dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .border-gradient {
            border-image: linear-gradient(135deg, var(--primary-green), var(--secondary-teal)) 1;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased">

<!-- =================================== NAVBAR MODERNISÉE =================================== -->
<nav class="sticky top-0 z-50 glass-effect shadow-lg border-b border-green-100/30 animate-slide-up">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo avec animation -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500 shadow-lg">
                        <i class="fas fa-leaf text-white text-xl"></i>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-br from-teal-500 to-teal-700 rounded-full"></div>
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-bold text-gradient heading-font">Culture Bénin</span>
                    <span class="text-xs text-secondary-600 font-medium">Patrimoine & Traditions</span>
                </div>
            </a>

            <!-- Desktop menu -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ url('/regions') }}" class="nav-link px-5 py-2 text-secondary-700 hover:text-green-700 font-medium text-sm uppercase tracking-wide {{ request()->is('regions*') ? 'active text-green-700' : '' }}">
                    <i class="fas fa-map-marked-alt mr-2 text-sm"></i>Régions
                </a>
                <a href="{{ url('/langues') }}" class="nav-link px-5 py-2 text-secondary-700 hover:text-green-700 font-medium text-sm uppercase tracking-wide {{ request()->is('langues*') ? 'active text-green-700' : '' }}">
                    <i class="fas fa-language mr-2 text-sm"></i>Langues
                </a>
                <a href="{{ url('/contenus') }}" class="nav-link px-5 py-2 text-secondary-700 hover:text-green-700 font-medium text-sm uppercase tracking-wide {{ request()->is('contenus*') ? 'active text-green-700' : '' }}">
                    <i class="fas fa-book-open mr-2 text-sm"></i>Contenus
                </a>
                <a href="{{ url('/galeries') }}" class="nav-link px-5 py-2 text-secondary-700 hover:text-green-700 font-medium text-sm uppercase tracking-wide {{ request()->is('galeries*') ? 'active text-green-700' : '' }}">
                    <i class="fas fa-images mr-2 text-sm"></i>Galeries
                </a>
                <a href="{{ url('/evenements') }}" class="nav-link px-5 py-2 text-secondary-700 hover:text-green-700 font-medium text-sm uppercase tracking-wide {{ request()->is('evenements*') ? 'active text-green-700' : '' }}">
                    <i class="fas fa-calendar-alt mr-2 text-sm"></i>Événements
                </a>
            </div>

            <!-- Desktop droite – Menu intelligent selon rôle -->
            <div class="hidden lg:flex items-center space-x-4">

                <!-- Recherche avec animation -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-secondary-400 group-hover:text-green-500 transition-colors"></i>
                    </div>
                    <input type="search" 
                           placeholder="Rechercher un contenu..." 
                           class="pl-10 pr-4 py-2.5 border border-secondary-200 rounded-full text-sm w-64 bg-white/80 focus:bg-white focus:w-72 focus:ring-2 focus:ring-green-500/30 focus:border-green-400 transition-all duration-300 outline-none">
                </div>

                <!-- Sélecteur langue amélioré -->
                <div class="relative language-selector">
                    <button class="flex items-center space-x-2 px-4 py-2.5 rounded-full border border-secondary-200 bg-white/80 hover:bg-white hover:border-green-300 hover:shadow-md transition-all duration-300">
                        <i class="fas fa-globe-africa text-green-600"></i>
                        <span class="text-sm font-medium text-secondary-700">Français</span>
                        <i class="fas fa-chevron-down text-secondary-400 text-xs"></i>
                    </button>
                    <div class="language-dropdown absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-2xl border border-secondary-100 overflow-hidden z-50">
                        <div class="p-2">
                            <div class="px-3 py-2 text-xs font-semibold text-secondary-500 uppercase tracking-wider">Langues disponibles</div>
                            <a href="#" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-green-50 hover:text-green-700 transition-colors rounded-lg">
                                <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-flag text-blue-600 text-xs"></i>
                                </span>
                                <span>Français</span>
                                <span class="ml-auto text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Défaut</span>
                            </a>
                            <a href="#" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-green-50 hover:text-green-700 transition-colors rounded-lg">
                                <span class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-green-700 font-bold text-xs">F</span>
                                </span>
                                <span>Fon</span>
                            </a>
                            <a href="#" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-green-50 hover:text-green-700 transition-colors rounded-lg">
                                <span class="w-6 h-6 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-amber-700 font-bold text-xs">Y</span>
                                </span>
                                <span>Yoruba</span>
                            </a>
                            <a href="#" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-green-50 hover:text-green-700 transition-colors rounded-lg">
                                <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-purple-700 font-bold text-xs">D</span>
                                </span>
                                <span>Dendi</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Menu selon rôle -->
                @guest
                    <a href="{{ route('login') }}" class="btn-primary">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </a>
                @else
                    <!-- Notifications -->
                    <button class="relative p-2 text-secondary-600 hover:text-green-600 hover:bg-green-50 rounded-full transition-colors">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Menu utilisateur -->
                    <div class="relative group">
                        <button class="flex items-center space-x-3 p-2 hover:bg-secondary-50 rounded-2xl transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="text-left hidden xl:block">
                                <div class="text-sm font-semibold text-secondary-800">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-secondary-500">
                                    @if(auth()->user()->estAdmin())
                                        Administrateur
                                    @elseif(auth()->user()->estContributeur())
                                        Contributeur
                                    @else
                                        Lecteur
                                    @endif
                                </div>
                            </div>
                            <i class="fas fa-chevron-down text-secondary-400 text-xs"></i>
                        </button>
                        
                        <div class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-2xl border border-secondary-100 overflow-hidden opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="p-4 border-b border-secondary-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-secondary-800">{{ auth()->user()->name }}</div>
                                        <div class="text-xs text-secondary-500">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-2">
                                @if(auth()->user()->estLecteur())
                                    <a href="#" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-green-50 hover:text-green-700 transition-colors rounded-lg">
                                        <i class="fas fa-heart text-green-500 w-5 mr-3"></i>
                                        Mes favoris
                                    </a>
                                    <a href="{{ route('devenir-contributeur') }}" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-teal-50 hover:text-teal-700 transition-colors rounded-lg">
                                        <i class="fas fa-user-plus text-teal-500 w-5 mr-3"></i>
                                        Devenir contributeur
                                    </a>
                                @endif
                                
                                @if(auth()->user()->estContributeur())
                                    <a href="/dashboard" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-blue-50 hover:text-blue-700 transition-colors rounded-lg">
                                        <i class="fas fa-tachometer-alt text-blue-500 w-5 mr-3"></i>
                                        Mon espace
                                    </a>
                                @endif
                                
                                @if(auth()->user()->estAdmin())
                                    <a href="/admin" class="flex items-center px-4 py-3 text-sm text-secondary-700 hover:bg-red-50 hover:text-red-700 transition-colors rounded-lg">
                                        <i class="fas fa-cog text-red-500 w-5 mr-3"></i>
                                        Administration
                                    </a>
                                @endif
                                
                                <div class="border-t border-secondary-100 mt-2 pt-2">
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors rounded-lg">
                                            <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                            Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="p-3 rounded-xl text-secondary-600 hover:text-green-700 hover:bg-green-50 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden lg:hidden glass-effect border-t border-secondary-200/50 shadow-xl">
        <div class="max-w-8xl mx-auto px-4 py-6">
            <div class="flex flex-col space-y-1">
                <a href="{{ url('/') }}" class="flex items-center px-4 py-3 text-secondary-700 hover:bg-green-50 hover:text-green-700 rounded-xl transition-colors {{ request()->is('/') ? 'bg-green-50 text-green-700' : '' }}">
                    <i class="fas fa-home w-5 mr-3"></i>
                    Accueil
                </a>
                <a href="{{ url('/regions') }}" class="flex items-center px-4 py-3 text-secondary-700 hover:bg-green-50 hover:text-green-700 rounded-xl transition-colors {{ request()->is('regions*') ? 'bg-green-50 text-green-700' : '' }}">
                    <i class="fas fa-map-marked-alt w-5 mr-3"></i>
                    Régions
                </a>
                <a href="{{ url('/langues') }}" class="flex items-center px-4 py-3 text-secondary-700 hover:bg-green-50 hover:text-green-700 rounded-xl transition-colors {{ request()->is('langues*') ? 'bg-green-50 text-green-700' : '' }}">
                    <i class="fas fa-language w-5 mr-3"></i>
                    Langues
                </a>
                <a href="{{ url('/contenus') }}" class="flex items-center px-4 py-3 text-secondary-700 hover:bg-green-50 hover:text-green-700 rounded-xl transition-colors {{ request()->is('contenus*') ? 'bg-green-50 text-green-700' : '' }}">
                    <i class="fas fa-book-open w-5 mr-3"></i>
                    Contenus
                </a>
                <a href="{{ url('/galeries') }}" class="flex items-center px-4 py-3 text-secondary-700 hover:bg-green-50 hover:text-green-700 rounded-xl transition-colors {{ request()->is('galeries*') ? 'bg-green-50 text-green-700' : '' }}">
                    <i class="fas fa-images w-5 mr-3"></i>
                    Galeries
                </a>
                <a href="{{ url('/evenements') }}" class="flex items-center px-4 py-3 text-secondary-700 hover:bg-green-50 hover:text-green-700 rounded-xl transition-colors {{ request()->is('evenements*') ? 'bg-green-50 text-green-700' : '' }}">
                    <i class="fas fa-calendar-alt w-5 mr-3"></i>
                    Événements
                </a>
                
                <div class="border-t border-secondary-200 mt-4 pt-4">
                    @guest
                        <a href="{{ route('login') }}" class="block w-full text-center btn-primary py-3">
                            <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                        </a>
                    @else
                        <div class="px-4 py-3">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-secondary-800">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-secondary-500">
                                        @if(auth()->user()->estAdmin())
                                            Administrateur
                                        @elseif(auth()->user()->estContributeur())
                                            Contributeur
                                        @else
                                            Lecteur
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            @if(auth()->user()->estLecteur())
                                <a href="{{ route('devenir-contributeur') }}" class="flex items-center w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white px-4 py-3 rounded-xl font-bold mb-3 shadow-md">
                                    <i class="fas fa-user-plus mr-3"></i>
                                    Devenir contributeur
                                </a>
                            @endif
                            
                            @if(auth()->user()->estContributeur())
                                <a href="/dashboard" class="flex items-center w-full px-4 py-3 text-secondary-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl mb-2">
                                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                                    Mon espace
                                </a>
                            @endif
                            
                            @if(auth()->user()->estAdmin())
                                <a href="/admin" class="flex items-center w-full px-4 py-3 text-secondary-700 hover:bg-red-50 hover:text-red-700 rounded-xl mb-2">
                                    <i class="fas fa-cog w-5 mr-3"></i>
                                    Administration
                                </a>
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-red-600 hover:bg-red-50 px-4 py-3 rounded-xl">
                                    <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- =================================== CONTENU PRINCIPAL =================================== -->
<main class="main-content">
    @yield('content')
</main>

<!-- =================================== FOOTER MODERNISÉ =================================== -->
<footer class="bg-gradient-to-br from-secondary-900 to-secondary-800 text-white mt-20">
    <!-- Wave separator -->
    <div class="relative -top-1">
        <svg class="w-full h-12" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 100C120 80 240 40 360 30C480 20 600 40 720 50C840 60 960 60 1080 45C1200 30 1320 0 1380 0H1440V120H0Z" 
                  fill="white"/>
        </svg>
    </div>
    
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            <!-- Colonne 1 : Logo et description -->
            <div class="lg:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-leaf text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white heading-font">Culture Bénin</div>
                        <div class="text-green-300 text-sm font-medium">Patrimoine & Traditions</div>
                    </div>
                </div>
                <p class="text-secondary-300 leading-relaxed mb-8 max-w-lg">
                    Portail numérique dédié à la préservation, valorisation et diffusion du patrimoine culturel 
                    et linguistique du Bénin. Rejoignez notre communauté pour découvrir, partager et célébrer 
                    la richesse de nos traditions.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-12 h-12 bg-secondary-800 hover:bg-green-600 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-green-500/25">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-secondary-800 hover:bg-green-500 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-green-400/25">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-secondary-800 hover:bg-green-400 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-green-300/25">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-secondary-800 hover:bg-red-600 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-red-600/25">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Colonne 2 : Liens rapides -->
            <div>
                <h4 class="text-xl font-bold mb-6 text-white heading-font">Navigation</h4>
                <ul class="space-y-3">
                    <li><a href="{{ url('/') }}" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2 text-green-400"></i>Accueil
                    </a></li>
                    <li><a href="{{ url('/regions') }}" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2 text-green-400"></i>Régions culturelles
                    </a></li>
                    <li><a href="{{ url('/langues') }}" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2 text-green-400"></i>Langues nationales
                    </a></li>
                    <li><a href="{{ url('/contenus') }}" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2 text-green-400"></i>Contenus culturels
                    </a></li>
                </ul>
            </div>

            <!-- Colonne 3 : Contribuer -->
            <div>
                <h4 class="text-xl font-bold mb-6 text-white heading-font">Contribuer</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('devenir-contributeur') }}" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-user-plus text-sm mr-2 text-teal-300"></i>Devenir contributeur
                    </a></li>
                    <li><a href="#" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-upload text-sm mr-2 text-green-300"></i>Soumettre un contenu
                    </a></li>
                    <li><a href="#" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-translate text-sm mr-2 text-amber-300"></i>Proposer une traduction
                    </a></li>
                    <li><a href="#" class="text-secondary-300 hover:text-green-300 transition-colors flex items-center">
                        <i class="fas fa-handshake text-sm mr-2 text-blue-300"></i>Partenariats
                    </a></li>
                </ul>
            </div>

            <!-- Colonne 4 : Contact -->
            <div>
                <h4 class="text-xl font-bold mb-6 text-white heading-font">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-envelope text-green-400 mt-1 mr-3"></i>
                        <span class="text-secondary-300">contact@culturebenin.bj</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone text-green-400 mt-1 mr-3"></i>
                        <span class="text-secondary-300">+229 XX XX XX XX</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-green-400 mt-1 mr-3"></i>
                        <span class="text-secondary-300">Cotonou, Bénin</span>
                    </li>
                    <li class="mt-6">
                        <a href="#" class="inline-flex items-center text-green-300 hover:text-green-200 font-medium">
                            <i class="fas fa-question-circle mr-2"></i>
                            Centre d'aide
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-secondary-700">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-secondary-400 text-sm mb-4 md:mb-0">
                    <p>&copy; {{ date('Y') }} Plateforme Culture Bénin. Tous droits réservés.</p>
                    <p class="mt-1 text-xs">Projet de préservation du patrimoine culturel et linguistique.</p>
                </div>
                <div class="flex space-x-6 text-sm text-secondary-400">
                    <a href="#" class="hover:text-green-300 transition-colors">Politique de confidentialité</a>
                    <a href="#" class="hover:text-green-300 transition-colors">Conditions d'utilisation</a>
                    <a href="#" class="hover:text-green-300 transition-colors">Mentions légales</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- =================================== SCRIPTS =================================== -->
<script>
    // Menu mobile toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            const icon = mobileMenuButton.querySelector('i');
            if (mobileMenu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });
    }
    
    // Fermer le menu mobile en cliquant à l'extérieur
    document.addEventListener('click', (event) => {
        if (mobileMenu && !mobileMenu.contains(event.target) && 
            mobileMenuButton && !mobileMenuButton.contains(event.target) && 
            !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            const icon = mobileMenuButton.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
    
    // Animation au scroll
    document.addEventListener('DOMContentLoaded', () => {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);
        
        // Observer les sections importantes
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    });
    
    // Lightbox (si utilisée)
    if (typeof lightbox !== 'undefined') {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Image %1 sur %2",
            'fadeDuration': 300
        });
    }
</script>

@stack('scripts')
</body>
</html>