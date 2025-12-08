<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Bénin - Chargement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }
        
        .splash-container {
            text-align: center;
            position: relative;
        }
        
        /* Animation de l'homme qui marche */
        .man-walking {
            width: 200px;
            height: 300px;
            position: relative;
            margin: 0 auto 40px;
        }
        
        /* Corps */
        .man-body {
            position: absolute;
            width: 40px;
            height: 100px;
            background: #2d3748;
            border-radius: 20px 20px 0 0;
            bottom: 120px;
            left: 80px;
        }
        
        /* Tête */
        .man-head {
            position: absolute;
            width: 50px;
            height: 50px;
            background: #2d3748;
            border-radius: 50%;
            bottom: 170px;
            left: 75px;
        }
        
        /* Bras */
        .man-arm {
            position: absolute;
            width: 15px;
            height: 60px;
            background: #2d3748;
            border-radius: 7px;
            bottom: 160px;
        }
        
        .arm-left {
            left: 60px;
            transform-origin: top center;
            animation: armSwing 2s ease-in-out infinite;
        }
        
        .arm-right {
            right: 60px;
            transform-origin: top center;
            animation: armSwing 2s ease-in-out infinite 0.5s;
        }
        
        /* Jambes */
        .man-leg {
            position: absolute;
            width: 20px;
            height: 80px;
            background: #1a202c;
            border-radius: 10px;
            bottom: 40px;
        }
        
        .leg-left {
            left: 75px;
            transform-origin: top center;
            animation: legWalk 2s ease-in-out infinite;
        }
        
        .leg-right {
            right: 75px;
            transform-origin: top center;
            animation: legWalk 2s ease-in-out infinite 1s;
        }
        
        /* Carte du Bénin que l'homme porte */
        .benin-map {
            position: absolute;
            width: 120px;
            height: 90px;
            top: 40px;
            left: 40px;
            transform-origin: center;
            animation: carryMap 3s ease-in-out infinite;
            z-index: 2;
        }
        
        /* Les bandes de la carte (drapeau du Bénin) */
        .map-stripe {
            position: absolute;
            width: 100%;
            height: 33.33%;
            left: 0;
        }
        
        .stripe-green {
            background: #008751;
            top: 0;
        }
        
        .stripe-yellow {
            background: #FCD116;
            top: 33.33%;
        }
        
        .stripe-red {
            background: #E8112D;
            bottom: 0;
        }
        
        /* Contour de la carte */
        .map-border {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid #2d3748;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        /* Animations */
        @keyframes armSwing {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(30deg); }
            75% { transform: rotate(-30deg); }
        }
        
        @keyframes legWalk {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(20deg); }
            75% { transform: rotate(-20deg); }
        }
        
        @keyframes carryMap {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Texte */
        .splash-title {
            font-size: 3rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
            animation: fadeIn 1s ease-out;
        }
        
        .splash-subtitle {
            font-size: 1.2rem;
            color: #4a5568;
            margin-bottom: 40px;
            animation: fadeIn 1s ease-out 0.3s both;
        }
        
        .benin-highlight {
            color: #008751;
            font-weight: 600;
        }
        
        /* Compteur */
        .countdown {
            font-size: 4rem;
            font-weight: 800;
            color: #008751;
            margin: 20px 0;
            animation: pulse 1s ease-in-out infinite;
        }
        
        .loading-text {
            color: #718096;
            font-size: 1rem;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out 0.6s both;
        }
        
        /* Barre de progression */
        .progress-container {
            width: 300px;
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin: 0 auto 40px;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, #008751, #FCD116, #E8112D);
            width: 0%;
            transition: width 1s linear;
            border-radius: 2px;
        }
        
        /* Logo */
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
        }
        
        .logo span {
            color: #008751;
        }
        
        /* Message de citation */
        .quote {
            max-width: 400px;
            margin: 20px auto;
            padding: 15px;
            background: #edf2f7;
            border-radius: 10px;
            font-style: italic;
            color: #4a5568;
            animation: fadeIn 1s ease-out 0.9s both;
        }
    </style>
</head>
<body>
    <div class="logo">Bénin<span>Culture</span></div>
    
    <div class="splash-container">
        <!-- Animation de l'homme qui porte la carte du Bénin -->
        <div class="man-walking">
            <!-- Carte du Bénin -->
            <div class="benin-map">
                <div class="map-stripe stripe-green"></div>
                <div class="map-stripe stripe-yellow"></div>
                <div class="map-stripe stripe-red"></div>
                <div class="map-border"></div>
            </div>
            
            <!-- Personnage -->
            <div class="man-head"></div>
            <div class="man-body"></div>
            <div class="man-arm arm-left"></div>
            <div class="man-arm arm-right"></div>
            <div class="man-leg leg-left"></div>
            <div class="man-leg leg-right"></div>
        </div>
        
        <h1 class="splash-title">Culture <span class="benin-highlight">Bénin</span></h1>
        <p class="splash-subtitle">Plateforme de promotion culturelle et linguistique</p>
        
        <div class="countdown" id="countdown">5</div>
        <p class="loading-text" id="loadingText">Chargement de votre expérience culturelle...</p>
        
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        
        <div class="quote" id="quote">
            "Notre culture est notre identité, préservons-la ensemble"
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let countdown = 5;
            const countdownElement = document.getElementById('countdown');
            const progressBar = document.getElementById('progressBar');
            const loadingText = document.getElementById('loadingText');
            const quoteElement = document.getElementById('quote');
            
            // Messages de chargement
            const loadingMessages = [
                "Chargement de votre expérience culturelle...",
                "Préparation des contenus culturels...",
                "Chargement des langues locales...",
                "Initialisation de la plateforme..."
            ];
            
            // Citations
            const quotes = [
                "Notre culture est notre identité, préservons-la ensemble",
                "Le Bénin rayonne par sa diversité culturelle",
                "Chaque langue est un trésor à transmettre",
                "Notre patrimoine est une richesse à partager"
            ];
            
            let messageIndex = 0;
            let quoteIndex = 0;
            
            function updateLoadingMessage() {
                loadingText.textContent = loadingMessages[messageIndex];
                messageIndex = (messageIndex + 1) % loadingMessages.length;
            }
            
            function updateQuote() {
                quoteElement.style.opacity = '0';
                setTimeout(() => {
                    quoteIndex = (quoteIndex + 1) % quotes.length;
                    quoteElement.textContent = `"${quotes[quoteIndex]}"`;
                    quoteElement.style.opacity = '1';
                }, 300);
            }
            
            const interval = setInterval(() => {
                countdown--;
                countdownElement.textContent = countdown;
                
                // Mettre à jour la barre de progression
                const progress = ((5 - countdown) / 5) * 100;
                progressBar.style.width = progress + '%';
                
                // Changer le message toutes les secondes
                updateLoadingMessage();
                
                // Changer la citation toutes les 2 secondes
                if (countdown % 2 === 0) {
                    updateQuote();
                }
                
                if (countdown <= 0) {
                    clearInterval(interval);
                    // Redirection vers la page d'accueil
                    window.location.href = "/home";
                }
            }, 1000);
            
            // Redirection au clic n'importe où
            document.body.addEventListener('click', function() {
                window.location.href = "/home";
            });
            
            // Initialiser les messages
            updateLoadingMessage();
            updateQuote();
        });
    </script>
</body>
</html>