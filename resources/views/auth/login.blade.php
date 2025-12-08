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
                        'primary': '#2C3E50',
                        'accent': '#4A90E2',
                        'light': '#F8F9FA',
                        'border': '#E0E0E0'
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Police Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        /* ===== ANIMATIONS COMPLÈTES (comme ton original) ===== */
        .container {
            transition: all 0.7s ease;
            position: relative;
            overflow: hidden;
        }
        
        .form-box {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            transition: 0.7s ease;
            opacity: 1;
        }
        
        /* FORMULAIRE LOGIN */
        .form-box.Login {
            left: 0;
            padding: 0 40px;
        }
        
        .form-box.Login .animation {
            transform: translateX(0%);
            transition: .7s;
            opacity: 1;
            transition-delay: calc(.1s * var(--S));
        }
        
        .container.active .form-box.Login .animation {
            transform: translateX(-120%);
            opacity: 0;
            transition-delay: calc(.1s * var(--D));
        }
        
        /* FORMULAIRE REGISTER */
        .form-box.Register {
            right: 0;
            padding: 0 40px;
        }
        
        .form-box.Register .animation {
            transform: translateX(120%);
            transition: .7s ease;
            opacity: 0;
            filter: blur(10px);
            transition-delay: calc(.1s * var(--S));
        }
        
        .container.active .form-box.Register .animation {
            transform: translateX(0%);
            opacity: 1;
            filter: blur(0px);
            transition-delay: calc(.1s * var(--li));
        }
        
        .form-box h2 {
            font-size: 32px;
            text-align: center;
        }
        
        .form-box .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin-top: 25px;
        }
        
        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
            color: #2C3E50;
            font-weight: 500;
            border-bottom: 2px solid #E0E0E0;
            padding-right: 23px;
            transition: .5s;
        }
        
        .input-box input:focus,
        .input-box input:valid {
            border-bottom: 2px solid #4A90E2;
        }
        
        .input-box label {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 16px;
            color: #666;
            transition: .5s;
        }
        
        .input-box input:focus ~ label,
        .input-box input:valid ~ label {
            top: -5px;
            color: #4A90E2;
        }
        
        .input-box i {
            position: absolute;
            top: 50%;
            right: 0;
            font-size: 18px;
            transform: translateY(-50%);
            color: #666;
        }
        
        .input-box input:focus ~ i,
        .input-box input:valid ~ i {
            color: #4A90E2;
        }
        
        .btn {
            position: relative;
            width: 100%;
            height: 45px;
            background: transparent;
            border-radius: 40px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            border: 2px solid #4A90E2;
            overflow: hidden;
            z-index: 1;
            color: #4A90E2;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: #4A90E2;
            color: white;
        }
        
        .regi-link {
            font-size: 14px;
            text-align: center;
            margin: 20px 0 10px;
            color: #666;
        }
        
        .regi-link a {
            text-decoration: none;
            color: #4A90E2;
            font-weight: 600;
        }
        
        .regi-link a:hover {
            text-decoration: underline;
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
        }
        
        .info-content.Login {
            right: 0;
            text-align: right;
            padding: 0 40px 60px 150px;
        }
        
        .info-content.Login .animation {
            transform: translateX(0);
            transition: .7s ease;
            transition-delay: calc(.1s * var(--S));
            opacity: 1;
            filter: blur(0px);
        }
        
        .container.active .info-content.Login .animation {
            transform: translateX(120%);
            opacity: 0;
            filter: blur(10px);
            transition-delay: calc(.1s * var(--D));
        }
        
        .info-content.Register {
            left: 0;
            text-align: left;
            padding: 0 150px 60px 38px;
            pointer-events: none;
        }
        
        .info-content.Register .animation {
            transform: translateX(-120%);
            transition: .7s ease;
            opacity: 0;
            filter: blur(10PX);
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
            font-size: 36px;
            line-height: 1.3;
            color: #2C3E50;
        }
        
        .info-content p {
            font-size: 16px;
            color: #666;
        }
        
        /* FORMES COURBÉES */
        .curved-shape {
            position: absolute;
            right: 0;
            top: -5px;
            height: 600px;
            width: 850px;
            background: linear-gradient(45deg, #f8f9fa, #4A90E2);
            transform: rotate(10deg) skewY(40deg);
            transform-origin: bottom right;
            transition: 1.5s ease;
            transition-delay: 1.6s;
        }
        
        .container.active .curved-shape {
            transform: rotate(0deg) skewY(0deg);
            transition-delay: .5s;
        }
        
        .curved-shape2 {
            position: absolute;
            left: 250px;
            top: 100%;
            height: 700px;
            width: 850px;
            background: #f8f9fa;
            border-top: 3px solid #4A90E2;
            transform: rotate(0deg) skewY(0deg);
            transform-origin: bottom left;
            transition: 1.5s ease;
            transition-delay: .5s;
        }
        
        .container.active .curved-shape2 {
            transform: rotate(-11deg) skewY(-41deg);
            transition-delay: 1.2s;
        }
        
        /* Messages d'erreur */
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    
    <div class="container w-full max-w-4xl h-[500px] bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
        
        <!-- Formes courbées -->
        <div class="curved-shape"></div>
        <div class="curved-shape2"></div>
        
        <!-- Logo -->
        <div class="absolute top-6 left-6 z-20">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-book-open text-white text-lg"></i>
                </div>
                <span class="text-xl font-semibold text-gray-800">Culture<span class="text-blue-600">Bénin</span></span>
            </div>
        </div>
        
        <!-- ===== LOGIN FORM ===== -->
        <div class="form-box Login">
            <h2 class="animation" style="--D:0; --S:21">Connexion</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-box animation" style="--D:1; --S:22">
                    <input type="email" name="email" id="login-email" value="{{ old('email') }}" required>
                    <label for="login-email">Email</label>
                    <i class="fas fa-envelope"></i>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--D:2; --S:23">
                    <input type="password" name="password" id="login-password" required>
                    <label for="login-password">Mot de passe</label>
                    <i class="fas fa-lock"></i>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--D:3; --S:24">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="mr-2">
                            <label for="remember" class="text-sm">Se souvenir</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>
                    <button class="btn" type="submit">Se connecter</button>
                </div>

                <div class="regi-link animation" style="--D:4; --S:25">
                    <p>Pas encore de compte ? <br> <a href="#" class="SignUpLink">S'inscrire</a></p>
                </div>
            </form>
        </div>

        <!-- ===== LOGIN INFO ===== -->
        <div class="info-content Login">
            <h2 class="animation" style="--D:0; --S:20">BIENVENUE !</h2>
            <p class="animation" style="--D:1; --S:21">Nous sommes ravis de vous revoir. Accédez à votre espace personnel pour contribuer à la préservation de la culture béninoise.</p>
        </div>

        <!-- ===== REGISTER FORM ===== -->
        <div class="form-box Register">
            <h2 class="animation" style="--li:17; --S:0">Inscription</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-box animation" style="--li:18; --S:1">
                    <input type="text" name="name" id="register-name" value="{{ old('name') }}" required>
                    <label for="register-name">Nom complet</label>
                    <i class="fas fa-user"></i>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--li:19; --S:2">
                    <input type="email" name="email" id="register-email" value="{{ old('email') }}" required>
                    <label for="register-email">Email</label>
                    <i class="fas fa-envelope"></i>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--li:19; --S:3">
                    <input type="password" name="password" id="register-password" required>
                    <label for="register-password">Mot de passe</label>
                    <i class="fas fa-lock"></i>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box animation" style="--li:20; --S:4">
                    <input type="password" name="password_confirmation" id="register-password-confirmation" required>
                    <label for="register-password-confirmation">Confirmer le mot de passe</label>
                    <i class="fas fa-lock"></i>
                </div>

                <div class="input-box animation" style="--li:20; --S:5">
                    <button class="btn" type="submit">S'inscrire</button>
                </div>

                <div class="regi-link animation" style="--li:21; --S:6">
                    <p>Déjà un compte ? <br> <a href="#" class="SignInLink">Se connecter</a></p>
                </div>
            </form>
        </div>

        <!-- ===== REGISTER INFO ===== -->
        <div class="info-content Register">
            <h2 class="animation" style="--li:17; --S:0">REJOIGNEZ-NOUS !</h2>
            <p class="animation" style="--li:18; --S:1">Créez un compte pour contribuer à la préservation et à la valorisation du patrimoine culturel béninois.</p>
        </div>

    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            const LoginLink = document.querySelector('.SignInLink');
            const RegisterLink = document.querySelector('.SignUpLink');

            RegisterLink.addEventListener('click', (e) => {
                e.preventDefault();
                container.classList.add('active');
            });

            LoginLink.addEventListener('click', (e) => {
                e.preventDefault();
                container.classList.remove('active');
            });
            
            // Gestion auto des erreurs
            @if($errors->has('email') || $errors->has('password'))
                // Reste sur login si erreur de connexion
                container.classList.remove('active');
            @endif
            
            @if($errors->has('name') && old('_token'))
                // Va sur register si erreur d'inscription
                container.classList.add('active');
            @endif
        });
    </script>

</body>
</html>