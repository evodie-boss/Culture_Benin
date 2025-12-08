<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Culture Bénin | @yield('title', 'Administration')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #D35400;
            --primary-light: #FDEBD0;
            --text-dark: #2C3E50;
            --bg-light: #F3F4F6;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Layout Principal -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-xl border-r border-gray-200 flex flex-col">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-100 bg-white px-4">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-3 no-underline">
                    <img src="{{ asset('adminlte/img/logo.png') }}" alt="Logo" class="h-8 w-8">
                    <span class="text-xl font-bold text-gray-900">Culture Bénin</span>
                </a>
            </div>

            <!-- Navigation COMPLÈTE -->
            <nav class="flex-1 px-4 py-6 overflow-y-auto">
                <ul class="space-y-1">
                    <!-- Tableau de bord -->
                    <li>
                        <a href="{{ url('/admin/dashboard') }}" 
                           class="flex items-center px-3 py-3 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->is('admin/dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                            <i class="fas fa-grid text-lg w-6 text-gray-400 group-hover:text-blue-600 {{ request()->is('admin/dashboard') ? 'text-blue-600' : '' }}"></i>
                            <span class="ml-3 font-medium">Tableau de bord</span>
                        </a>
                    </li>

                    <!-- Paramètres Section -->
                    <li class="mt-6">
                        <div class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                            <i class="fas fa-sliders-h mr-2"></i>
                            Paramètres
                        </div>
                        
                        <!-- Données -->
                        <div class="mb-4">
                            <div class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                Données
                            </div>
                            <ul class="space-y-1">
                                <li>
                                    <a href="{{ route('admin.contenus.index') }}" 
                                       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('contenus.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                                        <i class="fas fa-book-open text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('contenus.*') ? 'text-blue-600' : '' }}"></i>
                                        <span class="ml-3">Contenus Culturels</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.commentaires.index') }}" 
                                       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('commentaires.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                                        <i class="fas fa-comments text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('commentaires.*') ? 'text-blue-600' : '' }}"></i>
                                        <span class="ml-3">Commentaires</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.medias.index') }}" 
                                       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('medias.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                                        <i class="fas fa-images text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('medias.*') ? 'text-blue-600' : '' }}"></i>
                                        <span class="ml-3">Médias</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.users.index') }}" 
                                       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('utilisateurs.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                                        <i class="fas fa-users text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('users.*') ? 'text-blue-600' : '' }}"></i>
                                        <span class="ml-3">Utilisateurs</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Configuration -->
                        <div>
                            <div class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                                Configuration
                            </div>
                            <ul class="space-y-1">
                                <!-- Langues -->
                                <li>
                                    <div class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg cursor-pointer hover:bg-blue-50 transition-all duration-200 {{ request()->routeIs('langues.*') ? 'bg-blue-50 border-r-2 border-blue-600' : '' }}">
                                        <div class="flex items-center">
                                            <i class="fas fa-language text-sm w-6 text-gray-400 {{ request()->routeIs('langues.*') ? 'text-blue-600' : '' }}"></i>
                                            <span class="ml-3 font-medium {{ request()->routeIs('langues.*') ? 'text-blue-700' : '' }}">Langues</span>
                                        </div>
                                        <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200 {{ request()->routeIs('langues.*') ? 'rotate-180' : '' }}"></i>
                                    </div>
                                    <ul class="mt-1 ml-6 space-y-1 {{ request()->routeIs('langues.*') ? 'block' : 'hidden' }}">
                                        <li>
                                            <a href="{{ route('admin.langues.index') }}" 
                                               class="flex items-center px-3 py-2 text-sm text-gray-600 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('langues.index') ? 'text-blue-700 bg-blue-50' : '' }}">
                                                <i class="fas fa-list w-4 mr-2"></i>
                                                Voir la liste
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.langues.create') }}" 
                                               class="flex items-center px-3 py-2 text-sm text-gray-600 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('langues.create') ? 'text-blue-700 bg-blue-50' : '' }}">
                                                <i class="fas fa-plus w-4 mr-2"></i>
                                                Nouvelle langue
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Régions -->
                                <li>
                                    <div class="flex items-center justify-between px-3 py-2 text-gray-700 rounded-lg cursor-pointer hover:bg-blue-50 transition-all duration-200 {{ request()->routeIs('regions.*') ? 'bg-blue-50 border-r-2 border-blue-600' : '' }}">
                                        <div class="flex items-center">
                                            <i class="fas fa-map text-sm w-6 text-gray-400 {{ request()->routeIs('regions.*') ? 'text-blue-600' : '' }}"></i>
                                            <span class="ml-3 font-medium {{ request()->routeIs('regions.*') ? 'text-blue-700' : '' }}">Régions</span>
                                        </div>
                                        <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200 {{ request()->routeIs('regions.*') ? 'rotate-180' : '' }}"></i>
                                    </div>
                                    <ul class="mt-1 ml-6 space-y-1 {{ request()->routeIs('regions.*') ? 'block' : 'hidden' }}">
                                        <li>
                                            <a href="{{ route('admin.regions.index') }}" 
                                               class="flex items-center px-3 py-2 text-sm text-gray-600 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('regions.index') ? 'text-blue-700 bg-blue-50' : '' }}">
                                                <i class="fas fa-list w-4 mr-2"></i>
                                                Voir la liste
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.regions.create') }}" 
                                               class="flex items-center px-3 py-2 text-sm text-gray-600 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('regions.create') ? 'text-blue-700 bg-blue-50' : '' }}">
                                                <i class="fas fa-plus w-4 mr-2"></i>
                                                Nouvelle région
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Types de Contenus -->
                                <li>
                                    <a href="{{ route('admin.type-contenus.index') }}" 
                                       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('type-contenus.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                                        <i class="fas fa-tasks text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('type-contenus.*') ? 'text-blue-600' : '' }}"></i>
                                        <span class="ml-3">Types de contenus</span>
                                    </a>
                                </li>

                                <!-- Types de Médias -->
                                <li>
                                    <a href="{{ route('admin.type-medias.index') }}" 
                                       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('type-medias.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                                        <i class="fas fa-photo-video text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('type-medias.*') ? 'text-blue-600' : '' }}"></i>
                                        <span class="ml-3">Types de médias</span>
                                    </a>
                                </li>

                                <!-- Rôles -->
                                <li>
                                    <a href="{{ route('admin.roles.index') }}" 
                                       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('roles.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
                                        <i class="fas fa-user-shield text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('roles.*') ? 'text-blue-600' : '' }}"></i>
                                        <span class="ml-3">Rôles & Permissions</span>
                                    </a>
                                </li>

<!-- AJOUTEZ CETTE LIGNE DANS LA SECTION CONFIGURATION -->
<!-- Demandez contributeur -->
<li>
    <a href="{{ route('admin.demandes.index') }}" 
       class="flex items-center px-3 py-2 text-gray-700 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 group {{ request()->routeIs('admin.demandes.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : '' }}">
        <i class="fas fa-user-check text-sm w-6 text-gray-400 group-hover:text-blue-600 {{ request()->routeIs('admin.demandes.*') ? 'text-blue-600' : '' }}"></i>
        <span class="ml-3">Demandes contributeur</span>
        @php
            $pendingCount = \App\Models\DemandeContributeur::where('statut', 'en_attente')->count();
        @endphp
        @if($pendingCount > 0)
        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
            {{ $pendingCount }}
        </span>
        @endif
    </a>
</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Footer Sidebar -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="text-center text-gray-500 text-sm">
                    &copy; 2024 Culture Bénin
                </div>
            </div>
        </aside>

        <!-- Contenu Principal -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between h-16 px-6">
                    <!-- Bouton Menu Mobile -->
                    <button class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <!-- Titre de la page -->
                    <div class="flex-1 ml-4">
                        <h1 class="text-xl font-bold text-gray-900 truncate">
                            @yield('page-title', 'Administration')
                        </h1>
                    </div>

                    <!-- Profil Utilisateur -->
                    <div class="relative">
                        <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-green-400 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium text-gray-900">Administrateur</p>
                                <p class="text-xs text-gray-500">Super Admin</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 hidden z-50">
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-user mr-3 text-gray-400"></i>
                                Mon Profil
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <i class="fas fa-power-off mr-3"></i>
                                Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Contenu -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                <!-- Section Title (comme dans les autres pages) -->
                <div class="mb-6">
                    @yield('title')
                </div>

                <!-- Messages Flash -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Contenu de la page -->
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4">
                <div class="text-center text-gray-500 text-sm">
                    &copy; 2024 Culture Bénin - Administration
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du menu mobile
            const mobileMenuButton = document.querySelector('button.lg\\:hidden');
            const sidebar = document.querySelector('aside');
            
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                    sidebar.classList.toggle('absolute');
                    sidebar.classList.toggle('z-50');
                });
            }

            // Gestion des dropdowns du menu
            const menuItems = document.querySelectorAll('li > div.flex.items-center.justify-between');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    const submenu = this.nextElementSibling;
                    const icon = this.querySelector('.fa-chevron-down');
                    
                    if (submenu) {
                        submenu.classList.toggle('hidden');
                        icon.classList.toggle('rotate-180');
                    }
                });
            });

            // Gestion du dropdown utilisateur
            const userButton = document.querySelector('header button.flex.items-center.space-x-3');
            const userDropdown = document.querySelector('header .absolute.hidden');

            if (userButton && userDropdown) {
                userButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });

                // Fermer le dropdown en cliquant ailleurs
                document.addEventListener('click', function() {
                    userDropdown.classList.add('hidden');
                });

                userDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // Animation d'entrée pour le contenu principal
            const mainContent = document.querySelector('main');
            if (mainContent) {
                mainContent.style.opacity = '0';
                mainContent.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    mainContent.style.transition = 'all 0.4s ease';
                    mainContent.style.opacity = '1';
                    mainContent.style.transform = 'translateY(0)';
                }, 100);
            }
        });

        // Gestion du responsive
        function handleResize() {
            const sidebar = document.querySelector('aside');
            if (window.innerWidth < 1024) {
                sidebar.classList.add('hidden', 'absolute', 'z-50');
            } else {
                sidebar.classList.remove('hidden', 'absolute', 'z-50');
            }
        }

        window.addEventListener('resize', handleResize);
        window.addEventListener('load', handleResize);
    </script>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.2s ease;
        }

        /* Amélioration de l'apparence des dropdowns */
        .absolute {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        /* Animation pour les sous-menus */
        .hidden {
            display: none;
        }

        /* Effet de hover amélioré */
        .hover-lift:hover {
            transform: translateY(-1px);
            transition: transform 0.2s ease;
        }
    </style>
</body>
</html>