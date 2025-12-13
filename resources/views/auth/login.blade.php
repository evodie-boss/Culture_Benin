<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Culture Bénin</title>
    
    <!-- Tailwind en ligne -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#0a7c54', /* Vert Bénin sobre */
                        'primary-dark': '#065c3d',
                        'primary-light': '#e8f5f0',
                        'accent': '#e6b325', /* Jaune Bénin adouci */
                        'light': '#F8F9FA',
                        'border': '#E0E0E0'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Police Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f9fafb 0%, #f0f9f4 100%);
        }
        
        /* ===== ANIMATIONS COMPLÈTES ===== */
        .container {
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }
        
        .form-box {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            transition: 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 1;
            padding: 0 60px;
        }
        
        /* FORMULAIRE LOGIN */
        .form-box.Login {
            left: 0;
        }
        
        .form-box.Login .animation {
            transform: translateX(0%);
            transition: .7s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 1;
            transition-delay: calc(.1s * var(--S));
        }
        
        .container.active .form-box.Login .animation {
            transform: translateX(-120%);
            opacity: 0;
            filter: blur(5px);
            transition-delay: calc(.1s * var(--D));
        }
        
        /* FORMULAIRE REGISTER */
        .form-box.Register {
            right: 0;
        }
        
        .form-box.Register .animation {
            transform: translateX(120%);
            transition: .7s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            filter: blur(5px);
            transition-delay: calc(.1s * var(--S));
        }
        
        .container.active .form-box.Register .animation {
            transform: translateX(0%);
            opacity: 1;
            filter: blur(0px);
            transition-delay: calc(.1s * var(--li));
        }
        
        .form-box h2 {
            font-size: 36px;
            text-align: left;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }
        
        .form-box .subtitle {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 40px;
        }
        
        .form-box .input-box {
            position: relative;
            width: 100%;
            height: 60px;
            margin-top: 30px;
        }
        
        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
            color: #1f2937;
            font-weight: 500;
            border-bottom: 2px solid #e5e7eb;
            padding-right: 40px;
            transition: .5s;
        }
        
        .input-box input:focus,
        .input-box input:valid {
            border-bottom: 2px solid #0a7c54;
        }
        
        .input-box label {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 16px;
            color: #9ca3af;
            font-weight: 500;
            transition: .5s;
            pointer-events: none;
        }
        
        .input-box input:focus ~ label,
        .input-box input:valid ~ label {
            top: -10px;
            font-size: 14px;
            color: #0a7c54;
            font-weight: 600;
        }
        
        .input-box i {
            position: absolute;
            top: 50%;
            right: 0;
            font-size: 18px;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: .5s;
        }
        
        .input-box input:focus ~ i,
        .input-box input:valid ~ i {
            color: #0a7c54;
        }
        
        .btn {
            position: relative;
            width: 100%;
            height: 56px;
            background: linear-gradient(135deg, #0a7c54 0%, #065c3d 100%);
            border-radius: 16px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            border: none;
            overflow: hidden;
            z-index: 1;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(10, 124, 84, 0.2);
            margin-top: 20px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(10, 124, 84, 0.3);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .regi-link {
            font-size: 15px;
            text-align: center;
            margin: 25px 0 10px;
            color: #6b7280;
        }
        
        .regi-link a {
            text-decoration: none;
            color: #0a7c54;
            font-weight: 600;
            position: relative;
            display: inline-block;
            padding: 5px 0;
        }
        
        .regi-link a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #0a7c54;
            transition: width 0.3s ease;
        }
        
        .regi-link a:hover::after {
            width: 100%;
        }
        
        /* INFO PANELS */
        .info-content {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 0 60px;
        }
        
        .info-content.Login {
            right: 0;
            text-align: right;
            background: linear-gradient(135deg, rgba(10, 124, 84, 0.05) 0%, rgba(230, 179, 37, 0.02) 100%);
        }
        
        .info-content.Login .animation {
            transform: translateX(0);
            transition: .7s cubic-bezier(0.4, 0, 0.2, 1);
            transition-delay: calc(.1s * var(--S));
            opacity: 1;
            filter: blur(0px);
        }
        
        .container.active .info-content.Login .animation {
            transform: translateX(120%);
            opacity: 0;
            filter: blur(5px);
            transition-delay: calc(.1s * var(--D));
        }
        
        .info-content.Register {
            left: 0;
            text-align: left;
            background: linear-gradient(135deg, rgba(230, 179, 37, 0.05) 0%, rgba(10, 124, 84, 0.02) 100%);
            pointer-events: none;
        }
        
        .info-content.Register .animation {
            transform: translateX(-120%);
            transition: .7s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            filter: blur(5px);
            transition-delay: calc(.1s * var(--S));
        }
        
        .container.active .info-content.Register .animation {
            transform: translateX(0%);
            opacity: 1;
            filter: blur(0);
            transition-delay: calc(.1s * var(--li));
        }
        
        .info-content h2 {
            text-transform: uppercase;
            font-size: 42px;
            line-height: 1.2;
            color: #1f2937;
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .info-content p {
            font-size: 17px;
            color: #4b5563;
            line-height: 1.6;
        }
        
        .info-content ul {
            margin-top: 30px;
            list-style: none;
            padding: 0;
        }
        
        .info-content li {
            margin-bottom: 12px;
            color: #4b5563;
            font-size: 15px;
            display: flex;
            align-items: center;
        }
        
        .info-content.Login li {
            justify-content: flex-end;
        }
        
        .info-content li i {
            color: #0a7c54;
            margin-right: 10px;
        }
        
        .info-content.Login li i {
            margin-right: 0;
            margin-left: 10px;
        }
        
        /* FORMES COURBÉES MODERNES */
        .curved-shape {
            position: absolute;
            right: 0;
            top: -5px;
            height: 600px;
            width: 850px;
            background: linear-gradient(135deg, rgba(10, 124, 84, 0.1) 0%, rgba(230, 179, 37, 0.05) 100%);
            transform: rotate(10deg) skewY(40deg);
            transform-origin: bottom right;
            transition: 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            transition-delay: 1.4s;
            border-radius: 40% 60% 60% 40% / 70% 30% 70% 30%;
        }
        
        .container.active .curved-shape {
            transform: rotate(0deg) skewY(0deg);
            transition-delay: .6s;
        }
        
        .curved-shape2 {
            position: absolute;
            left: 250px;
            top: 100%;
            height: 700px;
            width: 850px;
            background: rgba(230, 179, 37, 0.05);
            border-top: 3px solid rgba(230, 179, 37, 0.2);
            transform: rotate(0deg) skewY(0deg);
            transform-origin: bottom left;
            transition: 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            transition-delay: .6s;
            border-radius: 60% 40% 40% 60% / 30% 70% 30% 70%;
        }
        
        .container.active .curved-shape2 {
            transform: rotate(-11deg) skewY(-41deg);
            transition-delay: 1.2s;
        }
        
        /* Messages d'erreur */
        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .error-message::before {
            content: '⚠ ';
            margin-right: 5px;
        }
        
        /* Checkbox personnalisé */
        .remember-checkbox {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .remember-checkbox input {
            display: none;
        }
        
        .remember-checkbox .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .remember-checkbox input:checked ~ .checkmark {
            background-color: #0a7c54;
            border-color: #0a7c54;
        }
        
        .remember-checkbox input:checked ~ .checkmark::after {
            content: '✓';
            color: white;
            font-size: 14px;
        }
        
        /* Logo amélioré */
        .logo {
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                max-width: 90%;
                height: auto;
                min-height: 600px;
            }
            
            .form-box, .info-content {
                padding: 0 40px;
            }
            
            .info-content h2 {
                font-size: 36px;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }
            
            .form-box, .info-content {
                position: relative;
                width: 100%;
                height: auto;
                padding: 40px 30px;
            }
            
            .info-content {
                display: none;
            }
            
            .curved-shape, .curved-shape2 {
                display: none;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-8">
    
    <div class="container w-full max-w-6xl h-[700px] relative">
        
        <!-- Formes courbées décoratives -->
        <div class="curved-shape"></div>
        <div class="curved-shape2"></div>
        
        <!-- Logo amélioré -->
        <div class="absolute top-8 left-8 z-30 logo">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-800 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                    <i class="fas fa-landmark text-white text-lg"></i>
                </div>
                <div>
                    <span class="text-xl font-bold text-gray-900">Bénin<span class="text-green-600">Culture</span></span>
                    <span class="block text-xs text-gray-500 font-medium">Patrimoine & Traditions</span>
                </div>
            </a>
        </div>
        
        <!-- Sélecteur de langue -->
        <div class="absolute top-8 right-8 z-30">
            <div class="relative group">
                <select class="bg-white/90 backdrop-blur-sm border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 cursor-pointer appearance-none pr-10">
                    <option>🇫🇷 Français</option>
                    <option>🇧🇯 Fon</option>
                    <option>🇧🇯 Yoruba</option>
                    <option>🇧🇯 Goun</option>
                </select>
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </div>
        </div>
        
        <!-- ===== LOGIN FORM ===== -->
        <div class="form-box Login">
            <h2 class="animation" style="--D:0; --S:21">Content de vous revoir</h2>
            <p class="subtitle animation" style="--D:1; --S:22">Connectez-vous pour contribuer à notre patrimoine culturel</p>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-box animation" style="--D:1; --S:22">
                    <input type="email" name="email" id="login-email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="login-email">Adresse email</label>
                    <i class="fas fa-envelope"></i>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--D:2; --S:23">
                    <input type="password" name="password" id="login-password" required autocomplete="current-password">
                    <label for="login-password">Mot de passe</label>
                    <i class="fas fa-lock"></i>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--D:3; --S:24">
                    <div class="flex items-center justify-between mb-4">
                        <label class="remember-checkbox">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="checkmark"></span>
                            <span class="text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-700 font-medium transition-colors">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>
                    <button class="btn animation" type="submit" style="--D:4; --S:25">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </button>
                </div>

                <div class="regi-link animation" style="--D:5; --S:26">
                    <p>Pas encore de compte ? <br> <a href="#" class="SignUpLink font-semibold">Créer un compte</a></p>
                </div>
            </form>
        </div>

        <!-- ===== LOGIN INFO ===== -->
        <div class="info-content Login">
            <h2 class="animation" style="--D:0; --S:20">BIENVENUE SUR<br>BÉNIN CULTURE</h2>
            <p class="animation" style="--D:1; --S:21">
                Rejoignez notre communauté dédiée à la préservation et à la promotion du riche patrimoine culturel et linguistique du Bénin.
            </p>
            <ul class="animation" style="--D:2; --S:22">
                <li><i class="fas fa-check-circle"></i> Partagez histoires et contes traditionnels</li>
                <li><i class="fas fa-check-circle"></i> Contribuez avec recettes culinaires locales</li>
                <li><i class="fas fa-check-circle"></i> Promouvez langues nationales béninoises</li>
            </ul>
        </div>

        <!-- ===== REGISTER FORM ===== -->
        <div class="form-box Register">
            <h2 class="animation" style="--li:17; --S:0">Rejoignez notre communauté</h2>
            <p class="subtitle animation" style="--li:18; --S:1">Créez votre compte pour partager et préserver notre culture béninoise</p>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-box animation" style="--li:18; --S:1">
                    <input type="text" name="name" id="register-name" value="{{ old('name') }}" required autocomplete="name">
                    <label for="register-name">Nom complet</label>
                    <i class="fas fa-user"></i>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--li:19; --S:2">
                    <input type="email" name="email" id="register-email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="register-email">Adresse email</label>
                    <i class="fas fa-envelope"></i>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--li:20; --S:3">
                    <input type="password" name="password" id="register-password" required autocomplete="new-password">
                    <label for="register-password">Mot de passe</label>
                    <i class="fas fa-lock"></i>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--li:21; --S:4">
                    <input type="password" name="password_confirmation" id="register-password-confirmation" required autocomplete="new-password">
                    <label for="register-password-confirmation">Confirmer le mot de passe</label>
                    <i class="fas fa-lock"></i>
                </div>

                <div class="input-box animation" style="--li:22; --S:5">
                    <button class="btn" type="submit">
                        <i class="fas fa-user-plus mr-2"></i>Créer mon compte
                    </button>
                </div>

                <div class="regi-link animation" style="--li:23; --S:6">
                    <p>Déjà un compte ? <br> <a href="#" class="SignInLink font-semibold">Se connecter</a></p>
                </div>
            </form>
        </div>

        <!-- ===== REGISTER INFO ===== -->
        <div class="info-content Register">
            <h2 class="animation" style="--li:17; --S:0">DEVENEZ<br>CONTRIBUTEUR</h2>
            <p class="animation" style="--li:18; --S:1">
                En tant que contributeur, vous pouvez partager des histoires, recettes, et articles culturels dans votre langue maternelle.
            </p>
            <ul class="animation" style="--li:19; --S:2">
                <li><i class="fas fa-star"></i> Créez du contenu dans les langues locales</li>
                <li><i class="fas fa-star"></i> Ajoutez des médias (photos, audio, vidéos)</li>
                <li><i class="fas fa-star"></i> Participez aux discussions communautaires</li>
            </ul>
        </div>

        <!-- Indicateurs mobiles -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-30 md:hidden flex space-x-4">
            <button id="tabLogin" class="px-6 py-2 bg-green-600 text-white font-medium rounded-full text-sm transition-all active-tab">
                Connexion
            </button>
            <button id="tabRegister" class="px-6 py-2 bg-gray-200 text-gray-600 font-medium rounded-full text-sm transition-all hover:bg-gray-300">
                Inscription
            </button>
        </div>

        <!-- Footer -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center text-xs text-gray-500 z-20">
            <p>© {{ date('Y') }} BéninCulture. Tous droits réservés.</p>
        </div>

    </div>

    <!-- JavaScript amélioré -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            const LoginLink = document.querySelector('.SignInLink');
            const RegisterLink = document.querySelector('.SignUpLink');
            const tabLogin = document.getElementById('tabLogin');
            const tabRegister = document.getElementById('tabRegister');
            
            // Fonction pour basculer vers l'inscription
            function showRegister() {
                container.classList.add('active');
                tabLogin.classList.remove('active-tab', 'bg-green-600', 'text-white');
                tabLogin.classList.add('bg-gray-200', 'text-gray-600');
                tabRegister.classList.add('active-tab', 'bg-green-600', 'text-white');
                tabRegister.classList.remove('bg-gray-200', 'text-gray-600');
            }
            
            // Fonction pour basculer vers la connexion
            function showLogin() {
                container.classList.remove('active');
                tabLogin.classList.add('active-tab', 'bg-green-600', 'text-white');
                tabLogin.classList.remove('bg-gray-200', 'text-gray-600');
                tabRegister.classList.remove('active-tab', 'bg-green-600', 'text-white');
                tabRegister.classList.add('bg-gray-200', 'text-gray-600');
            }
            
            // Événements pour les liens
            RegisterLink.addEventListener('click', (e) => {
                e.preventDefault();
                showRegister();
            });

            LoginLink.addEventListener('click', (e) => {
                e.preventDefault();
                showLogin();
            });
            
            // Événements pour les tabs mobiles
            if (tabLogin && tabRegister) {
                tabLogin.addEventListener('click', showLogin);
                tabRegister.addEventListener('click', showRegister);
            }
            
            // Gestion auto des erreurs
            @if($errors->has('email') || $errors->has('password'))
                // Reste sur login si erreur de connexion
                showLogin();
            @endif
            
            @if($errors->has('name') && old('_token'))
                // Va sur register si erreur d'inscription
                showRegister();
            @endif
            
            // Amélioration des champs
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                // Initialiser l'état des labels
                if (input.value) {
                    const label = input.nextElementSibling;
                    if (label && label.tagName === 'LABEL') {
                        label.style.top = '-10px';
                        label.style.fontSize = '14px';
                        label.style.color = '#0a7c54';
                        label.style.fontWeight = '600';
                    }
                }
                
                // Gestion du focus
                input.addEventListener('focus', function() {
                    const icon = this.nextElementSibling?.nextElementSibling;
                    if (icon && icon.tagName === 'I') {
                        icon.style.color = '#0a7c54';
                    }
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        const icon = this.nextElementSibling?.nextElementSibling;
                        if (icon && icon.tagName === 'I') {
                            icon.style.color = '#9ca3af';
                        }
                    }
                });
            });
            
            // Animation des boutons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'translateY(0)';
                });
                
                button.addEventListener('mouseup', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Ripple effect pour les boutons
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.5);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        top: ${y}px;
                        left: ${x}px;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Ajouter l'animation ripple
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>

</body>
</html>