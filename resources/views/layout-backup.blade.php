<!doctype html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Culture Bénin | Tableau de Bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#e74c3c" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{URL::asset('adminlte/css/adminlte.css')}}" />
    
    <style>
      :root {
        --primary-color: #e74c3c;
        --secondary-color: #2c3e50;
        --accent-color: #f39c12;
        --sidebar-width: 280px;
        --sidebar-collapsed: 80px;
      }
      
      .sidebar-custom {
        background: linear-gradient(180deg, var(--secondary-color) 0%, #1a252f 100%);
        border-right: none;
      }
      
      .brand-custom {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255,255,255,0.1);
      }
      
      .brand-logo {
        transition: all 0.3s ease;
        filter: brightness(0) invert(1);
      }
      
      .nav-item-custom {
        margin: 2px 8px;
        border-radius: 8px;
        transition: all 0.3s ease;
      }
      
      .nav-item-custom:hover {
        background: rgba(255,255,255,0.1);
        transform: translateX(5px);
      }
      
      .nav-item-custom.active {
        background: var(--primary-color);
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
      }
      
      .nav-icon-custom {
        width: 20px;
        text-align: center;
        margin-right: 10px;
        font-size: 1.1em;
      }
      
      .user-profile-sidebar {
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
        padding: 15px;
        margin: 10px;
        text-align: center;
        border: 1px solid rgba(255,255,255,0.1);
      }
      
      .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 3px solid var(--primary-color);
        padding: 2px;
        background: white;
      }
      
      .badge-custom {
        background: var(--accent-color);
        color: var(--secondary-color);
        font-weight: 600;
      }
      
      .header-custom {
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-bottom: 3px solid var(--primary-color);
      }
      
      .search-box-custom {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        padding: 8px 20px;
        transition: all 0.3s ease;
      }
      
      .search-box-custom:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
      }
      
      .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7em;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    </style>
  </head>

  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      <!-- Header -->
      <nav class="app-header navbar navbar-expand header-custom">
        <div class="container-fluid">
          <!-- Left Side -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-dark" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link text-dark">
                <i class="bi bi-house me-1"></i>Accueil
              </a>
            </li>
          </ul>

          <!-- Right Side -->
          <ul class="navbar-nav ms-auto">
            <!-- Search -->
            <li class="nav-item me-3">
              <div class="input-group search-box-custom">
                <input type="text" class="form-control border-0 bg-transparent" placeholder="Rechercher...">
                <button class="btn border-0 bg-transparent">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </li>

            <!-- Notifications -->
            <li class="nav-item dropdown me-2">
              <a class="nav-link text-dark position-relative" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell"></i>
                <span class="notification-badge">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <span class="dropdown-item dropdown-header">3 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                  Nouveau contenu à valider
                  <span class="float-end text-muted fs-7">3 min</span>
                </a>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-person-check me-2 text-success"></i>
                  Utilisateur inscrit
                  <span class="float-end text-muted fs-7">1 h</span>
                </a>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-exclamation-triangle me-2 text-warning"></i>
                  Problème signalé
                  <span class="float-end text-muted fs-7">2 h</span>
                </a>
              </div>
            </li>

            <!-- User Menu -->
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown">
                <img src="{{URL::asset('adminlte/img/user2-160x160.jpg')}}" 
                     class="user-image rounded-circle shadow" 
                     alt="User Image" />
                <span class="d-none d-md-inline">Admin Culture</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header text-center">
                  <strong>Administrateur</strong>
                </li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Paramètres</a></li>
                <li class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Sidebar -->
      <aside class="app-sidebar sidebar-custom shadow" data-bs-theme="dark">
        <!-- Brand -->
        <div class="sidebar-brand brand-custom">
          <a href="{{ url('/') }}" class="brand-link d-flex align-items-center py-3">
            <img src="{{URL::asset('adminlte/img/AdminLTELogo.png')}}" 
                 alt="Culture Bénin Logo" 
                 class="brand-logo me-3" 
                 style="height: 35px;" />
            <span class="brand-text fw-bold fs-5">Culture Bénin</span>
          </a>
        </div>

        <!-- User Profile -->
        <div class="user-profile-sidebar">
          <img src="{{URL::asset('adminlte/img/user2-160x160.jpg')}}" 
               alt="Admin" 
               class="user-avatar mb-2" />
          <h6 class="mb-1 text-white">Admin Culture</h6>
          <small class="text-white-50">Administrateur</small>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar-wrapper">
          <nav class="mt-3">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation">
              <!-- Dashboard -->
              <li class="nav-item nav-item-custom active">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                  <i class="nav-icon bi bi-speedometer2 nav-icon-custom"></i>
                  <p>Tableau de Bord</p>
                </a>
              </li>

              <!-- Contenus Culturels -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-collection-play nav-icon-custom"></i>
                  <p>
                    Contenus Culturels
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('contenus.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-list-check"></i>
                      <p>Tous les contenus</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('contenus.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-plus-circle"></i>
                      <p>Ajouter un contenu</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-clock-history"></i>
                      <p>En attente <span class="badge badge-custom ms-2">5</span></p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Catégories -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tags nav-icon-custom"></i>
                  <p>
                    Catégories
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-music-note-list"></i>
                      <p>Musiques</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-camera-reels"></i>
                      <p>Vidéos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-image"></i>
                      <p>Images</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Régions -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-geo-alt nav-icon-custom"></i>
                  <p>Régions du Bénin</p>
                </a>
              </li>

              <!-- Utilisateurs -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-people nav-icon-custom"></i>
                  <p>
                    Utilisateurs
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-person-check"></i>
                      <p>Utilisateurs actifs</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-person-plus"></i>
                      <p>Nouveaux inscrits</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Statistiques -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-bar-chart nav-icon-custom"></i>
                  <p>Statistiques</p>
                </a>
              </li>

              <!-- Paramètres -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-gear nav-icon-custom"></i>
                  <p>Paramètres</p>
                </a>
              </li>

              <!-- Séparateur -->
              <li class="nav-header mt-4">SUPPORT</li>

              <!-- Aide -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-question-circle nav-icon-custom"></i>
                  <p>Aide & Support</p>
                </a>
              </li>

              <!-- Déconnexion -->
              <li class="nav-item nav-item-custom">
                <a href="#" class="nav-link text-danger">
                  <i class="nav-icon bi bi-box-arrow-right nav-icon-custom"></i>
                  <p>Déconnexion</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            @yield('title')
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            @yield('content')
          </div>
        </div>
      </main>

      <!-- Footer -->
      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">
          <strong>Culture Bénin</strong>
        </div>
        <strong>
          Copyright &copy; 2024
          <a href="#" class="text-decoration-none">Ministère de la Culture</a>.
        </strong>
        Tous droits réservés.
      </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="./js/adminlte.js"></script>

    <script>
      // Sidebar configuration
      document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector('.sidebar-wrapper');
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: 'os-theme-light',
              autoHide: 'leave',
              clickScroll: true,
            },
          });
        }

        // Active menu item highlighting
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
          if (link.getAttribute('href') === currentPath) {
            link.closest('.nav-item').classList.add('active');
          }
        });
      });
    </script>
  </body>
</html>