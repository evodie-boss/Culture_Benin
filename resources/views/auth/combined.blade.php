<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bénin Culture | Connexion</title>
    
    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Boxicons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        :root {
            --primary: #008751; /* Vert Bénin */
            --primary-light: #4CAF50;
            --accent: #FCD116; /* Jaune Bénin */
            --text: #333333;
            --text-light: #666666;
            --bg: #f8fafc;
            --border: #e2e8f0;
        }
        
        .form-transition .form-section {
            transition: transform 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55), opacity 0.8s ease;
        }
        
        .curved-shape {
            background: linear-gradient(135deg, rgba(0, 135, 81, 0.1) 0%, rgba(252, 209, 22, 0.05) 100%);
            clip-path: ellipse(150% 100% at 50% 0%);
        }
        
        .input-focus:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 135, 81, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #006b40 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 135, 81, 0.2);
        }
        
        .active-tab {
            background: white;
            color: var(--primary);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container form-transition" id="authContainer">
        <!-- Forme courbe décorative -->
        <div class="curved-shape absolute top-0 left-0 w-full h-2/3"></div>
        
        <!-- Logo et navigation -->
        <div class="relative z-10 pt-8 px-6">
            <div class="flex justify-between items-center max-w-6xl mx-auto">
                <!-- Logo -->
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-yellow-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">B</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-800">Bénin<span class="text-green-600">Culture</span></span>
                </a>
                
                <!-- Langue -->
                <select class="bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-green-500">
                    <option>🇫🇷 Français</option>
                    <option>🇧🇯 Fon</option>
                    <option>🇧🇯 Yoruba</option>
                </select>
            </div>
        </div>
        
        <!-- Container principal -->
        <div class="relative z-10 max-w-5xl mx-auto mt-12 px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="flex flex-col md:flex-row min-h-[500px]">
                    
                    <!-- Section Login (Visible par défaut) -->
                    <div class="form-section md:w-1/2 p-8 md:p-12 flex flex-col justify-center" id="loginSection">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Content de vous revoir</h2>
                        <p class="text-gray-600 mb-8">Connectez-vous pour contribuer à notre patrimoine culturel</p>
                        
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            
                            <!-- Champ Email -->
                            <div class="relative">
                                <box-icon name='envelope' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                <input type="email" 
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none @error('email') border-red-500 @enderror"
                                       placeholder="Adresse email">
                                @error('email')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Champ Mot de passe -->
                            <div class="relative">
                                <box-icon name='lock-alt' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                <input type="password" 
                                       name="password"
                                       required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none @error('password') border-red-500 @enderror"
                                       placeholder="Mot de passe">
                                @error('password')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Remember me & Forgot password -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-700">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                            </div>
                            
                            <!-- Bouton Submit -->
                            <button type="submit" class="w-full btn-primary text-white font-semibold py-3 rounded-lg">
                                Se connecter
                            </button>
                            
                            <!-- Lien pour s'inscrire -->
                            <p class="text-center text-gray-600 text-sm">
                                Pas encore de compte ? 
                                <a href="#" id="showRegister" class="text-green-600 font-semibold hover:text-green-700 ml-1">
                                    Créer un compte
                                </a>
                            </p>
                        </form>
                    </div>
                    
                    <!-- Section Register (Cachée par défaut) -->
                    <div class="form-section md:w-1/2 p-8 md:p-12 flex flex-col justify-center absolute inset-0 transform translate-x-full opacity-0" id="registerSection">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Rejoignez-nous</h2>
                        <p class="text-gray-600 mb-8">Créez votre compte pour partager notre culture</p>
                        
                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf
                            
                            <!-- Prénom et Nom -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="relative">
                                    <box-icon name='user' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                    <input type="text" 
                                           name="prenom"
                                           value="{{ old('prenom') }}"
                                           required
                                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none @error('prenom') border-red-500 @enderror"
                                           placeholder="Prénom">
                                </div>
                                <div class="relative">
                                    <input type="text" 
                                           name="nom"
                                           value="{{ old('nom') }}"
                                           required
                                           class="w-full px-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none @error('nom') border-red-500 @enderror"
                                           placeholder="Nom">
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="relative">
                                <box-icon name='envelope' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                <input type="email" 
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none @error('email') border-red-500 @enderror"
                                       placeholder="Adresse email">
                            </div>
                            
                            <!-- Sexe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                                <div class="flex space-x-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="sexe" value="M" {{ old('sexe') == 'M' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-gray-600">Homme</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="sexe" value="F" {{ old('sexe') == 'F' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-gray-600">Femme</span>
                                    </label>
                                </div>
                                @error('sexe')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Date de naissance -->
                            <div class="relative">
                                <box-icon name='calendar' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                <input type="date" 
                                       name="date_naissance"
                                       value="{{ old('date_naissance') }}"
                                       required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none @error('date_naissance') border-red-500 @enderror">
                            </div>
                            
                            <!-- Langue préférée -->
                            <div class="relative">
                                <box-icon name='globe' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                <select name="id_langue" 
                                        required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none appearance-none bg-white @error('id_langue') border-red-500 @enderror">
                                    <option value="">Choisissez votre langue</option>
                                    <option value="1" {{ old('id_langue') == 1 ? 'selected' : '' }}>Fon</option>
                                    <option value="2" {{ old('id_langue') == 2 ? 'selected' : '' }}>Yoruba</option>
                                    <option value="3" {{ old('id_langue') == 3 ? 'selected' : '' }}>Dendi</option>
                                    <option value="4" {{ old('id_langue') == 4 ? 'selected' : '' }}>Goun</option>
                                </select>
                            </div>
                            
                            <!-- Mot de passe -->
                            <div class="relative">
                                <box-icon name='lock-alt' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                <input type="password" 
                                       name="password"
                                       required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none @error('password') border-red-500 @enderror"
                                       placeholder="Mot de passe">
                            </div>
                            
                            <!-- Confirmation mot de passe -->
                            <div class="relative">
                                <box-icon name='lock' type='solid' class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></box-icon>
                                <input type="password" 
                                       name="password_confirmation"
                                       required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg input-focus focus:outline-none"
                                       placeholder="Confirmez le mot de passe">
                            </div>
                            
                            <!-- Bouton Submit -->
                            <button type="submit" class="w-full btn-primary text-white font-semibold py-3 rounded-lg">
                                Créer mon compte
                            </button>
                            
                            <!-- Lien pour se connecter -->
                            <p class="text-center text-gray-600 text-sm">
                                Déjà un compte ? 
                                <a href="#" id="showLogin" class="text-green-600 font-semibold hover:text-green-700 ml-1">
                                    Se connecter
                                </a>
                            </p>
                        </form>
                    </div>
                    
                    <!-- Section d'information (Côté droit) -->
                    <div class="md:w-1/2 bg-gradient-to-br from-green-50 to-yellow-50 p-8 md:p-12 flex flex-col justify-center relative">
                        <!-- Message dynamique -->
                        <div id="welcomeMessage" class="transition-all duration-700">
                            <h2 class="text-4xl font-bold text-gray-800 mb-4">Bienvenue sur <span class="text-green-600">BéninCulture</span></h2>
                            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                Rejoignez notre communauté dédiée à la préservation et à la promotion du riche patrimoine culturel et linguistique du Bénin.
                            </p>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <box-icon name='check-circle' type='solid' class="text-green-500 mr-2"></box-icon>
                                    <span>Partagez des histoires et contes traditionnels</span>
                                </li>
                                <li class="flex items-center">
                                    <box-icon name='check-circle' type='solid' class="text-green-500 mr-2"></box-icon>
                                    <span>Contribuez avec des recettes culinaires locales</span>
                                </li>
                                <li class="flex items-center">
                                    <box-icon name='check-circle' type='solid' class="text-green-500 mr-2"></box-icon>
                                    <span>Promouvez les langues nationales béninoises</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Indicateur d'onglet (mobile) -->
                        <div class="flex md:hidden justify-center mt-8 space-x-2">
                            <button id="tabLogin" class="active-tab px-4 py-2 rounded-full text-sm font-medium">Connexion</button>
                            <button id="tabRegister" class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600">Inscription</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-8 text-gray-500 text-sm">
                <p>En vous inscrivant, vous acceptez nos <a href="#" class="text-green-600 hover:text-green-700">Conditions d'utilisation</a> et notre <a href="#" class="text-green-600 hover:text-green-700">Politique de confidentialité</a></p>
                <p class="mt-2">© 2024 BéninCulture. Tous droits réservés.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('authContainer');
            const loginSection = document.getElementById('loginSection');
            const registerSection = document.getElementById('registerSection');
            const welcomeMessage = document.getElementById('welcomeMessage');
            const showRegister = document.getElementById('showRegister');
            const showLogin = document.getElementById('showLogin');
            const tabLogin = document.getElementById('tabLogin');
            const tabRegister = document.getElementById('tabRegister');
            
            // Messages dynamiques
            const loginMessages = {
                title: "Content de vous revoir",
                text: "Connectez-vous pour contribuer à notre patrimoine culturel"
            };
            
            const registerMessages = {
                title: "Rejoignez notre communauté",
                text: "Créez votre compte pour partager et préserver notre culture béninoise"
            };
            
            // Afficher l'inscription
            showRegister.addEventListener('click', function(e) {
                e.preventDefault();
                container.classList.add('active');
                loginSection.style.transform = 'translateX(-100%)';
                loginSection.style.opacity = '0';
                registerSection.style.transform = 'translateX(0)';
                registerSection.style.opacity = '1';
                
                // Mettre à jour les messages
                welcomeMessage.innerHTML = `
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Devenez <span class="text-green-600">Contributeur</span></h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        En tant que contributeur, vous pouvez partager des histoires, recettes, et articles culturels dans votre langue maternelle.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <box-icon name='star' type='solid' class="text-yellow-500 mr-2"></box-icon>
                            <span>Créez du contenu dans les langues locales</span>
                        </li>
                        <li class="flex items-center">
                            <box-icon name='star' type='solid' class="text-yellow-500 mr-2"></box-icon>
                            <span>Ajoutez des médias (photos, audio, vidéos)</span>
                        </li>
                        <li class="flex items-center">
                            <box-icon name='star' type='solid' class="text-yellow-500 mr-2"></box-icon>
                            <span>Participez aux discussions communautaires</span>
                        </li>
                    </ul>
                `;
                
                // Mettre à jour les tabs mobiles
                tabLogin.classList.remove('active-tab');
                tabLogin.classList.add('bg-gray-100', 'text-gray-600');
                tabRegister.classList.add('active-tab');
                tabRegister.classList.remove('bg-gray-100', 'text-gray-600');
            });
            
            // Afficher la connexion
            showLogin.addEventListener('click', function(e) {
                e.preventDefault();
                container.classList.remove('active');
                loginSection.style.transform = 'translateX(0)';
                loginSection.style.opacity = '1';
                registerSection.style.transform = 'translateX(100%)';
                registerSection.style.opacity = '0';
                
                // Remettre les messages d'origine
                welcomeMessage.innerHTML = `
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Bienvenue sur <span class="text-green-600">BéninCulture</span></h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        Rejoignez notre communauté dédiée à la préservation et à la promotion du riche patrimoine culturel et linguistique du Bénin.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <box-icon name='check-circle' type='solid' class="text-green-500 mr-2"></box-icon>
                            <span>Partagez des histoires et contes traditionnels</span>
                        </li>
                        <li class="flex items-center">
                            <box-icon name='check-circle' type='solid' class="text-green-500 mr-2"></box-icon>
                            <span>Contribuez avec des recettes culinaires locales</span>
                        </li>
                        <li class="flex items-center">
                            <box-icon name='check-circle' type='solid' class="text-green-500 mr-2"></box-icon>
                            <span>Promouvez les langues nationales béninoises</span>
                        </li>
                    </ul>
                `;
                
                // Mettre à jour les tabs mobiles
                tabLogin.classList.add('active-tab');
                tabLogin.classList.remove('bg-gray-100', 'text-gray-600');
                tabRegister.classList.remove('active-tab');
                tabRegister.classList.add('bg-gray-100', 'text-gray-600');
            });
            
            // Tabs mobiles
            tabLogin.addEventListener('click', () => showLogin.click());
            tabRegister.addEventListener('click', () => showRegister.click());
            
            // Si erreurs dans le formulaire d'inscription, afficher directement l'inscription
            const hasRegisterErrors = @json($errors->has('prenom') || $errors->has('nom') || $errors->has('sexe') || $errors->has('date_naissance'));
            
            if (hasRegisterErrors) {
                showRegister.click();
            }
        });
    </script>
</body>
</html>